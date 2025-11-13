<?php

namespace App\Http\Ussd\States\GuestMenu\Complaints;

use App\Http\Ussd\States\MainDashboard\Complaints\ComplaintSuccessfullyLodged;
use App\OTPGeneration;
use Sparors\Ussd\State;

class GuestContactDetailsForThePersonToBeInvestigated extends State
{
    use OTPGeneration;
    protected function beforeRendering(): void
    {
        $this->menu->line('Contact details for the person to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('guestContactDetailsForThePersonToBeInvestigated', $argument);
        $this->lodgeComplaint();
        $this->decision->any(ComplaintSuccessfullyLodged::class);
    }

    private function lodgeComplaint(): string
    {
        $reference = $this->generateReferenceNumber();
        $address = $this->record->get('guestComplaintAddress');
        $organisation = $this->record->get('guestComplaintOrganisationName');
        $description = $this->record->get('guestComplaintDetails');
        $location = $this->record->get('guestLocationToBeInvestigated');
        $descriptionOfPremises = $this->record->get('guestDescriptionOfPremisesBeingInvestigated');
        $directionsToPremises = $this->record->get('guestDirectionsToPremisesBeingInvestigated');
        $contactDetails = $this->record->get('guestContactDetailsForThePersonToBeInvestigated');
        $name = $this->record->get('guestComplaintName');
        $email = $this->record->get('guestComplaintEmail');
        $telephone = $this->record->get('guestComplaintTelephone');

        $this->record->set('complaintReference', $reference);

        return \App\Models\CustomerComplaint::create([
            'complaint_number' => $reference,
            'name' => $name,
            'address' => $address,
            'telephone' => $telephone,
            'email' => $email,
            'name_of_organisation' => $organisation,
            'details_of_complaint' => $description,
            'location' => $location,
            'description_of_premises' => $descriptionOfPremises,
            'directions_to_premises' => $directionsToPremises,
            'person_to_be_investigated_contact' => $contactDetails
        ]);

    }
}
