<?php



namespace App\Models\Client;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends BaseModel
{
    use HasFactory;

    const table = 'wallets';
    const total = 'total';
    const available = 'available';
    const pending = 'pending';
    const userId = 'user_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::total,
        self::available,
        self::pending,
        self::userId
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $dates = [];

    protected $casts = [
        self::total => 'integer',
        self::available => 'integer',
        self::pending => 'integer',
        self::userId => 'integer'
    ];

}
