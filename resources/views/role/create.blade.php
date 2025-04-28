@extends('layouts.admin-layout')
@section('page-title', 'Create Product')


@section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Add User</h5>

                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        <div align="center">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('role.index') }}" class="btn btn-danger">Cancel</a>
                            <a href="{{ url()->previous() }}" class="btn btn-warning">Back</a>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection