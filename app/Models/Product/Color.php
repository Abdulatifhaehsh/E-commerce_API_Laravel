<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends BaseModel
{
    use HasFactory, SoftDeletes;


    const table = 'colors';
    const color = 'color';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::color
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];
}
