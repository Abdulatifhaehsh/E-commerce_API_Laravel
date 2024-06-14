<?php

namespace App\Services;
use App\DTO\Payment\ItemDetailDTO;
use App\Enums\Payment\PaymentStatus;
use App\Models\Client\User;
use App\Models\Payment\Payment;
use Hashash\ProjectService\Helpers\OperationResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PaymentService
{
    private OperationResult $OperationResult;
    private Payment $payment;
    private $currentResponse;
    private User $user;

    public function __construct(OperationResult $OperationResult, Payment $payment,User $user)
    {
        $this->OperationResult = $OperationResult;
        $this->payment = $payment;
        $this->user= $user;
    }

    public function createOrder($itemDetail): OperationResult
    {
        $fromUser = $this->user->findData(['id' => $itemDetail['from_user_id']]);
        $toUser = $this->user->findData(['id' => $itemDetail['to_user_id']]);
        if($fromUser->wallet->available  >= $itemDetail['price'] ){
            $this->currentResponse = $this->payment->createData([
                'uuid' => Str::uuid(),
                'value' => $itemDetail['price'],
                'to_user_id' => $itemDetail['to_user_id'],
                'currency' => 'SYP',
                'from_user_id' => $itemDetail['from_user_id'],
                'status' => PaymentStatus::Successed,
            ]);
            if (empty($this->currentResponse)) {
                $this->OperationResult->isSuccess = false;
                $this->OperationResult->status = 500;
                $this->OperationResult->data = 'could not create order';
            } else {
                $fromUser->wallet->available -= $itemDetail['price'];
                $fromUser->wallet->total -= $itemDetail['price'];
                $fromUser->wallet->save();
                $toUser->wallet->available += $itemDetail['price'];
                $toUser->wallet->total += $itemDetail['price'];
                $toUser->wallet->save();
                $this->OperationResult->data = $this->currentResponse;
                $this->OperationResult->isSuccess = true;
                $this->OperationResult->status = 220;
            }
        }else{
            $this->OperationResult->isSuccess = false;
            $this->OperationResult->status = 520;
            $this->OperationResult->data = 'not enough money';
        }
        return $this->OperationResult;
    }

    public function captureOrder($currency, $itemDetail): OperationResult
    {
        $user = $this->user->findData(['id' => $itemDetail['from_user_id']]);
        if($user->wallet->available  >= $itemDetail['price'] ){
            $this->currentResponse = $this->payment->createData([
                'uuid' => Str::uuid(),
                'value' => $itemDetail['price'],
                'reservation_id' => $itemDetail['id'],
                'to_user_id' => $itemDetail['to_user_id'],
                'currency' => $currency ?? 'SYP',
                'from_user_id' => $itemDetail['from_user_id'],
                'status' => PaymentStatus::Pending,
            ]);
            if (empty($this->currentResponse)) {
                $this->OperationResult->isSuccess = false;
                $this->OperationResult->status = 500;
                $this->OperationResult->data = 'could not create order';
            } else {
                $user->wallet->available -= $itemDetail['price'];
                $user->wallet->pending += $itemDetail['price'];
                $user->wallet->save();
                $this->OperationResult->data = $this->currentResponse;
                $this->OperationResult->isSuccess = true;
                $this->OperationResult->status = 220;
            }
        }else{
            $this->OperationResult->isSuccess = false;
            $this->OperationResult->status = 520;
            $this->OperationResult->data = 'not enough money';
        }
        return $this->OperationResult;
    }

    public function authorizeOrder($orderId)
    {
        $payment = $this->payment->findData(['uuid' => $orderId]);
        if (Auth::user()->userWallet->available_value  >= $payment->value )
           return $this->payment->updateData(['uuid' => $orderId], [
                'status' => PaymentStatus::Approved
            ]);
            return false;
    }

    public function checkCapturableOrder($orderId): OperationResult
    {
        $payment = $this->payment->findCapturablePayment($orderId);
        $result = !empty($payment);
        $this->OperationResult->isSuccess = $result;
        $this->OperationResult->status = $result ? 220 : 500;
        return $this->OperationResult;
    }

    public function confirmOrder($uuid, $toUserId): OperationResult
    {
        $payment = $this->payment->findData([Payment::uuid => $uuid, Payment::status => PaymentStatus::Pending, Payment::fromUserId => $toUserId]);
        if (empty($payment)) {
            $this->OperationResult->isSuccess = false;
            $this->OperationResult->status =  500;
            return $this->OperationResult;
        }

        $fromUser = $this->user->findData(['id' => $payment[Payment::fromUserId]]);
        $toUser = $this->user->findData(['id' => $payment[Payment::toUserId]]);
        $payment->status = PaymentStatus::Successed;
        $fromUser->wallet->pending -= $payment[Payment::value];
        $fromUser->wallet->total -= $payment[Payment::value];
        $fromUser->wallet->save();
        $toUser->wallet->available += $payment[Payment::value];
        $toUser->wallet->total += $payment[Payment::value];
        $toUser->wallet->save();
        $payment->save();
        $this->OperationResult->isSuccess = true;
        $this->OperationResult->status =  220 ;
        $this->OperationResult->data =  $payment;
        return $this->OperationResult;
    }

    public function getCurrentResponse()
    {
        return $this->currentResponse;
    }


}
