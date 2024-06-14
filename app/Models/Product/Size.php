<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'sizes';
    const size = 'size';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';


    protected $table = self::table;

    protected $fillable = [
        self::size
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];
}
