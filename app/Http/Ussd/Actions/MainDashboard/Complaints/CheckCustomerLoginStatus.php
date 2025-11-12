<?php

namespace App\Http\Ussd\Actions\MainDashboard\Complaints;

use App\Http\Ussd\States\MainDashboard\Complaints\AnonymousCustomerComplaint;
use App\Http\Ussd\States\MainDashboard\Complaints\CustomerComplaint;
use Sparors\Ussd\Action;

class CheckCustomerLoginStatus extends Action
{
    public function run(): string
    {
        if ($this->record->get('isLoggedIn')) {
            return CustomerComplaint::class;
        }
        return AnonymousCustomerComplaint::class;
    }
}
