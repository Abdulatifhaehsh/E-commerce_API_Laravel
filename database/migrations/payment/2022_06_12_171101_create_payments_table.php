<?php

use App\Enums\Payment\PaymentStatus;
use App\Models\Payment\Payment;
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
        Schema::create(Payment::table, function (Blueprint $table) {
            $table->id();
            $table->uuid(Payment::uuid)->unique();
            $table->enum(Payment::status, PaymentStatus::getValues())->default(PaymentStatus::Created);
            $table->float(Payment::value);
            $table->string(Payment::currency);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Payment::table);
    }
};
