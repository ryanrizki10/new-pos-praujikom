@extends('layouts.admin-layout')
@section('page-title', 'Product')
@section('title', 'Product')
@section('content')
<section class="py-5 text-center bg-white rounded">
    <div class="container">
        <div class="d-flex justify-content-between mb-4 align-items-center">
            <h3 class="mb-0">Product List</h3>
            <a href="{{ route('product.create') }}" class="btn btn-primary">+ Add Product</a>
        </div>

        <form action="{{ route('product.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if(request('search'))
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Clear</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm rounded">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Photo</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">{{ $products->firstItem() + $loop->iteration - 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark">{{ $product->product_qty }}</span>
                            </td>
                            <td class="text-center">
                                @if($product->product_photo)
                                    @if(Str::startsWith($product->product_photo, ['http://', 'https://']))
                                        <img src="{{ $product->product_photo }}" alt="{{ $product->product_name }}" class="img-thumbnail img-hover" style="width:80px; height:80px; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('storage/' . $product->product_photo) }}" alt="{{ $product->product_name }}" class="img-thumbnail img-hover" style="width:150px; height:80px; object-fit:cover;">
                                    @endif
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($product->product_price, 0, ',', '.') }}</td>
                            <td>{{ Str::limit($product->product_description, 50) }}</td>
                            <td class="text-center">
                                <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger btn-hapus" data-name="{{ $product->product_name }}">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>

<style>
    .img-hover {
        transition: transform 0.3s ease;
    }
    .img-hover:hover {
        transform: scale(1.1);
    }
</style>

<script>
    $('.btn-hapus').click(function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var productName = $(this).data('name');
        Swal.fire({
            title: `Delete "${productName}"?`,
            text: "Are you sure you want to delete this product?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
