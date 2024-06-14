<?php

namespace App\Models\Client;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'areas';
    const area = 'area';
    const cityId = 'city_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::area,
        self::cityId,
        self::createdAt,
        self::updatedAt,
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    protected $casts = [
        self::cityId => 'integer'
    ];


    public function city() {
        return $this->belongsTo(City::class)->with('country');
    }
}
