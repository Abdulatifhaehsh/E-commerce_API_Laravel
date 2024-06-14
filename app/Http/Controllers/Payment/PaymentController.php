<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\Payment\DepositPaymentRequset;
use App\Http\Requests\Payment\Payment\WithdrawPaymentRequset;
use App\Models\Payment\Payment;
use App\Services\PaymentService;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService, private Payment $payments)
    {

    }

    public function deposit(DepositPaymentRequset $request)
    {
        $data = $request->validated();
        $data[Payment::fromUserId] = $request->user()->id;
        $operationResult = $this->paymentService->createOrder($data);
        if(!$operationResult->isSuccess)
            return $operationResult->status == 520 ? ResponseHelper::invalidData($operationResult->data) : ResponseHelper::operationFail();
        return ResponseHelper::operationSuccess('Deposit operated successfully');
    }


    public function withdraw(WithdrawPaymentRequset $request)
    {
        $data = $request->validated();
        $data[Payment::toUserId] = $request->user()->id;
        $operationResult = $this->paymentService->createOrder($data);
        if(!$operationResult->isSuccess)
            return $operationResult->status == 520 ? ResponseHelper::invalidData($operationResult->data) : ResponseHelper::operationFail();
        return ResponseHelper::operationSuccess('Withdraw operated successfully');
    }

    public function getPayment(Request $request)
    {
        $getPayment = $this->payments->getData(relations:['fromUser', 'toUser', 'reservation']);
        return ResponseHelper::select($getPayment);
    }

}
