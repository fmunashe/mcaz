<?php

namespace App;

use App\Models\ProductDefect;

trait OTPGeneration
{
    public function generateOTP(): int
    {
        return rand(1000, 9999);
    }

    public function generateReferenceNumber(): string
    {
        return "REF-" . rand(10000, 999999);
    }

    function getProductDefectByReference($reference): ?ProductDefect
    {
        return ProductDefect::query()->where('report_number', $reference)->first();
    }
}
