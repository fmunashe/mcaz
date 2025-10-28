<?php

namespace Database\Seeders;

use App\Models\UssdMenu;
use App\Models\UssdMenuOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UssdMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MAIN MENU
        $main = UssdMenu::create([
            'code' => 'MAIN_MENU',
            'title' => "Welcome to MCAZ.\nReport medicine or vaccine side effects or product quality issues, or submit a complaint or enquiry.\n1. Log In\n2. Register\n3. Continue without registering\n4. Help\n5. Exit",
            'type' => 'menu'
        ]);

        // Register branch
        $registerRole = UssdMenu::create([
            'code' => 'REGISTER_ROLE',
            'title' => "Select Role:\n1. Healthcare Worker\n2. Patient\n3. Other",
            'type' => 'menu'
        ]);

        UssdMenuOption::insert([
            ['ussd_menu_id' => $main->id, 'option_number' => '1', 'option_text' => 'Log In', 'next_menu_id' => null],
            ['ussd_menu_id' => $main->id, 'option_number' => '2', 'option_text' => 'Register', 'next_menu_id' => $registerRole->id],
            ['ussd_menu_id' => $main->id, 'option_number' => '3', 'option_text' => 'Continue without registering', 'next_menu_id' => null],
            ['ussd_menu_id' => $main->id, 'option_number' => '4', 'option_text' => 'Help', 'next_menu_id' => null],
            ['ussd_menu_id' => $main->id, 'option_number' => '5', 'option_text' => 'Exit', 'next_menu_id' => null],
        ]);

        // Registration flow
        $enterMobile = UssdMenu::create(['code' => 'ENTER_MOBILE', 'title' => 'Enter Mobile Number:', 'type' => 'input']);
        $enterName   = UssdMenu::create(['code' => 'ENTER_FULLNAME', 'title' => 'Enter Full Name:', 'type' => 'input']);
        $enterEmail  = UssdMenu::create(['code' => 'ENTER_EMAIL', 'title' => 'Enter Email Address:', 'type' => 'input']);
        $createUser  = UssdMenu::create(['code' => 'CREATE_USERNAME', 'title' => 'Create Username:', 'type' => 'input']);
        $createPin   = UssdMenu::create(['code' => 'CREATE_PIN', 'title' => 'Create 4-digit PIN:', 'type' => 'input']);
        $confirmPin  = UssdMenu::create(['code' => 'CONFIRM_PIN', 'title' => 'Confirm PIN:', 'type' => 'input']);
        $acceptTerms = UssdMenu::create(['code' => 'ACCEPT_TERMS', 'title' => "Accept Terms & Privacy Policy?\n1. Yes\n2. No", 'type' => 'menu']);
        $enterOtp    = UssdMenu::create(['code' => 'ENTER_OTP', 'title' => 'Enter OTP sent via SMS/Email:', 'type' => 'input']);
        $regSuccess  = UssdMenu::create(['code' => 'REG_SUCCESS', 'title' => 'Registration successful — you can now log in.', 'type' => 'end']);
        $regFail     = UssdMenu::create(['code' => 'REG_FAIL', 'title' => 'Incorrect OTP — try again (max 3 times).', 'type' => 'end']);

        // Link menus sequentially
        $registerRole->next_menu_id = $enterMobile->id;
        $enterMobile->next_menu_id = $enterName->id;
        $enterName->next_menu_id = $enterEmail->id;
        $enterEmail->next_menu_id = $createUser->id;
        $createUser->next_menu_id = $createPin->id;
        $createPin->next_menu_id = $confirmPin->id;
        $confirmPin->next_menu_id = $acceptTerms->id;
        $acceptTerms->next_menu_id = $enterOtp->id;
        $enterOtp->next_menu_id = $regSuccess->id;

        $registerRole->save();
        $enterMobile->save();
        $enterName->save();
        $enterEmail->save();
        $createUser->save();
        $createPin->save();
        $confirmPin->save();
        $acceptTerms->save();
        $enterOtp->save();

    }
}
