<?php


namespace App\Http\Requests\Client\User;

use App\Models\Client\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class SignUpRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::username => ['string', 'required',
                                Rule::unique(User::table, User::username)->whereNull(User::deletedAt)],
            User::password => ['string', 'min:4', 'required'],
            User::firstName => ['string', 'required'],
            User::lastName => ['string', 'required'],
            User::phoneNumber => ['string', 'required',
                                    Rule::unique(User::table, User::phoneNumber)->whereNull(User::deletedAt)],
            User::gender => ['nullable', 'string'],
            User::image => ['nullable', 'file'],
            User::birthday => ['nullable', 'date_format:Y-m-d'],
        ];
    }


}
