@extends('layouts.admin-layout')

@section('page-title', 'Transaction Report')

@section('content')
<section class="py-5">
    <div class="container bg-white p-5 rounded shadow-sm">

        <h3 class="mb-4 fw-bold text-primary">Transaction Report</h3>

        <form method="GET" action="{{ route('pos.report') }}" class="row g-3 align-items-end mb-4">
            <div class="col-md-3">
                <label class="form-label fw-semibold">Filter</label>
                <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select Filter --</option>
                    <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>

            @if(request('filter') == 'daily')
            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Date</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}" onchange="this.form.submit()">
            </div>
            @elseif(request('filter') == 'weekly')
            <div class="col-md-3">
                <label class="form-label fw-semibold">Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            @elseif(request('filter') == 'monthly')
            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Month</label>
                <input type="month" name="month" class="form-control" value="{{ request('month') }}" onchange="this.form.submit()">
            </div>
            @endif

            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Change</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="text-center">
                        <td>{{ $orders->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="fw-semibold">{{ $order->order_code }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($order->order_amount, 2) }}</td>
                        <td>Rp {{ number_format($order->order_change, 2) }}</td>
                        <td>
                            <span class="badge {{ $order->order_status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $order->order_status == 1 ? 'Paid' : 'Unpaid' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</section>
@endsection
