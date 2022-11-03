<?php

namespace App\Services;

class ValidationService 
{

    public function validationPlansChosen($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries) 
    {
        $registration_plans = array();

        switch($chosen_plan) 
        {
            case "1":
                $cod_plan = 1;
                
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                $registration = [];
                for($i = 0; $i < count($registration_plans['Beneficiarios']); $i++) {

                    if($registration_plans['Beneficiarios'][$i]['preco']['minimo_vidas'] >= 4 && $number_beneficiaries >= 4) 
                    {
                        array_push($registration, $registration_plans['Beneficiarios'][$i]);
                    }
                    elseif($registration_plans['Beneficiarios'][$i]['preco']['minimo_vidas'] < 4 && $number_beneficiaries < 4) 
                    {
                        array_push($registration, $registration_plans['Beneficiarios'][$i]);
                    }
                }

                return $registration;

                break;

            case "2":
                $cod_plan = 2;
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                return $registration_plans;

                break;

            case "3":
                $cod_plan = 3;
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                return $registration_plans;

                break;

            case "4":
                $cod_plan = 4;
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                return $registration_plans;

                break;

            case "5":
                $cod_plan = 5;
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                return $registration_plans;

                break;

            case "6":
                $cod_plan = 6;
                $registration_plans = $this->checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan);
                
                $registration = [];
                for($i = 0; $i < count($registration_plans['Beneficiarios']); $i++) 
                {

                    if($registration_plans['Beneficiarios'][$i]['preco']['minimo_vidas'] >= 2 && $number_beneficiaries >= 2) 
                    {
                        array_push($registration, $registration_plans['Beneficiarios'][$i]);
                    }
                    elseif($registration_plans['Beneficiarios'][$i]['preco']['minimo_vidas'] < 2 && $number_beneficiaries < 2) 
                    {
                        array_push($registration, $registration_plans['Beneficiarios'][$i]);
                    }
                }

                return $registration;
                
                break;
        }

    } 

    public function checkPriceRange($beneficiaries, $plans, $prices, $chosen_plan, $number_beneficiaries, $cod_plan) 
    {
        $registration_plans = [
            'Beneficiarios' => [],
            'Valor_total' => 0
        ];

        $total_value = 0;
        $name_plan = '';

        for($i = 0; $i < count($plans); $i++) 
        {
            if($cod_plan === $plans[$i]->codigo) 
            {
                $name_plan = $plans[$i]->nome;
            }
        }

        for($i = 0; $i < count($prices); $i++) 
        {
            if($prices[$i]->codigo === $cod_plan) 
            {
                $x = 0;
                while(count($beneficiaries) > $x) 
                {
                    // faixa 1
                    if($beneficiaries[$x]['age'] >= 0 && $beneficiaries[$x]['age'] <= 17) 
                    {
                        $total_value += $prices[$x]->faixa1;
                        
                        array_push($registration_plans['Beneficiarios'], [
                            "nome" => $beneficiaries[$x]['name'],
                            "idade" => $beneficiaries[$x]['age'],
                            "preco" => [
                                "faixa1" => $prices[$i]->faixa1,
                                "minimo_vidas" => $prices[$i]->minimo_vidas,
                                "codigo" => $prices[$i]->codigo
                            ],
                            "plano" =>  [
                                'reg' => $chosen_plan,
                                'nome' => $name_plan,
                                'codigo' => $cod_plan
                            ]                         
                        ]);
                    }
                    // faixa 2
                    if($beneficiaries[$x]['age'] >= 18 && $beneficiaries[$x]['age'] <= 40) 
                    {
                        $total_value += $prices[$x]->faixa2;

                        array_push($registration_plans['Beneficiarios'], [
                            "nome" => $beneficiaries[$x]['name'],
                            "idade" => $beneficiaries[$x]['age'],
                            "preco" => [
                                "faixa2" => $prices[$i]->faixa2,
                                "minimo_vidas" => $prices[$i]->minimo_vidas,
                                "codigo" => $prices[$i]->codigo
                            ],
                            "plano" =>  [
                                'reg' => $chosen_plan,
                                'nome' => $name_plan,
                                'codigo' => $cod_plan
                            ]   
                        ]);
                    }
                    // faixa 3
                    if($beneficiaries[$x]['age'] > 40) 
                    {
                        $total_value += $prices[$x]->faixa3;

                        array_push($registration_plans['Beneficiarios'], [
                            "nome" => $beneficiaries[$x]['name'],
                            "idade" => $beneficiaries[$x]['age'],
                            "preco" => [
                                "faixa3" => $prices[$i]->faixa3,
                                "minimo_vidas" => $prices[$i]->minimo_vidas,
                                "codigo" => $prices[$i]->codigo
                            ],
                            "plano" =>  [
                                'reg' => $chosen_plan,
                                'nome' => $name_plan,
                                'codigo' => $cod_plan
                            ]
                        ]);
                    }

                    $x++;
                }
            }
        }
        $registration_plans["Valor_total"] = $total_value;
        return $registration_plans;
    }
}
