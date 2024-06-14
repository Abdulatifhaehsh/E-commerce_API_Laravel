<?php


namespace App\Http\Requests\Product\Product;

use App\Models\Client\City;
use App\Models\Product\CompanyType;
use App\Models\Product\Product;
use App\Models\Product\ProductType;
use App\Models\Product\Size;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class GetProductRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => ['required', 'integer'],
            'city_id' => ['required', 'integer',
                    Rule::exists(City::table, 'id')->whereNull(City::deletedAt)],
            Product::productTypeId => ['nullable', 'integer',
                    Rule::exists(ProductType::table, 'id')->whereNull(ProductType::deletedAt)],
            ProductType::companyTypeId => ['nullable', 'integer',
                Rule::exists(CompanyType::table, 'id')->whereNull(CompanyType::deletedAt)],
            'keyword' => ['string', 'nullable'],
            'min_price' => ['numeric', 'nullable'],
            'max_price' => ['numeric', 'nullable'],
            'sizes' => ['array', 'nullable'],
            'colors' => ['array', 'nullable'],
            'sizes.*' => ['integer', Rule::exists(Size::table, 'id')->whereNull(Size::deletedAt)],
            'colors.*' => ['string'],

        ];
    }


}
