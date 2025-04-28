@extends('layouts.admin-layout')
@section('title', 'Data roles')

@section('content')
<div class="container mt-4">
    <section class="section">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">@isset($title) {{ $title }} @endisset</h5>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mt-4 mb-3">
                            <div align="left" class="mb-3">
                                <a class="btn btn-primary" href="{{ route('role.create') }}">Add Role</a>
                            </div>
                            <table class="table table-bordered table-striped table-hover">
                                <thead align="center" class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    @php $no=1; @endphp
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->is_active }}</td>
                                        <td>
                                            <a href="{{ route('role.edit', $data->id) }}" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('role.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection