<?php


namespace App\Http\Requests\Payment\Payment;

use App\Models\Client\User;
use App\Models\Payment\Payment;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DepositPaymentRequset extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => ['required', 'numeric'],
            Payment::toUserId => ['required', 'integer', Rule::exists(User::table, 'id')->whereNull(User::deletedAt)],
        ];
    }


}
