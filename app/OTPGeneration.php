<?php

namespace App;

trait OTPGeneration
{
    public function generateOTP(): int
    {
        return rand(1000, 9999);
    }
}
