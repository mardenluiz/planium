<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\PlansService;
use App\Services\RenderFileJson;

class PlansController extends Controller 
{
    private $plans;
    private $prices;

    public function registerBeneficiaries(Request $request)
    {
        $plansService = new PlansService();
       
        $array = ['error' => ''];
        $rules = [
            'number_beneficiaries' => 'required',
            'chosen_plan' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) 
        {
            $array['error'] = $validator->messages();
            return $array;
        }

        $number_beneficiaries = $request->input('number_beneficiaries');
        $chosen_plan = $request->input('chosen_plan');
        $beneficiaries = $request->input("beneficiaries");

        return $plansService->registerBeneficiaries($number_beneficiaries, $beneficiaries, $chosen_plan);
    }

    public function getPlans() 
    {
        $renderFileJson = new RenderFileJson();
        return $renderFileJson->getPlans();
    }

    public function getPrice() 
    {
        $renderFileJson = new RenderFileJson();
        return $renderFileJson->getPrices();
    }
}
