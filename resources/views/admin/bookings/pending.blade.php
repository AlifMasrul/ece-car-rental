@extends('layouts.admin2')

@section('content')
<div class="container">
    <h1>Pending Booking Requests</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Car</th>
                <th>Branch</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Requested At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingBookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->cars->first()->brand }} {{ $booking->cars->first()->model }} ({{ $booking->cars->first()->plate_number }})</td>
                    <td>{{ $booking->cars->first()->branch->name }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>{{ $booking->created_at }}</td>
                    <td>
                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No pending booking requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection