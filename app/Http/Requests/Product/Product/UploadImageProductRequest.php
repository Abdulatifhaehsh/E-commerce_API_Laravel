<?php


namespace App\Http\Requests\Product\Product;


use Hashash\ProjectService\Bases\BaseFormRequest;

class UploadImageProductRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['file', 'required']
        ];
    }


}
