<?php

namespace Database\Seeders;

use App\Models\UssdMenu;
use App\Models\UssdMenuOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UssdMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        UssdMenuOption::query()->delete();
        UssdMenu::query()->delete();

        // 1. MAIN MENU
        $main = UssdMenu::create([
            'code' => 'MAIN_MENU',
            'title' => "Welcome to MCAZ.\nReport medicine or vaccine side effects or product quality issues, or submit a complaint or enquiry.\n1. Log In\n2. Register\n3. Continue without registering\n4. Help\n5. Exit",
            'type' => 'menu',
            'next_menu_id' => null
        ]);

        // 2. REGISTER ROLE SELECTION
        $registerRole = UssdMenu::create([
            'code' => 'REGISTER_ROLE',
            'title' => "Select Role:\n1. Healthcare Worker\n2. Patient\n3. Other",
            'type' => 'menu',
            'next_menu_id' => null
        ]);

        // 3. REGISTRATION FLOW MENUS
        $registrationMenus = [
            [
                'code' => 'ENTER_MOBILE',
                'title' => 'Enter Mobile Number (e.g., 0771234567):',
                'type' => 'input',
                'validation' => '10-15 digits',
                'next_menu_id' => null
            ],
            [
                'code' => 'ENTER_FULLNAME',
                'title' => 'Enter your full name:',
                'type' => 'input',
                'validation' => 'Min 3 characters',
                'next_menu_id' => null
            ],
            [
                'code' => 'ENTER_EMAIL',
                'title' => 'Enter your email address:',
                'type' => 'input',
                'validation' => 'Valid email format',
                'next_menu_id' => null
            ],
            [
                'code' => 'CREATE_USERNAME',
                'title' => 'Choose a username (letters and numbers only):',
                'type' => 'input',
                'validation' => 'Alphanumeric, 4-20 chars',
                'next_menu_id' => null
            ],
            [
                'code' => 'CREATE_PIN',
                'title' => 'Create a 4-digit PIN:',
                'type' => 'input',
                'validation' => '4 digits',
                'next_menu_id' => null
            ],
            [
                'code' => 'CONFIRM_PIN',
                'title' => 'Confirm your 4-digit PIN:',
                'type' => 'input',
                'validation' => 'Must match first PIN',
                'next_menu_id' => null
            ],
            [
                'code' => 'ACCEPT_TERMS',
                'title' => "Terms & Privacy Policy:\nBy registering, you agree to our terms and conditions.\n1. Accept\n2. Decline",
                'type' => 'menu',
                'next_menu_id' => null
            ],
            [
                'code' => 'ENTER_OTP',
                'title' => 'Enter the 4-digit OTP sent to your mobile:',
                'type' => 'input',
                'validation' => '4 digits',
                'next_menu_id' => null
            ]
        ];

        // Create registration menus and link them
        $menuRefs = [];
        $previousMenu = null;
        
        foreach ($registrationMenus as $menu) {
            $newMenu = UssdMenu::create([
                'code' => $menu['code'],
                'title' => $menu['title'],
                'type' => $menu['type'],
                'next_menu_id' => $menu['next_menu_id']
            ]);
            
            $menuRefs[$menu['code']] = $newMenu;

            if ($previousMenu) {
                $previousMenu->update(['next_menu_id' => $newMenu->id]);
            } else {
                $registerRole->update(['next_menu_id' => $newMenu->id]);
            }
            $previousMenu = $newMenu;
        }

        // 4. SUCCESS/FAILURE MESSAGES
        $regSuccess = UssdMenu::create([
            'code' => 'REG_SUCCESS',
            'title' => '✅ Registration successful! You can now log in with your credentials.',
            'type' => 'end',
            'next_menu_id' => null
        ]);

        $regFail = UssdMenu::create([
            'code' => 'REG_FAIL',
            'title' => '❌ Registration failed. Please try again or contact support.',
            'type' => 'end',
            'next_menu_id' => null
        ]);

        $otpFail = UssdMenu::create([
            'code' => 'OTP_FAIL',
            'title' => '❌ Incorrect OTP. You have {attempts} attempts remaining.',
            'type' => 'end',
            'next_menu_id' => null
        ]);

        // 5. MAIN MENU OPTIONS
        UssdMenuOption::insert([
            // Main menu options
            [
                'ussd_menu_id' => $main->id, 
                'option_number' => '1', 
                'option_text' => 'Log In', 
                'next_menu_id' => null // TODO: Add login menu
            ],
            [
                'ussd_menu_id' => $main->id, 
                'option_number' => '2', 
                'option_text' => 'Register', 
                'next_menu_id' => $registerRole->id
            ],
            [
                'ussd_menu_id' => $main->id, 
                'option_number' => '3', 
                'option_text' => 'Continue without registering', 
                'next_menu_id' => null // TODO: Add guest menu
            ],
            [
                'ussd_menu_id' => $main->id, 
                'option_number' => '4', 
                'option_text' => 'Help', 
                'next_menu_id' => null // TODO: Add help menu
            ],
            [
                'ussd_menu_id' => $main->id, 
                'option_number' => '5', 
                'option_text' => 'Exit', 
                'next_menu_id' => null
            ],
            
            // Role selection options
            [
                'ussd_menu_id' => $registerRole->id, 
                'option_number' => '1', 
                'option_text' => 'Healthcare Worker', 
                'next_menu_id' => $menuRefs['ENTER_MOBILE']->id
            ],
            [
                'ussd_menu_id' => $registerRole->id, 
                'option_number' => '2', 
                'option_text' => 'Patient', 
                'next_menu_id' => $menuRefs['ENTER_MOBILE']->id
            ],
            [
                'ussd_menu_id' => $registerRole->id, 
                'option_number' => '3', 
                'option_text' => 'Other', 
                'next_menu_id' => $menuRefs['ENTER_MOBILE']->id
            ],
            
            // Terms acceptance options
            [
                'ussd_menu_id' => $menuRefs['ACCEPT_TERMS']->id, 
                'option_number' => '1', 
                'option_text' => 'Accept', 
                'next_menu_id' => $menuRefs['ENTER_OTP']->id
            ],
            [
                'ussd_menu_id' => $menuRefs['ACCEPT_TERMS']->id, 
                'option_number' => '2', 
                'option_text' => 'Decline', 
                'next_menu_id' => $regFail->id
            ]
        ]);

        // Link the last menu in registration flow to success
        $menuRefs['ENTER_OTP']->update(['next_menu_id' => $regSuccess->id]);
        
        // Add a back option to all menus (except main and end menus)
        $menus = UssdMenu::whereNotIn('type', ['end'])
            ->where('id', '!=', $main->id)
            ->get();
            
        foreach ($menus as $menu) {
            if ($menu->type === 'menu') {
                UssdMenuOption::updateOrCreate(
                    [
                        'ussd_menu_id' => $menu->id,
                        'option_number' => '0'
                    ],
                    [
                        'option_text' => 'Back',
                        'next_menu_id' => $menu->id // Will be updated to previous menu
                    ]
                );
            }
        }
        
        // Update back buttons to point to previous menu
        $this->updateBackButtons();
    }
    
    /**
     * Update back button navigation
     */
    protected function updateBackButtons(): void
    {
        $menus = UssdMenu::orderBy('id')->get();
        $previousMenu = null;
        
        foreach ($menus as $menu) {
            if ($previousMenu && $menu->code !== 'MAIN_MENU') {
                // Find and update the back button for this menu
                UssdMenuOption::where('ussd_menu_id', $menu->id)
                    ->where('option_number', '0')
                    ->update(['next_menu_id' => $previousMenu->id]);
            }
            
            // Skip end menus when setting previous menu
            if ($menu->type !== 'end') {
                $previousMenu = $menu;
            }
        }
    }
}
