<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'product_images';
    const productId = 'product_id';
    const image = 'image';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::productId,
        self::image
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $casts = [
        self::productId => 'integer'
    ];
}
