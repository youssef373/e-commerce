<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use PDF;

class AdminController extends Controller
{
    public function add_category_view()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
                return view('admin.categories.add_category');
            else
                return redirect()->back();
        }
        else
         return redirect('login');
    }

    public function add_category(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $request->validate([
                    'category' => 'required|string'
                ]);
                $category = new Category;
                $category->category_name = $request->category;
                $category->save();

                return redirect('show_categories_view')->with([
                    'message' => 'Category added successfully',
                    'status' => 'success'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function show_all_categories()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $categories = Category::all();

                return view('admin.categories.show_categories', compact('categories'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');

    }

    public function deleteCategory($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $category = Category::find($id);
                $category->delete();

                return redirect('show_categories_view')->with([
                    'message' => 'Category deleted successfully',
                    'status' => 'danger'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function addProductView()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                return view('admin.products.add_products');
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function addProduct(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'category' => 'required|string',
                    'price' => 'required|string',
                    'quantity' => 'required|integer',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $product = new Products;
                if ($request->image) {
                    $image = $request->image;
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $request->image->move('productimage', $imageName);
                    $product->image = $imageName;
                }
                $product->title = $request->title;
                $product->description = $request->description;
                $product->quantity = $request->quantity;
                $product->category = $request->category;
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->save();

                return redirect('show_products')->with([
                    'message' => 'Products added successfully',
                    'status' => 'success'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function showProducts()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $products = Products::all();

                return view('admin.products.show_products', compact('products'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function deleteProduct($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $products = Products::find($id);
                $products->delete();

                return redirect('show_products')->with([
                    'message' => 'Products deleted successfully',
                    'status' => 'danger'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function updateProductView($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $product = Products::find($id);

                return view('admin.products.update_products', compact('product'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function updateProduct(Request $request, $id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $product = Products::find($id);
                if ($request->image) {
                    $image = $request->image;
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $request->image->move('productimage', $imageName);
                    $product->image = $imageName;
                }
                $product->title = $request->title;
                $product->description = $request->description;
                $product->quantity = $request->quantity;
                $product->category = $request->category;
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->save();

                return redirect('show_products')->with([
                    'message' => 'Products updated successfully',
                    'status' => 'success'
                ]);
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function showOrders()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $orders = Order::all();

                return view('admin.orders', compact('orders'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function deliverOrder($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $order = Order::find($id);
                $order->delivery_status = 'delivered';
                $order->save();

                return redirect()->back();
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function printPdf($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $order = Order::find($id);
                $pdf = PDF::loadView('admin.pdf', compact('order'));

                return $pdf->download('order_details.pdf');
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function sendEmailView($id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                $user = Order::find($id);

                return view('admin.send_email', compact('user'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }

    public function sendEmail(Request $request, $id)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $order = Order::find($id);
                    $details = [
                        'greeting' => $request->greeting,
                        'body' => $request->body,
                        'action_text' => $request->action_text,
                        'action_url' => $request->action_url,
                        'end_part' => $request->end_part,
                    ];

                    Notification::send($order, new MyFirstNotification($details));

                    return redirect()->back()->with([
                        'message' => 'email notify sent successfully',
                        'status' => 'success'
                    ]);
                } else
                    return redirect()->back();
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');

    }

    public function searchOrders(Request $request)
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == 1)
            {
                if (request('search'))
                    $orders = Order::where('name', 'like', '%' . request('search') . '%')
                        ->orwhere('product_title', 'like', '%' . request('search') . '%')->get();
                else
                    $orders = Order::all();

                return view('admin.orders', compact('orders'));
            }
            else
                return redirect()->back();
        }
        else
            return redirect('login');
    }
}
