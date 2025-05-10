@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cancellation Requests Pending</h1>

    @if ($pendingCancellations->isEmpty())
        <p>You have no pending cancellation requests.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Cars</th>
                    <th>Requested At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingCancellations as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>
                            @foreach ($booking->cars as $car)
                                {{ $car->brand }} {{ $car->model }} ({{ $car->plate_number }})<br>
                            @endforeach
                        </td>
                        <td>{{ $booking->cancellation_requested_at ? $booking->cancellation_requested_at->format('Y-m-d H:i:s') : '-' }}</td>
                        <td>{{ $booking->cancellation_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection