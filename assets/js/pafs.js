/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//mostrar a senha no checkbx do formulário login


function mostrar(elemento){


    let img = elemento;
    let id = $(img).attr('id');
   


    if($("#detalhes"+id).hasClass("mostrar")){


        $("#detalhes"+id).slideUp(1000);
        $("#detalhes"+id).removeClass("mostrar");
       

    }else{

        $("#detalhes"+id).slideDown(1000);
        $("#detalhes"+id).addClass("mostrar");

    }

   


}




function alturaLateral(){

    //pegando a largura e altura da tela do computador


    //let altura = window.screen.height;
  let altura =  document.body.clientHeight;
 
  const menorAlturaDoSistema = 1000;
 
  if(altura < menorAlturaDoSistema){

    $(".leftmenu").css("height","100%")
  }else{
    $(".leftmenu").css("height",altura)
  }
   

}

function mostrarSenha() {

    var check = document.getElementById("mostraSenha");

    if (check.checked === true) {

        document.getElementById("senha").type = "text";

    } else {

        document.getElementById("senha").type = "password";

    }
}


//JQuery manu lateral do tamplateLoginCompany
$(function () {


//meu configurações
    $("#menuConfiguracoes").bind("click", function () {

        //window.reload();
         $('li').removeClass('stiloFixo');

        $("li").eq(1).addClass("stiloFixo");
        $("#submenuConfiguracoes").fadeToggle("slow");
      
        
        
        // $('li').eq(2).removeClass('stiloFixo');
        //  $('li').eq(3).addClass('stiloFixo');

    });


    //menu cadastros
    $("#menuCadastros").bind("click", function () {

        //window.reload();
         $('li').removeClass('stiloFixo');

        $("li").eq(3).addClass("stiloFixo");
        $("#submenuCadastros").fadeToggle("slow");
      
        
        
        // $('li').eq(2).removeClass('stiloFixo');
        //  $('li').eq(3).addClass('stiloFixo');

    });


   



//menu Vendas
    $("#menuVendas").bind("click", function () {

        $("#submenuVendas").fadeToggle("slow");
        $('li').removeClass('stiloFixo');
        $('li').eq(9).addClass("stiloFixo");
     
        // $('li').eq(8).addClass('stiloFixo');

    });

//submenuvendas
    $("#submenuVendas").bind("click", function () {

       
        
        $('li').eq(10).addClass("stiloFixoSubmenu");
     
        // $('li').eq(8).addClass('stiloFixo');

    });



//menu finaceiiro
    $("#menuFinanceiro").bind("click", function () {

        $("#submenuFinanceiro").fadeToggle("slow");
        $('li').removeClass('stiloFixo');
        $('li').removeClass('stiloFixoSubmenu');
        $('li').eq(11).addClass('stiloFixo');

    });


   



    

 



    //preview da imagem do produto 

    $(function () {

        $('#foto').change(function () {


            const file = $(this)[0].files[0];
            const fileReader = new FileReader();
            fileReader.onloadend = function () {

                $("#img").attr('src', fileReader.result);

            };

            fileReader.readAsDataURL(file);


        });



    });



  
        
            
    });




//Radio buttton clickPlanos em formularioVendaPlanos 
$(function(){
    
    const valor = "valor";
     //var idPlano = 0;
     let id = 0;
     let novoId = 0;
     let preco = 0;
    
    $('.clickPlanos').bind('click',function(){
       
   
        preco = 0;
        $('.total div #valorPlano').val("0");
        //idPlano = $(this).val();
        id = $(this).attr('id');
      
        novoId = id.split("a");

        preco = $("#"+valor+novoId[1]).val();
              
        preco = parseInt(preco)+ parseInt($('.total div #valorPlano').val()) + parseInt($("#dependente").val());
        precoAtual = preco.toLocaleString('pt-br', {minimumFractionDigits: 2});
       
        $('.total div #valor').html(precoAtual);
        precoComPonto = precoAtual.replaceAll(",",".")
        $('.total div #valorPlano').val(precoComPonto);
        
       
     
        
       /*  $.ajax({
        type:'GET',
        url:BASE_URL+'planos/getPlanoJSON/'+idPlano,
        //data:idPlano,
        dataType:'json',
        success:function(json){
            
           $('.total div #valor').html(json.valorPlanos);
           $('.total div #valorPlano').val(json.valorPlanos);
            
        }
    
        
        });*/
        
            
    });
});



 

/*função do botão da situacao de atualização do ciente*/


/*$(function () {


    $("#ativo").bind("change", function () {


        $("#ativo").removeAttr("checked", true);
        $("#ativo").removeAttr("unchecked", true);
        $("#ativo").attr("checked", "checked");
        $("#inativo").removeAttr("unchecked");
        $("#inativo").attr("unchecked", "unchecked");


    });


    $("#inativo").bind("change", function () {



        $("#inativo").attr("checked", "checked");
        $("#ativo").attr("unchecked", "unchecked");

    });




});*/








 