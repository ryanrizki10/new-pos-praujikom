<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon; // di atas controller, buat bantu parsing tanggal

class TransactionController extends Controller
{

    public function create()
    {
        $products = Product::where('is_active', 1)
            ->where('product_qty', '>', 0)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => (int) $product->product_price,
                    'image' => $product->product_photo,
                    'qty' => (int) $product->product_qty,
                    'option' => '',
                ];
            });
        return view('pos-sale', compact('products'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'cart' => 'required',
            'cash' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
        ]);

        $data = json_decode($request->cart, true);


        $latestIdOrder = Order::max('id') + 1;
        $order = Order::create([
            'order_code' => $this->generateOrderCode($latestIdOrder),
            'order_date' => now(),
            'order_amount' => $request->total,
            'order_change' => $request->change,
            'order_status' => 1,
            'customer_name' => "John Doe",
        ]);

        foreach ($data as $item) {
            $product = Product::find($item['productId']);
            if ($product) {
                $product->product_qty -= $item['qty'];
                $product->save();
            }

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'order_price' => $item['price'],
                'order_subtotal' => $item['qty'] * $item['price'],
            ]);
        }
        // return $request;

        Alert::success('Success', 'Transaction has been successfully processed.');
        return redirect('/pos-sale');
    }

    private function generateOrderCode($orderId)
    {
        $prefix = 'POS';
        $date = now()->format('Ymd');

        return "{$prefix}-{$date}-" . str_pad($orderId, 6, '0', STR_PAD_LEFT);
    }


    // pos page
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(5);
        return view('pos.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        // return $order;
        return view('pos.show', compact('order'));
    }

    public function print(string $id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        // return $order;
        return view('print', compact('order'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'cash_received' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($id);

        if ($request->cash_received < $order->order_amount) {
            Alert::error('Error', 'Insufficient payment amount.');
            return back();
        }

        $order->update([
            'order_change' => $request->cash_received - $order->order_amount,
            'order_status' => 1, // Mark as paid
        ]);

        Alert::success('Success', 'Payment has been successfully processed.');
        return redirect()->route('pos.index');
    }

    public function report(Request $request)
{
    $query = Order::query();

    if ($request->filled('filter')) {
        $filter = $request->filter;

        if ($filter === 'daily' && $request->date) {
            $query->whereDate('order_date', $request->date);
        } elseif ($filter === 'weekly' && $request->start_date && $request->end_date) {
            $query->whereBetween('order_date', [$request->start_date, $request->end_date]);
        } elseif ($filter === 'monthly' && $request->month) {
            $query->whereMonth('order_date', Carbon::parse($request->month)->month)
                  ->whereYear('order_date', Carbon::parse($request->month)->year);
        }
    }

    $orders = $query->orderBy('order_date', 'desc')->paginate(10);

    return view('pos.report', compact('orders'));
}
}
