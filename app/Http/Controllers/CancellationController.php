<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\View\View;

class CancellationController extends Controller
{
    public function status(): View
    {
        $user = Auth::user();
        $bookingsWithCancellationStatus = Booking::where('customer_id', $user->id)
                                                    ->whereNotNull('cancellation_requested_at')
                                                    ->select('id', 'car_id', 'start_date', 'end_date', 'cancellation_requested_at', 'cancellation_status')
                                                    ->with('car:id,model')
                                                    ->get();

        return view('user.cancellation_status', compact('bookingsWithCancellationStatus'));
    }
}