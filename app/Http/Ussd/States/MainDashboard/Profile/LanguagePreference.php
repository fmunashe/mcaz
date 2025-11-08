<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Models\Language;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class LanguagePreference extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $this->menu->text('Select Language');
        $this->menu->lineBreak(2);
        $languages = Language::query()->pluck('name')->toArray();
        $languages[] = 'Back';
        $this->menu->paginateListing($languages, 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $language = $argument;
        if (in_array($language, Language::query()->pluck('id')->toArray())) {
            $user = $this->getUserByPhone($this->record->get('phoneNumber'));
            $user->language_id = $language;
            $user->save();
            $this->decision->any(LanguageSetSuccessfully::class);
        }
        $this->decision->equal('Back', MyProfile::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
