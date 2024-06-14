<?php

namespace App\Models\Product;

use App\Models\Client\Area;
use App\Models\Client\Company;
use App\Models\Client\User;
use Hashash\ProjectService\Bases\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory, SoftDeletes;

    const table = 'products';
    const userId = 'user_id';
    const productTypeId = 'product_type_id';
    const isSold = 'is_sold';
    const price =  'price';
    const description = 'description';
    const title = 'title';
    const endDate =  'end_date';
    const active = 'active';
    const areaId = 'area_id';
    const view =  'view';
    const percent = 'percent';
    const amount = 'amount';

    const createdAt = 'created_at';
    const updatedAt = 'updated_at';
    const deletedAt = 'deleted_at';

    protected $table = self::table;

    protected $fillable = [
        self::userId,
        self::productTypeId,
        self::isSold,
        self::price,
        self::description,
        self::title,
        self::endDate,
        self::active,
        self::areaId,
        self::view,
        self::percent,
        self::amount
    ];


    protected $hidden = [
        self::deletedAt,
        self::updatedAt
    ];


    protected $casts = [
        self::userId => 'integer',
        self::productTypeId => 'integer',
        self::isSold => 'boolean',
        self::active => 'boolean',
        self::areaId => 'integer',
        self::percent => 'integer',
        self::view => 'integer',
        self::amount => 'integer'
    ];

    public function productType() {
        return $this->belongsTo(ProductType::class)->with('companyType');
    }

    public function colors() {
        return $this->belongsToMany(Color::class, 'colors_products');
    }

    public function sizes() {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }

    public function specificationTypes() {
        return $this->belongsToMany(SpecificationType::class);
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function mainImage() {
        return $this->hasOne(ProductImage::class);
    }

    public function company() {
        return $this->hasOneThrough(Company::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }


    public function getProduct($data)
    {
        $products = Product::query();

        if(!empty($data['city_id']))
            $products->whereHas('area', function ($areas) use ($data) {
                $areas->where('city_id', $data['city_id']);
            });

        if(!empty($data[self::productTypeId]))
            $products->where(self::productTypeId, $data[self::productTypeId]);

        if(!empty($data['company_type_id']))
            $products->whereHas('productType', function ($productTypes) use ($data) {
                 $productTypes->where('company_type_id', $data['company_type_id']);
            });

        if(!empty($data['sizes']))
            $products->whereHas('sizes', function ($sizes) use ($data) {
                $sizes->whereIn('sizes.id', $data['sizes']);
            });

        if(!empty($data['colors']))
            $products->whereHas('colors', function ($colors) use ($data) {
                $colors->whereIn('color', $data['colors']);
            });


        if(!empty($data['min_price']))
            $products->where(self::price, '>=', $data['min_price']);

        if(!empty($data['max_price']))
            $products->where(self::price, '<=', $data['max_price']);

        if(!empty($data['keyword'])) {
            $keywords = explode(' ', $data['keyword']);
            $products->where(function ($query) use ($keywords) {
                foreach($keywords as $keyword) {
                    $query->orWhere(self::title, 'like','%' . $keyword . '%')
                        ->orWhere(self::description, 'like', '%' . $keyword . '%')
                        ->orWhere(self::price, 'like', '%' . $keyword . '%');
                }
            });

        }

        $products->with('mainImage');

        $products->paginate(10);

        return $products->orderBy("products.created_at" , 'DESC')->get();
    }

    public function getProductById($productId)
    {
        return Product::where('id', $productId)
                        ->with(['productImages', 'sizes', 'colors', 'company'])
                        ->first();

    }
}
