<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyType extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'company_types';
    const companyType = 'company_type';
    const companyTypeIcon = 'company_type_icon';
    const isSize = 'is_size';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::companyType,
        self::companyTypeIcon,
        self::isSize,
        self::createdAt,
        self::updatedAt
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    public function productTypes() {
        return $this->hasMany(ProductType::class);
    }
}
