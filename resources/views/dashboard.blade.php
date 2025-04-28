@extends('layouts.admin-layout')
@section('page-title', 'Dashboard')
@section('content')
<section class="py-5">
    <div class="container">

        @role ('Administrator')
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <marquee behavior="scroll" direction="left" scrollamount="18">
                    <h1 class="card-title mb-3 text-dark fw-bold" style="font-size: 4rem;">Welcome Admin 👋</h1>
                </marquee>
                <p class="card-text">You have full access to manage the system.</p>
            </div>
        </div>

        <h3 class="mb-3">Top 5 Best Selling Products 🔥</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name ?? '-' }}</td>
                        <td>{{ $product->total_sold ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        @endrole

        @role ('Pimpinan')
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Product Overview 📦</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Photo</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->category->category_name }}</td>
                                    <td>{{ $data->product_name }}</td>
                                    <td>Rp{{ number_format($data->product_price, 0, ',', '.') }}</td>
                                    <td>{{ $data->product_qty }}</td>
                                    <td>
                                        @if($data->product_photo)
                                            <img width="160" src="{{ asset('storage/' . $data->product_photo) }}"
                                                alt="{{ $data->product_name }}">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->product_description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endrole

        @role ('Kasir')
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">Stock Monitoring 📋</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Photo</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->category->category_name }}</td>
                                    <td>{{ $data->product_name }}</td>
                                    <td>Rp{{ number_format($data->product_price, 0, ',', '.') }}</td>
                                    <td>{{ $data->product_qty }}</td>
                                    <td>
                                        @if($data->product_photo)
                                            <img width="150" src="{{ asset('storage/' . $data->product_photo) }}"
                                                alt="{{ $data->product_name }}">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->product_description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endrole

    </div>
</section>
@endsection