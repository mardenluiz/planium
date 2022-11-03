<?php
    
namespace App\Services;

use App\Services\RenderFileJson;

class PlansService 
{

    public function registerBeneficiaries($number_beneficiaries, $beneficiaries, $chosen_plan)
    {
        $validation = new ValidationService();
        $renderFileJson = new RenderFileJson();

        $save_beneficiaries = [
            'quantidade_beneficiario' => $number_beneficiaries,
            'beneficiario' => $beneficiaries,
            "plano_escolhido" => $chosen_plan
        ];

        $path = $renderFileJson->getPath();
        $plans = $renderFileJson->getPlans();
        $prices = $renderFileJson->getPrices();
 
        file_put_contents("{$path}".DIRECTORY_SEPARATOR."beneficiarios.json", json_encode($save_beneficiaries));

        $proposal = $validation->validationPlansChosen($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries);
        file_put_contents("{$path}".DIRECTORY_SEPARATOR."proposta.json", json_encode($proposal));

        return $proposal;
    }
}