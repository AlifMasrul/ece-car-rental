@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Booking History</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($bookings->isEmpty())
    <p>You have no bookings yet.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Car</th>
                <th>Branch</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Requested At</th>
                <th>Status</th>
                <th>Cancellation Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>
                    @foreach ($booking->cars as $car)
                    {{ $car->brand }} {{ $car->model }} ({{ $car->plate_number }})<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($booking->cars as $car)
                    {{ $car->branch->name ?? 'N/A' }}<br>
                    @endforeach
                </td>
                <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}</td>
                <td class="{{ strtolower($booking->booking_status) == 'approved' ? 'bg-success text-white' : (strtolower($booking->booking_status) == 'rejected' ? 'bg-danger text-white' : (strtolower($booking->booking_status) == 'pending' ? 'bg-warning text-dark' : '')) }}">
                    {{ ucfirst($booking->booking_status ?? 'Pending') }}
                </td>
                <td class="{{ strtolower($booking->cancellation_status) == 'approved' ? 'bg-success text-white' : (strtolower($booking->cancellation_status) == 'rejected' ? 'bg-danger text-white' : (strtolower($booking->cancellation_status) == 'pending' ? 'bg-warning text-dark' : '')) }}">
                    {{ $booking->cancellation_status ? ucfirst($booking->cancellation_status) : 'N/A' }}
                </td>
                <td>
                    @if (!$booking->cancellation_status || strtolower($booking->cancellation_status) !== 'approved')
                    @if (\Carbon\Carbon::now()->isBefore($booking->start_date))
                    <form action="{{ route('bookings.request-cancellation', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-warning">Request Cancellation</button>
                    </form>
                    @else
                    <span class="text-muted">Cancellation not available</span>
                    @endif
                    @else
                    <span class="text-success">Cancellation Approved</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection