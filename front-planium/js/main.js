function test() {
    
}

function getPlans() {
    
    $.ajax({
        url: 'http://localhost:8000/api/plans',
        type: 'GET',
        success: function(response) {
            console.log(response)
            const plansSelect = document.getElementById("formControlSelect");
            response.forEach((plans) => {
                option = new Option(plans.nome, plans.codigo);
                plansSelect.options[plansSelect.options.length] = option;
            });
        }
    });
}

let selected;
function getPrice() {
    let showPlans = document.getElementById("showPlans");
    showPlans.innerHTML = ''

    $("#formControlSelect option:selected").each(function() {
        selected = $(this).val();
     });

    $.ajax({
        url: 'http://localhost:8000/api/price',
        type: 'GET',
        success: function(response) {

            for(let i = 0; i < response.length; i++) {
                
                if(response[i].codigo == selected) {

                    console.log(response[i])
                    
                    showPlans.innerHTML += 
                    '<div class="col-lg-4 col-md-6 m-4 mt-md-0" id="'+(i+1)+'">\
                    <div class="card">\
                        <div class="card-body">\
                            <div class="box featured aos-init aos-animate pricing" data-aos="fade-up" data-aos-delay="200">\
                                <h3 class="bg-primary text-light">PLANO</h3>\
                                <ul>\
                                    <li><strong>Minimo de vidas - '+response[i].minimo_vidas+'</strong></li>\
                                    <li>Faixa 1 - '+response[i].faixa1.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'</li>\
                                    <li>Faixa 2 - '+response[i].faixa2.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'</li>\
                                    <li>Faixa 3 - '+response[i].faixa3.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})+'</li>\
                                </ul>\
                                <div class="form-group form-check">\
                                    <input type="radio" class="form-check-input" id="checkPlan'+(i+1)+'" name="checkPlan" value="check'+i+'">\
                                    <label class="form-check-label" for="checkPlan'+(i+1)+'">Selecionar Plano</label>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                  </div>';
                }
            }
        }
    });
}

var count = 0;
function add() {
    let amountBeneficiaries = $("#amountBeneficiaries").val();
    let totalBeneficiaries = '';
    for(let i = 0; i < amountBeneficiaries; i++) {

        totalBeneficiaries +=
        '<div class="row">\
            <div class="col-md-8 form-group">\
                <input type="text" class="form-control" id="name'+i+'" placeholder="Nome" required="true" />\
            </div>\
            <div class="col-md-3 form-group mt-3 mt-md-0">\
                <input type="number" class="form-control" id="age'+i+'" placeholder="Idade" required="true" />\
            </div>\
            <div class="col-md-1 form-group mt-3 mt-md-0">\
                <a href="#"><i class="fa-sharp fa-solid fa-circle-xmark text-danger"></i></a>\
            </div>\
        </div>'
    }

    $("#addBeneficiaries").append(totalBeneficiaries);
}

function btnClick() {

    let count = $("#addBeneficiaries")[0].childElementCount;
    let name = '';
    let age = 0;
    let dataBeneficiaries = [];
    for(let i = 0; i < count; i++) {
        name = $("#name"+i).val();
        age = $("#age"+i).val()

        dataBeneficiaries.push({
            "name": name,
            "age": age
        });
    }

    let postData = {
        "number_beneficiaries": count,
        "chosen_plan": selected,
        "beneficiaries" : dataBeneficiaries
    }

    $.ajax({
        url: 'http://localhost:8000/api/register',
        type: 'POST',
        dataTapy: 'json',
        data: postData,
        success: function(resp) {
            console.log(resp);
        }
    });

}