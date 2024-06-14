<?php


namespace App\Http\Requests\Client\Company;

use App\Models\Client\Company;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class GetCompanyRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => [
                'required', 'integer', Rule::exists(Company::table, 'id')->whereNull(Company::deletedAt)
            ]
        ];
    }


}
