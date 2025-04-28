@extends('layouts.admin-layout')
@extends('layouts.main')

@section('title', 'Edit Users')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm rounded">
                <div class="card-body p-5">
                    <h4 class="card-title mb-4 text-primary fw-bold">Edit User</h4>

                    <form action="{{ route('users.update', $edit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">User Name *</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter Your Name" required
                                value="{{ $edit->name }}">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email *</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Your Email" required
                                value="{{ $edit->email }}">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password (Leave blank to keep current)</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter new password (optional)">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block mb-2">Roles</label>
                            @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        id="role-{{ $role->id }}"
                                        {{ in_array($role->id, $edit->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-save me-1"></i> Save
                            </button>
                            <button type="reset" class="btn btn-danger btn-lg">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>

                    </form>

                </div> <!-- End card-body -->
            </div> <!-- End card -->
        </div>
    </div>
</section>
@endsection
