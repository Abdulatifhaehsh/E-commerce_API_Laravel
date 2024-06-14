<?php


namespace App\Http\Requests\Payment\Reservation;

use App\Models\Payment\Payment;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class ConfirmReservationRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Payment::uuid => ['required', 'string', Rule::exists(Payment::table, Payment::uuid)->whereNull(Payment::deletedAt)]
        ];
    }


}
