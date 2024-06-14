<?php

use App\Enums\Client\GenderType;
use App\Enums\Client\UserType;
use App\Models\Client\User;
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
        Schema::create(User::table, function (Blueprint $table) {
            $table->id();
            $table->string(User::username)->unique();
            $table->string(User::email)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string(User::password);
            $table->enum(User::userType, UserType::getValues())->default(UserType::user);
            $table->string(User::firstName);
            $table->string(User::lastName);
            $table->enum(User::gender, GenderType::getValues())->nullable();
            $table->date(User::birthday)->nullable();
            $table->string(User::image)->nullable();
            $table->string(User::phoneNumber)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists(User::table);
    }
};
