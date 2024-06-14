<?php



namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSpecificationType extends BaseModel
{
    use HasFactory;

    const table = 'products_specifications';
    const productId = 'prodcut_id';
    const specificationTypeId = 'specification_type_id';
    const value = 'value';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [self::productId, self::specificationTypeId, self::value, self::createdAt];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $dates = [];

    protected $casts = [
        self::productId => 'integer',
        self::specificationTypeId => 'integer'
    ];

}
