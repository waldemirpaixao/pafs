

$(function () {

    let idVendedor = "";

   

    $("#vendedor").bind("change", function () {



        idVendedor = $("#vendedor :selected").val();


        $.ajax({
            type: "get",
            url: BASE_URL + "/vendedores/getAssinaturaVendedores",
            data: { "idVendedores": idVendedor },
            dataType: "json",
            success: function (jsonVendedor) {

                
                if(jsonVendedor.status == "OK"){

                   

                   $("#assinaturaDigitalVendedor").val(jsonVendedor.vendedores.assinaturaDigitalVendedor);
                   $("#hashDigitalVendedor").html(jsonVendedor.vendedores.assinaturaDigitalVendedor);
                }

            }

               
    
        });

    });





});