<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Models\Client;
use Illuminate\Support\Str;
use Sparors\Ussd\State;

class ViewProfile extends State
{
    protected function beforeRendering(): void
    {
        $user = Client::query()->where('phone', $this->record->get('phoneNumber'))->first();
        $via = $user->notify_via == "sms" ? Str::upper($user->notify_via) : ucfirst($user->notify_via);
        $terms = $user->accepted_terms ? 'Yes' : 'No';
        $name = 'Name: ' . $user->full_name;
        $phone = 'Phone: ' . $user->phone;
        $email = 'Email: ' . $user->email;
        $username = 'Username: ' . $user->username;
        $language = 'Language: ' . $user->language->name;
        $role = 'Role: ' . $user->role->name;
        $notify_via = 'Notification Channel: ' . $via;
        $institution = 'Institution: ' . $user->institution;
        $terms = 'Accepted Terms: ' . $terms;
        $this->menu->line('Profile Details');
        $this->menu->line($name);
        $this->menu->line($phone);
        $this->menu->line($email);
        $this->menu->line($username);
        $this->menu->line($language);
        $this->menu->line($role);
        $this->menu->line($notify_via);
        $this->menu->line($institution);
        $this->menu->line($terms);
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back'], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', MyProfile::class);
    }
}
