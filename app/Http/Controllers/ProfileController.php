<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class ProfileController extends Controller
{
    public function history()
    {
        $user = Auth::user();
        $bookings = Booking::where('customer_id', $user->id)
            ->with('cars.branch') // Eager load cars and their branch
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.history', compact('bookings'));
    }

    public function pendingCancellations()
    {
        $user = Auth::user();
        $pendingCancellations = Booking::where('customer_id', $user->id)
            ->where('cancellation_status', 'pending')
            ->with('cars')
            ->get();

        return view('bookings.pending', compact('pendingCancellations'));
    }
}
