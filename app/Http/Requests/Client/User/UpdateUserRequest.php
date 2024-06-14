<?php


namespace App\Http\Requests\Client\User;

use App\Models\Client\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::firstName => ['string'],
            User::lastName => ['string'],
            User::phoneNumber => ['string', 'required',
                                    Rule::unique(User::table, User::phoneNumber)->whereNot('id',$this->user()->id)->whereNull(User::deletedAt)],
            User::gender => ['nullable', 'string'],
            User::image => ['nullable', 'file'],
            User::birthday => ['nullable', 'date_format:Y-m-d'],
        ];
    }


}
