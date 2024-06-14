<?php


namespace App\Http\Requests\Client\Company;

use App\Enums\Client\UserType;
use App\Models\Client\Area;
use App\Models\Client\Company;
use App\Models\Client\CompanyBranch;
use App\Models\Product\CompanyType;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseFormRequest
{

    public function authorize()
    {
        return $this->user()->user_type == UserType::user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Company::name => ['string', 'required'],
            Company::logo => ['file', 'required'],
            Company::facadeUrl => ['file', 'required'],
            Company::mobile => ['string', 'required'],
            Company::companyTypeId => ['required', 'integer',
                        Rule::exists(CompanyType::table, 'id')->whereNull(CompanyType::deletedAt)],
            'branches' => ['array', 'required', 'min:1'],
            'branches.*.'.CompanyBranch::areaId => ['required', 'integer', Rule::exists(Area::table, 'id')->whereNull(Area::deletedAt)],
            'branches.*.'.CompanyBranch::address => ['required', 'string'],
            'branches.*.'.CompanyBranch::phone => ['required', 'string']
        ];
    }


}
