<?php


namespace App\Http\Requests\Product\Product;

use App\Models\Client\Area;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductType;
use App\Models\Product\Size;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Product::productTypeId => ['required', 'integer',
                    Rule::exists(ProductType::table, 'id')->whereNull(ProductType::deletedAt)],
            Product::areaId => ['required', 'integer',
                    Rule::exists(Area::table, 'id')->whereNull(Area::deletedAt)],
            Product::isSold => ['boolean'],
            Product::price => ['required', 'numeric'],
            Product::description => ['string', 'required'],
            Product::title => ['string', 'required'],
            Product::percent => ['integer', 'min:1', 'max:99'],
            Product::amount => ['integer', 'min:1', 'required'],
            'sizes' => ['array'],
            'images' => ['array', 'min:3', 'required'],
            'colors' => ['array', 'min:1', 'required'],
            'images.*' => ['file'],
            'sizes.*' => ['integer', Rule::exists(Size::table, 'id')->whereNull(Size::deletedAt)],
            'colors.*' => ['string']
        ];
    }


}
