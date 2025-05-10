<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->enum('booking_status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('booking_status');
    });
}
}
