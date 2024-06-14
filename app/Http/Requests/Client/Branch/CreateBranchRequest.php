<?php


namespace App\Http\Requests\Client\Branch;

use App\Models\Client\Area;
use App\Models\Client\CompanyBranch;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateBranchRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            CompanyBranch::areaId => ['required', 'integer', Rule::exists(Area::table, 'id')->whereNull(Area::deletedAt)],
            CompanyBranch::address => ['required', 'string'],
            CompanyBranch::phone => ['required', 'string']
        ];
    }


}
