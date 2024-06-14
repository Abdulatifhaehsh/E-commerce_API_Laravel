<?php

namespace App\Models\Client;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'cities';
    const city = 'city';
    const countryId = 'country_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::city,
        self::countryId,
        self::createdAt,
        self::updatedAt,
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    protected $casts = [
        self::countryId => 'integer'
    ];

    public function areas() {
        return $this->hasMany(Area::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
