<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View; // <<< Tambahkan ini!

class DashboardController extends Controller
{
    public function index(): View
    {
        $datas = Product::with('category')->latest()->take(5)->get();

        $topProducts = Product::with('category')
            ->withSum('transactionDetails as total_sold', 'qty')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('dashboard', compact('datas', 'topProducts'));
    }
}
