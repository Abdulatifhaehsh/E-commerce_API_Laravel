<?php

namespace App\Models\Product;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecificationType extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'specification_types';
    const specificationsType =  'specifications_type';
    const specificationsIcon = 'specifications_icon';
    const companyTypeId =  'company_type_id';
    const values = 'values';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::specificationsType,
        self::specificationsIcon,
        self::companyTypeId,
        self::values
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $casts = [
        self::companyTypeId => 'integer'
    ];
}
