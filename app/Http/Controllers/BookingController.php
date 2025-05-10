<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create($car_id)
    {
        $car = Car::with('branch')->findOrFail($car_id);

        return view('bookings.create', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:' . now()->addDays(2)->format('Y-m-d'),
            'end_date' => 'required|date|after:start_date',
        ]);

        $carId = $request->car_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $customerId = Auth::id();

        // Check for overlapping bookings for the selected car (existing approved or pending)
        $overlappingCarBooking = Booking::whereHas('cars', function ($query) use ($carId) {
            $query->where('car_id', $carId);
        })
            ->whereIn('booking_status', ['pending', 'approved']) // Check for pending or approved bookings
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                    ->where('end_date', '>', $startDate);
            })
            ->exists();

        if ($overlappingCarBooking) {
            return back()->withErrors(['booking_conflict' => 'This car is already booked for the selected dates. Please choose different dates.'])->withInput();
        }

        // Check the number of existing pending or approved bookings by the current user that overlap
        $overlappingUserBookingsCount = Booking::where('customer_id', $customerId)
            ->whereIn('booking_status', ['pending', 'approved']) // Check pending or approved bookings
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<', $endDate)
                    ->where('end_date', '>', $startDate);
            })
            ->count();

        if ($overlappingUserBookingsCount >= 2) {
            return back()->withErrors(['customer_limit' => 'You have already requested/booked the maximum of two cars for this period.'])->withInput();
        }

        $booking = new Booking();
        $booking->customer_id = $customerId;
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->booking_status = 'pending'; // Set the booking_status to pending
        $booking->save();

        $booking->cars()->attach($carId);

        return redirect()->route('bookings.success')->with('success', 'Your booking request has been submitted and is pending approval.');
    }
    public function requestCancellation(Booking $booking)
    {
        // Ensure the booking belongs to the logged-in user
        if ($booking->customer_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to cancel this booking.');
        }

        // Ensure cancellation is requested before the start date
        if (\Carbon\Carbon::now()->isAfter($booking->start_date)) {
            return back()->with('error', 'You cannot request cancellation for a booking that has already started.');
        }

        $booking->cancellation_requested_at = now();
        $booking->cancellation_status = 'pending'; // You might need to add these columns to your bookings table
        $booking->save();

        return back()->with('success', 'Cancellation requested successfully. Your request is pending admin approval.');
    }
    public function adminPendingBookings()
    {
        $pendingBookings = Booking::where('booking_status', 'pending')
            ->with(['user', 'cars.branch']) // Eager load user and car with branch
            ->get();

        return view('admin.bookings.pending', compact('pendingBookings'));
    }
    public function adminApproveBooking(Booking $booking)
    {
        $booking->booking_status = 'approved';
        $booking->save();
        return redirect()->route('admin.bookings.pending')->with('success', 'Booking approved successfully.');
    }
    public function adminRejectBooking(Booking $booking)
    {
        $booking->booking_status = 'rejected';
        $booking->save();
        return redirect()->route('admin.bookings.pending')->with('success', 'Booking rejected successfully.');
    }
    public function adminBookingHistory()
    {
        $bookings = Booking::with(['user', 'cars.branch'])
            ->whereIn('booking_status', ['approved', 'rejected', 'cancelled']) // Only get approved, rejected, or cancelled bookings
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.history', compact('bookings'));
    }
    public function adminPendingCancellations()
    {
        $pendingCancellations = Booking::whereNotNull('cancellation_requested_at')
            ->where('cancellation_status', 'pending')
            ->with(['user', 'cars'])
            ->get();

        return view('admin.bookings.cancellations', compact('pendingCancellations'));
    }

    public function adminApproveCancellation(Booking $booking)
    {
        $booking->cancellation_status = 'approved';
        $booking->save();
        return redirect()->route('admin.cancellations.pending')->with('success', 'Cancellation approved successfully.');
    }

    public function adminRejectCancellation(Booking $booking)
    {
        $booking->cancellation_status = 'rejected';
        $booking->cancellation_requested_at = null; // Optionally reset the requested at timestamp
        $booking->save();
        return redirect()->route('admin.cancellations.pending')->with('success', 'Cancellation rejected successfully.');
    }
}
