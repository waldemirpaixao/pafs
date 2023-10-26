$(function(){


   $.ajax({
        type: "get",
        url: "https://brasilapi.com.br/api/banks/v1",
       // data: "data",
        dataType: "json",
        success: function (bancos) {

            console.log(bancos)

            for (const key in bancos) {

                $("#listabancos").append('<option value="'+bancos[key].fullName+'">'+bancos[key].fullName+'</option>');

               // console.log(bancos[key].name);
             
            }
           

        
            
        }
    });
});