<?php

namespace App\Http\Ussd\States\Registration;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Models\Language;
use Sparors\Ussd\State;

class LanguageSelection extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Please select your language')
            ->lineBreak()
            ->paginateListing([
                'English',
                'Ndebele',
                'Shona',
                'Exit'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $languageOption = $argument;

        if (in_array($languageOption, ['1', '2', '3'])) {
            if ($languageOption == '1') {
                $name = "English";
            } elseif ($languageOption == '2') {
                $name = "Ndebele";
            } elseif ($languageOption == '3') {
                $name = "Shona";
            }

            $language = Language::query()->where('name', $name)->first();
            if ($language) {
                $this->record->set('languageId', $language->id);
                $this->record->set('languageName', $language->name);
                $this->decision->in(['1', '2', '3'], TermsAndConditions::class);
            }
        }
        $this->decision->equal('4', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
