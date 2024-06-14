<?php


namespace App\Http\Requests\Product\Product;

use App\Models\Product\Product;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class GetProductByIdRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', Rule::exists(Product::table, 'id')->whereNull(Product::deletedAt)]
        ];
    }


}
