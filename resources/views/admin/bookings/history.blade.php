@extends('layouts.admin2')

@section('content')
<div class="container">
    <h1>All Booking History</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User</th>
                <th>Car</th>
                <th>Branch</th>
                <th>Start Date</th>
                <th>End Date</th>

                <th>Booking Status</th>
                <th>Requested Date</th>
                <th>Cancellation Status</th>

                <th>Cancellation Requested Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->cars->first()->brand }} {{ $booking->cars->first()->model }} ({{ $booking->cars->first()->plate_number }})</td>
                <td>{{ $booking->cars->first()->branch->name }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}</td>
                <td class="{{ strtolower($booking->booking_status) == 'approved' ? 'bg-success text-white' : (strtolower($booking->booking_status) == 'rejected' ? 'bg-danger text-white' : '') }}">
                    {{ ucfirst($booking->booking_status) }}
                </td>
                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}</td>
                <td class="{{ strtolower($booking->cancellation_status) == 'approved' ? 'bg-success text-white' : (strtolower($booking->cancellation_status) == 'rejected' ? 'bg-danger text-white' : (strtolower($booking->cancellation_status) == 'pending' ? 'bg-warning text-dark' : '')) }}">
                    {{ $booking->cancellation_status ? ucfirst($booking->cancellation_status) : 'N/A' }}
                </td>
                <td>{{ $booking->cancellation_requested_at ? \Carbon\Carbon::parse($booking->cancellation_requested_at)->format('Y-m-d') : 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10">No booking history available.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection