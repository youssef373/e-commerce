<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Products;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Termwind\render;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $user_id = 0;
            $products = Products::paginate(6);
            $categories = Category::all();
            $comments = Comment::latest()->get();
            $comments_count = $comments->count();
            $replies = Reply::all();

            return view('user.home', compact('products', 'comments',
                        'replies', 'comments_count', 'categories', 'user_id'
            ));
        }
    }

    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $userProducts = Cart::where('user_id', $user_id)->get();
                $productsCount = $userProducts->count();
                $products = Products::paginate(6);
                $categories = Category::all();
                $comments = Comment::latest()->get();
                $replies = Reply::all();
                $comments_count = $comments->count();

                return view('user.home', compact('products', 'productsCount','user_id',
                            'comments', 'replies', 'comments_count', 'categories'));
            } else {
                $total_products = Products::all()->count();
                $total_orders = Order::all()->count();
                $total_users = User::all()->count();
                //calculate the total revenue
                $total_revenue = 0;
                $orders = Order::all();
                foreach ($orders as $order)
                    $total_revenue += $order->price;

                $total_orders_delivered = Order::where('delivery_status', 'delivered')->get()->count();
                $total_orders_processing = Order::where('delivery_status', 'processing')->get()->count();

                return view('admin.home', compact([
                    'total_products', 'total_orders', 'total_users', 'total_revenue',
                    'total_orders_delivered', 'total_orders_processing'
                ]));
            }
        } else
            return redirect()->back();
    }

    public function showProducts()
    {
        $products = Products::paginate(6);
        $comments = Comment::latest()->get();
        $comments_count = $comments->count();
        $replies = Reply::all();
        $user_id = 0;

        if(Auth::id())
        {
            $user_id = Auth::user()->id;
            $userProducts = Cart::where('user_id', $user_id)->get();
            $productsCount = $userProducts->count();

            return view('user.all_products', compact('products', 'comments',
                'comments_count', 'replies', 'productsCount','user_id'));
        }
        return view('user.all_products', compact('products', 'comments',
            'comments_count', 'replies','user_id'));
    }

    public function showProductDetails($id)
    {
        $product = Products::find($id);

        if (Auth::id()) {
            $user_id = Auth::user()->id;
            $userProducts = Cart::where('user_id', $user_id)->get();
            $productsCount = $userProducts->count();

            return view('user.product_details', compact('product', 'productsCount'));
        }

        return view('user.product_details', compact('product'));
    }

    public function addCartProduct(Request $request, $id)
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                //Get logged in user data
                $user = Auth::user();
                $user_id = $user->id;
                //get product data
                $product = Products::find($id);
                //instantiate cart class
                $userProducts = Cart::where('product_id', $product->id)->where('user_id', $user_id)->get();
                $productsCount = $userProducts->count();

                if ($productsCount > 0)
                    return redirect()->back()->with([
                        'message' => 'Product is already in the cart',
                        'status' => 'danger'
                    ]);
                else {
                    $cart = new Cart;
                    $cart->name = $user->name;
                    $cart->email = $user->email;
                    $cart->phone = $user->phone;
                    $cart->address = $user->address;
                    $cart->user_id = $user->id;
                    $cart->product_title = $product->title;
                    if ($product->discount_price != NULL)
                        $cart->price = $product->discount_price * $request->quantity;
                    else
                        $cart->price = $product->price * $request->quantity;
                    $cart->Product_id = $product->id;
                    $cart->image = $product->image;
                    $cart->quantity = $request->quantity;
                    $cart->save();

                    return redirect()->back()->with([
                        'message' => 'Products added to cart successfully',
                        'status' => 'success'
                    ]);
                }
            }
        } else
            return redirect('login');
    }

    public function showCartItemsView()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $userProducts = Cart::where('user_id', $user_id)->get();
                $productsCount = $userProducts->count();

                return view('user.show_cart_items', compact('productsCount', 'userProducts'));
            }
        }
    }

    public function removeCartProduct($id)
    {
        $product = Cart::find($id);
        $product->delete();

        return redirect()->back()->with([
            'message' => 'Product removed successfully',
            'status' => 'danger'
        ]);
    }

    public function removeAllCartProducts()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $userProducts = Cart::where('user_id', $user_id)->delete();

                return redirect()->back()->with([
                    'message' => 'All products removed successfully',
                    'status' => 'danger'
                ]);
            }
        }
    }

    public function updateCartProductView($cart_id)
    {
        if (Auth::id()) {
            $cart_product = Cart::find($cart_id);
            $product = Products::where('id', $cart_product->Product_id)->first();
            $user_id = Auth::user()->id;
            $userProducts = Cart::where('user_id', $user_id)->get();
            $productsCount = $userProducts->count();

            return view('user.update_product', compact('cart_product', 'productsCount', 'product'));
        }
    }

    public function updateCartProductQuantity(Request $request, $cart_id)
    {
        $cart_product = Cart::find($cart_id);
        $cart_product->quantity = $request->quantity;

        if ($cart_product->discount_price != NULL)
            $cart_product->price = $cart_product->discount_price * $request->quantity;
        else
            $cart_product->price = $cart_product->price * $request->quantity;

        $cart_product->save();
        $user_id = Auth::user()->id;
        $userProducts = Cart::where('user_id', $user_id)->get();
        $productsCount = $userProducts->count();

        return redirect('cart_items_view')->with(
            [
                'message' => 'product updated successfully',
                'status' => 'success'
            ]);
    }

    public function cashOrder()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $userProducts = Cart::where('user_id', $user_id)->get();

                foreach ($userProducts as $userProduct) {
                    $order = new Order;
                    $order->name = $userProduct->name;
                    $order->email = $userProduct->email;
                    $order->phone = $userProduct->phone;
                    $order->address = $userProduct->address;
                    $order->user_id = $userProduct->user_id;
                    $order->product_title = $userProduct->product_title;
                    $order->price = $userProduct->price;
                    $order->quantity = $userProduct->quantity;
                    $order->image = $userProduct->image;
                    $order->Product_id = $userProduct->Product_id;
                    $order->payment_status = 'cash on delivery';
                    $order->delivery_status = 'processing';
                    $order->save();

                    $cart_product_id = $userProduct->id;
                    $cart_product = Cart::find($cart_product_id);
                    $cart_product->delete();
                }

                return redirect('/cart_items_view')->with([
                    'delivery_order' => 'We Have Received Your Order. we will connect with you soon',
                    'status' => 'success'
                ]);
            }
        }
    }

    public function showUserOrders()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 0) {
                $user_id = Auth::user()->id;
                $orders = Order::where('user_id', $user_id)->get();
                $userProducts = Cart::where('user_id', $user_id)->get();
                $productsCount = $userProducts->count();

                return view('user.orders', compact('orders', 'productsCount'));
            }
        }
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Canceled';
        $order->save();

        return redirect()->back()->with([
            'message' => 'Order canceled successfully',
            'status' => 'danger'
        ]);
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        if (Auth::id()) {
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
        } else
            return redirect('login');
    }

    public function deleteComment(Request $request, $id)
    {
        if ($request->ajax()) {
            $comment = Comment::find($id);
            $comment->delete();
        }
    }

    public function showComments()
    {
        $comments = Comment::latest()->get();
        $comments_count = $comments->count();
        $replies = Reply::all();
        $user_id = Auth::user()->id;

        return view('user.comments.user_comments', compact('comments', 'replies', 'comments_count', 'user_id'));

    }

    public function addCommentReply(Request $request)
    {
        if (Auth::id()) {
            $request->validate([
                'reply' => 'required'
            ]);
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->comment_id;
            $reply->reply = $request->reply;
            $reply->save();

            return redirect()->back();
        } else
            return redirect('login');
    }

    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            if (request('search'))
                $products = Products::where('title', 'like', '%' . request('search') . '%')
                    ->orwhere('category', 'like', '%' . request('search') . '%')->paginate(3);
            else
                $products = Products::all();

            return view('user.paginate', compact('products'));
        }
    }
}


