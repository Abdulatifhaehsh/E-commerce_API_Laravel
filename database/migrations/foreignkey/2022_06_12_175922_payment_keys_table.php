<?php

use App\Models\Client\User;
use App\Models\Payment\Payment;
use App\Models\Payment\Reservation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Payment::table, function (Blueprint $table) {
            $table->foreignId(Payment::fromUserId)->constrained(User::table, 'id');
            $table->foreignId(Payment::toUserId)->constrained(User::table, 'id');
            $table->foreignId(Payment::reservationId)->nullable()->constrained();
        });

        Schema::table(Reservation::table, function (Blueprint $table) {
            $table->foreignId(Reservation::userId)->constrained();
            $table->foreignId(Reservation::sizeId)->constrained();
            $table->foreignId(Reservation::colorId)->constrained();
            $table->foreignId(Reservation::productId)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
