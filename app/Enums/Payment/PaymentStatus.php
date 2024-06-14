<?php

namespace App\Enums\Payment;

use BenSampo\Enum\Enum;


final class PaymentStatus extends Enum
{
    const Created = "CREATED";
    const Approved = "APPROVED";
    const Pending = "PENDING";
    const Captured = "CAPTURED";
    const Successed = "SUCCESSED";
    const Failed = "FAILED";
}
