<?php

namespace App;

use App\Models\Defect;
use App\Models\Gender;
use App\Models\ProductDefect;
use Illuminate\Database\Eloquent\Collection;

trait OTPGeneration
{
    public function generateOTP(): int
    {
        return rand(1000, 9999);
    }

    public static function generateReferenceNumber(): string
    {
        return "REF-" . rand(10000, 999999);
    }

    function getProductDefectByReference($reference): ?ProductDefect
    {
        return ProductDefect::query()->where('report_number', $reference)->first();
    }

    function getDefectByName($defect): ?Defect
    {
        return Defect::query()->where('name', $defect)->first();
    }

    public function getDefects(): Collection
    {
        return Defect::all();
    }

    public function getGenderByName($gender)
    {
        return Gender::where('gender','=',$gender)->first();
    }
}
