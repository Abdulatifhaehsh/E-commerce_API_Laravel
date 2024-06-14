<?php

namespace App\Models\Payment;

use App\Models\Client\Company;
use App\Models\Client\User;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\Size;
use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends BaseModel
{
    use HasFactory;

    const table = 'reservations';
    const productId = 'product_id';
    const userId = 'user_id';
    const amount = 'amount';
    const colorId = 'color_id';
    const sizeId = 'size_id';
    const note = 'note';
    const completed = 'completed';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::productId,
        self::userId,
        self::amount,
        self::colorId,
        self::sizeId,
        self::note,
        self::completed,
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $dates = [];

    protected $casts = [
        self::productId => 'integer',
        self::userId => 'integer',
        self::amount => 'integer',
        self::colorId => 'integer',
        self::sizeId => 'integer',
        self::completed => 'boolean'
    ];

    protected $with = ['color', 'size'];


    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function company() {
        return $this->hasOneThrough(
            Company::class,
            Product::class,
            'user_id',
            'user_id',
            'product_id',
            'id'

        );
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }

    public function getReservationForCompany($ownerUserId = null) {
        return Reservation::where(self::completed, false)
                            ->with(['product.mainImage', 'user', 'payment'])
                            ->whereHas('product', function ($products) use ($ownerUserId) {
                                    return $products->where(Product::userId , $ownerUserId);
                            })->orderBy('id', 'DESC')
                            ->get();
    }



}
