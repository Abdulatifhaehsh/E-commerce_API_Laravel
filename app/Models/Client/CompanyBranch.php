<?php

namespace App\Models\Client;

use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyBranch extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'company_branches';
    const companyId = 'company_id';
    const address = 'address';
    const phone = 'phone';
    const areaId = 'area_id';
    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $fillable = [
        self::companyId,
        self::address,
        self::phone,
        self::areaId
    ];

    protected $table = self::table;

    protected $hidden = [
        self::deletedAt,
        self::updatedAt,
        self::createdAt
    ];

    protected $casts = [
        self::areaId => 'integer',
        self::companyId => 'integer'
    ];

    public function area() {
        return $this->belongsTo(Area::class);
    }

}
