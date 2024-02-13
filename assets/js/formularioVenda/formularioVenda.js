

$(function(){

    $("#salvar").bind("submit", function(e){



        let dataVigencia = $("#dataVigencia").val();
        let dataAdesao = $("#dataAdesao").val();
        let vendedor = $("#vendedor :selected").val();
        let adesao = $("#vendedor :checked").val();



        if(dataVigencia == ""){

            alert("Por favor preencher o campo data de vigência!");
            e.preventDefault();
            $("#dataVigencia").focus(function (e) { 
                e.preventDefault();
                
            });

        } 
        
        
        if(dataAdesao == ""){

            alert("Por favor preencher o campo data de adesão!");
            e.preventDefault();
            $("#dataAdesao").focus(function (e) { 
                e.preventDefault();
                
            });

        }
        
        
        if (vendedor == "" || vendedor == 'nulo'){

            alert("Por favor preencher o campo do vendedor!");
            e.preventDefault();
            $("#vendedor").focus(function (e) { 
                e.preventDefault();
                
            });

        } 
        
        
        if(adesao == 'sim'){

            alert("Por favor preencher o campo de adesão!");
            e.preventDefault();
            $("#adesao").focus(function (e) { 
                e.preventDefault();
                
            });

        }





       // e.preventDefault();//Não recarrega a página





        
    });


    //desconto

    var valorAtual = 0;
    let desconto = 0;
    let valorDescontado = 0;


    $("#desconto").focus(function(){


        valorAtual = $("#valorPlano").val();

       
    });

    $("#desconto").bind("keyup",function(){


        desconto = $("#desconto").val();
        
      
        if(desconto !== "0" || desconto !== ""){

            desconto = parseFloat(desconto.replace(",","."));
       
            valorDescontado = parseFloat(valorAtual) - desconto;
            
            valorDescontado = valorDescontado.toLocaleString('pt-br', {minimumFractionDigits: 2});

           
            $("#valor").html(valorDescontado)
            $("#valorPlano").val(valorDescontado.replace(",","."));

            if(valorDescontado == "NaN"){

                $("#valor").html(valorAtual.replace(".",","));
                $("#valorPlano").val(valorAtual);
               
            }

            console.log(valorDescontado)
         

            
        }else{

            
            $("#valor").html(valorAtual)
            $("#valorPlano").val(valorAtual);


        }

    });

    


  
 


});

//moeda
 //var f2 = atual.toLocaleString('pt-br', {minimumFractionDigits: 2});

  //pegando o preço do plano no formulário


function valorPlano(elemento){


let input = elemento;
let id = 0 ;
const valor = "valor";
let preco = 0;

id = $(input).attr('id');

preco = $("#"+valor+id).val();

$("#valor").html(preco);
$("#valorPlano").val(preco.replace(",","."));





}





