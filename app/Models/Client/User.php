<?php

namespace App\Models\Client;

use App\Models\Product\Product;
use Hashash\ProjectService\Traits\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, ModelTrait;

    const table = 'users';
    const username = 'username';
    const email = 'email';
    const password = 'password';
    const userType = 'user_type';
    const firstName = 'first_name';
    const lastName = 'last_name';
    const gender = 'gender';
    const birthday = 'birthday';
    const image = 'image';
    const phoneNumber = 'phone_number';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::username,
        self::email,
        self::password,
        self::userType,
        self::firstName,
        self::lastName,
        self::gender,
        self::birthday,
        self::image,
        self::phoneNumber,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::password,
        self::deletedAt
    ];


    protected $casts = [
        self::birthday => 'date',
    ];

    protected $with = [
        'wallet'
    ];

    protected function password() : Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value)
        );
    }


    public function company() {
        return $this->hasOne(Company::class);
    }

    public function wallet() {
        return $this->hasOne(Wallet::class);
    }

    public function companyProducts() {
        return $this->hasMany(Product::class)->orderBy('id', 'DESC');
    }

    public function tokenApi(User $user) {
        return $user->createToken('my-store', [$user->user_type])->accessToken;
    }








}
