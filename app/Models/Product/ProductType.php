<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'product_types';
    const productType = 'product_type';
    const companyTypeId = 'company_type_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::productType,
        self::companyTypeId,
        self::createdAt
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    protected $casts = [
        self::companyTypeId => 'integer'
    ];

    public function companyType() {
        return $this->belongsTo(CompanyType::class);
    }

    public function specificationTypes() {
        return $this->hasMany(SpecificationType::class);
    }
}
