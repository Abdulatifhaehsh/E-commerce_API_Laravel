<?php

namespace App\Models\Client;

use App\Models\Product\CompanyType;
use App\Models\Product\Product;
use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'companies';
    const name = 'name';
    const logo = 'logo';
    const mobile =  'mobile';
    const userId =  'user_id';
    const companyTypeId =  'company_type_id';
    const facadeUrl =  'facade_url';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::name,
        self::logo,
        self::mobile,
        self::userId,
        self::companyTypeId,
        self::facadeUrl,
        self::createdAt,
        self::updatedAt
    ];

    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];

    protected $casts = [
        self::userId => 'integer',
        self::companyTypeId => 'integer'
    ];

    public function companyBranches() {
        return $this->hasMany(CompanyBranch::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function companyType() {
        return $this->belongsTo(CompanyType::class);
    }

    public function companyProducts() {
        return $this->hasManyThrough(Product::class, User::class, 'id', 'user_id', 'user_id', 'id')->orderBy('id', 'DESC');
    }



}
