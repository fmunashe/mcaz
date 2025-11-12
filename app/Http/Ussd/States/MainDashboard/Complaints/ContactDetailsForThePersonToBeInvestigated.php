<?php

namespace App\Http\Ussd\States\MainDashboard\Complaints;

use App\OTPGeneration;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class ContactDetailsForThePersonToBeInvestigated extends State
{
    use OTPGeneration;
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $this->menu->line('Contact details for the person to be investigated');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('contactDetailsForThePersonToBeInvestigated', $argument);

        $this->lodgeComplaint();

        $this->decision->any(ComplaintSuccessfullyLodged::class);
    }

    private function lodgeComplaint(): string
    {
        $user = $this->getUserByPhone($this->record->get('phoneNumber'));
        $reference = $this->generateReferenceNumber();
        $address = $this->record->get('complaintAddress');
        $organisation = $this->record->get('complaintOrganisationName');
        $description = $this->record->get('complaintDescription');
        $location = $this->record->get('locationBeingInvestigated');
        $descriptionOfPremises = $this->record->get('descriptionOfPremisesBeingInvestigated');
        $directionsToPremises = $this->record->get('directionsToPremisesBeingInvestigated');
        $contactDetails = $this->record->get('contactDetailsForThePersonToBeInvestigated');

        $this->record->set('complaintReference', $reference);

        return \App\Models\CustomerComplaint::create([
            'complaint_number' => $reference,
            'name' => $user->full_name,
            'address' => $address,
            'telephone' => $user->phone,
            'email' => $user->email,
            'name_of_organisation' => $organisation,
            'details_of_complaint' => $description,
            'location' => $location,
            'description_of_premises' => $descriptionOfPremises,
            'directions_to_premises' => $directionsToPremises,
            'person_to_be_investigated_contact' => $contactDetails
        ]);

    }
}
