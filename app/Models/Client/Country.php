<?php

namespace App\Models\Client;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'countries';
    const country = 'country';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::country,
        self::createdAt,
        self::updatedAt,
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    public function cities() {
        return $this->hasMany(City::class)->with('areas');
    }


}
