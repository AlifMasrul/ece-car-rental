@extends('layouts.user')

@section('content')
<div class="container">
    <h1>{{ __('Your Cancellation Requests') }}</h1>
    @if ($pendingCancellations->isEmpty())
        <p>{{ __('No cancellation requests found.') }}</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Booking ID') }}</th>
                    <th>{{ __('Car Model') }}</th>
                    <th>{{ __('Start Date') }}</th>
                    <th>{{ __('End Date') }}</th>
                    <th>{{ __('Requested At') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingCancellations as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->car->model ?? 'N/A' }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>{{ $booking->cancellation_requested_at }}</td>
                        <td>{{ $booking->cancellation_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection