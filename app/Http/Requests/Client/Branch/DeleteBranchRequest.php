<?php


namespace App\Http\Requests\Client\Branch;

use App\Models\Client\CompanyBranch;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteBranchRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id' => ['required', 'integer', Rule::exists(CompanyBranch::table, 'id')->whereNull(CompanyBranch::deletedAt)],
        ];
    }


}
