<?php


namespace App\Http\Requests\Payment\Reservation;

use App\Models\Payment\Reservation;
use App\Models\Product\Color;
use App\Models\Product\Product;
use App\Models\Product\Size;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateReservationRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Reservation::productId => ['required', 'integer', Rule::exists(Product::table, 'id')->whereNull(Product::deletedAt)],
            Reservation::amount => 'required|integer',
            Reservation::colorId => ['required', 'integer', Rule::exists(Color::table, 'id')->whereNull(Color::deletedAt)],
            Reservation::sizeId => ['required', 'integer', Rule::exists(Size::table, 'id')->whereNull(Size::deletedAt)],
            Reservation::note => 'nullable|string',
        ];
    }


}
