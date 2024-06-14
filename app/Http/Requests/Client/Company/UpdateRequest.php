<?php


namespace App\Http\Requests\Client\Company;

use App\Models\Client\Company;
use Hashash\ProjectService\Bases\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Company::name => ['string'],
            Company::logo => ['file'],
            Company::facadeUrl => ['file'],
            Company::mobile => ['string'],
        ];
    }


}
