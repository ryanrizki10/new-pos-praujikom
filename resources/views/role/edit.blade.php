@extends('layouts.main')
@section('title', 'Edit User')
@section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">EDIT USER</h5>


                            <form action="{{ route('roles.update', $Role->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control"
                                       id="name" name="name" value="{{ old('name', $Role->name) }}" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection