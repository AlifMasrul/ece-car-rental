@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Pending Cancellation Requests</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User</th>
                <th>Car(s)</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Requested Cancellation At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingCancellations as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>
                        @foreach ($booking->cars as $car)
                            {{ $car->brand }} {{ $car->model }} ({{ $car->plate_number }})<br>
                        @endforeach
                    </td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>{{ $booking->cancellation_requested_at }}</td>
                    <td>
                        <form action="{{ route('admin.cancellations.approve', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Approve Cancellation</button>
                        </form>
                        <form action="{{ route('admin.cancellations.reject', $booking->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger">Reject Cancellation</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No pending cancellation requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection