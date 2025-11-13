<?php

namespace App\Http\Ussd\States\MainDashboard\QualityProblemReport;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\Models\NatureOfDefect;
use App\OTPGeneration;
use Sparors\Ussd\State;

class ReportQualityProblemSuccessful extends State
{
    use OTPGeneration;

    protected function beforeRendering(): void
    {
        $this->saveNatureOfDefects();
        $this->menu->line('Quality problem report submitted successfully');
        $this->menu->line('Your reference number is ' . $this->record->get('referenceNumber'))
            ->paginateListing([
                'Main Menu',
                'Exit'
            ], 1, 2, '. ');

    }

    protected function afterRendering(string $argument): void
    {
        if ($this->record->get('isLoggedIn')) {
            $this->decision->equal('1', Dashboard::class);
            $this->decision->equal('2', ExitState::class);
        } else {
            $this->decision->equal('1', ContinueWithoutRegistering::class);
            $this->decision->equal('2', ExitState::class);
        }
        $this->decision->any(InvalidMenuSelection::class);
    }

    protected function saveNatureOfDefects(): void
    {
        $problemReport = $this->getProductDefectByReference($this->record->get('referenceNumber'));
        $presenceOfForeignMaterial = $this->record->get('presenceOfForeignMaterial');
        $presenceOfForeignMaterialComment = $this->record->get('presenceOfForeignMaterialComment');
        $particulateMatter = $this->record->get('particulateMatter');
        $particulateMatterComment = $this->record->get('particulateMatterComment');
        $discoloration = $this->record->get('discoloration');
        $discolorationComment = $this->record->get('discolorationComment');
        $wrongLabel = $this->record->get('wrongLabel');
        $wrongLabelComment = $this->record->get('wrongLabelComment');
        $wrongPackaging = $this->record->get('wrongPackaging');
        $wrongPackagingComment = $this->record->get('wrongPackagingComment');
        $wrongStrength = $this->record->get('wrongStrength');
        $wrongStrengthComment = $this->record->get('wrongStrengthComment');
        $lackOfTherapeuticResponse = $this->record->get('lackOfTherapeuticResponse');
        $lackOfTherapeuticResponseComment = $this->record->get('lackOfTherapeuticResponseComment');
        $other = $this->record->get('other');
        $otherComment = $this->record->get('otherComment');
        $suspectedContamination = $this->record->get('suspectedContamination');
        $suspectedContaminationComment = $this->record->get('suspectedContaminationComment');
        $parenteralSolutionLeaks = $this->record->get('parenteralSolutionLeaks');
        $parenteralSolutionLeaksComment = $this->record->get('parenteralSolutionLeaksComment');
        $unusualOdor = $this->record->get('unusualOdor');
        $unusualOdorComment = $this->record->get('unusualOdorComment');
        $colorChanges = $this->record->get('colorChanges');
        $colorChangesComment = $this->record->get('colorChangesComment');
        $fungalGrowth = $this->record->get('fungalGrowth');
        $fungalGrowthComment = $this->record->get('fungalGrowthComment');

        $defects = $this->getDefects();
        $natureOfDefects = [];

        foreach ($defects as $defect) {
            if ($fungalGrowth == 'Yes' && $defect->defect == 'Fungal Growth') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $fungalGrowthComment];
            }
            if ($colorChanges == 'Yes' && $defect->defect == 'Colour Changes') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $colorChangesComment];
            }
            if ($unusualOdor == 'Yes' && $defect->defect == 'Unusual odour') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $unusualOdorComment];
            }
            if ($parenteralSolutionLeaks == 'Yes' && $defect->defect == 'Parenteral Solution Leaks') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $parenteralSolutionLeaksComment];
            }
            if ($suspectedContamination == 'Yes' && $defect->defect == 'Suspected Contamination') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $suspectedContaminationComment];
            }
            if ($presenceOfForeignMaterial == 'Yes' && $defect->defect == 'Presence of foreign material') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $presenceOfForeignMaterialComment];
            }
            if ($particulateMatter == 'Yes' && $defect->defect == 'Particulate matter') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $particulateMatterComment];
            }
            if ($discoloration == 'Yes' && $defect->defect == 'Discolouration') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $discolorationComment];
            }
            if ($wrongLabel == 'Yes' && $defect->defect == 'Wrong Label') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $wrongLabelComment];
            }
            if ($wrongPackaging == 'Yes' && $defect->defect == 'Wrong Packaging') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $wrongPackagingComment];
            }
            if ($wrongStrength == 'Yes' && $defect->defect == 'Wrong Strength') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $wrongStrengthComment];
            }
            if ($lackOfTherapeuticResponse == 'Yes' && $defect->defect == 'Lack of therapeutic response') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $lackOfTherapeuticResponseComment];
            }
            if ($other == 'Yes' && $defect->defect == 'Other') {
                $natureOfDefects[] = ['product_defect_id' => $problemReport->id, 'defect_id' => $defect->id, 'comments' => $otherComment];
            }
        }

        $this->createNatureOfDefect($natureOfDefects);

    }

    private function createNatureOfDefect($natureOfDefects): void
    {
        foreach ($natureOfDefects as $natureOfDefect) {
            NatureOfDefect::firstOrCreate($natureOfDefect);
        }
    }
}
