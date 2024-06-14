<?php

namespace App\Http\Controllers\Payment;

use App\Enums\Payment\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\Reservation\ConfirmReservationRequest;
use App\Http\Requests\Payment\Reservation\CreateReservationRequest;
use App\Http\Requests\Payment\Reservation\GetReservationForCompanyRequest;
use App\Models\Payment\Payment;
use App\Models\Payment\Reservation;
use App\Models\Product\Product;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PaymentService;

class ReservationController extends Controller
{
    public function __construct(private Reservation $reservations, private PaymentService $paymentService)
    {

    }

    public function createReservation(CreateReservationRequest $request)
    {
        $reservationData = $request->validated();
        $reservationData[Reservation::userId] = $request->user()->id;
        DB::beginTransaction();
        $product = (new Product())->findData(['id' => $reservationData[Reservation::productId]]);
        if($request->user()->id == $product->user_id){
            DB::rollBack();
            return ResponseHelper::invalidData('you can not reserve your own product');
        }
        $createReservation = $this->reservations->createData($reservationData);
        if(empty($createReservation)){
            DB::rollBack();
            return ResponseHelper::creatingFail();
        }

        $price = $product->price;
        $toUserId = $product->user_id;
        $itemDetails = [
            'price' => $price*$reservationData[Reservation::amount],
            'id' => $createReservation->id,
            'to_user_id' => $toUserId,
            'from_user_id' => $request->user()->id,
        ];
        $operationResult = $this->paymentService->captureOrder('SYP', $itemDetails);
        if(!$operationResult->isSuccess) {
            DB::rollBack();
            return $operationResult->status == 520 ? ResponseHelper::invalidData($operationResult->data) : ResponseHelper::creatingFail();
        }

        DB::commit();
        $createReservation['payment'] = $operationResult->data;
        return ResponseHelper::create($createReservation);
    }

    public function confirmReservation(ConfirmReservationRequest $request)
    {
        DB::beginTransaction();
        $operationResult = $this->paymentService->confirmOrder($request->get(Payment::uuid), $request->user()->id);
        if(!$operationResult->isSuccess){
            DB::rollBack();
            return ResponseHelper::invalidData('reservation not found');
        }
        $updateReservation = $this->reservations->updateData(['id' => $operationResult->data->reservation_id], [Reservation::completed => true]);
        if(empty($updateReservation)){
            DB::rollBack();
            return ResponseHelper::operationFail();
        }
        DB::commit();
        return ResponseHelper::operationSuccess('reservation confirmed');
    }

    public function getReservationForCompany(GetReservationForCompanyRequest $request) {
        $userId = $request->user()->id;
        return ResponseHelper::select($this->reservations->getReservationForCompany($userId));
    }

    public function getReservationForUser(Request $request) {
        $userId = $request->user()->id;
        $reservations = $this->reservations->getData([Reservation::userId => $userId, Reservation::completed => false], relations:['product.company' , 'product.mainImage', 'payment']);
        return ResponseHelper::select($reservations);
    }
}
