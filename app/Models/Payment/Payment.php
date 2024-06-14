<?php

namespace App\Models\Payment;

use App\Models\Client\User;
use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends BaseModel
{
    use HasFactory;

    const table = 'payments';

    const uuid = 'uuid';
    const value = 'value';
    const status = 'status';
    const currency = 'currency';
    const fromUserId = 'from_user_id';
    const toUserId = 'to_user_id';
    const reservationId = 'reservation_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::uuid,
        self::value,
        self::status,
        self::currency,
        self::fromUserId,
        self::toUserId,
        self::reservationId
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $casts = [
        self::fromUserId => 'integer',
        self::toUserId => 'integer',
        self::reservationId => 'integer'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, self::fromUserId);
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, self::toUserId);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, self::reservationId);
    }
}
