$(function(){


    //pesquisar cliente do menu Pesquisar Contrato
    $("#pesquisarCPF").bind("keyup",function(){


        let pesquisarCPF = $("#pesquisarCPF").val();


        $.ajax({
            type: "get",
            url: BASE_URL+"Clientes/pesquisar",
            data: {"pesquisarCPF":pesquisarCPF},
            dataType: "json",
            success: function (jsonResposta) {


                if(jsonResposta.status == "OK"){


                    $("#conteudo").html('<div  class="subtirinhas">'+jsonResposta.cliente.nomeClientes+'</div>\n\
                    <div  class="subtirinhas">'+jsonResposta.cliente.cpfClientes+'</div>\n\
                    <div  style="cursor:pointer" class="subtirinhas"><img id="'+jsonResposta.cliente.idClientes+'" data-toggle="modal" data-target="#dependentes" onclick="dependentes(this)" title = "Dependentes" width="20%" src="'+BASE_URL+'assets/imagens/dependente.png"/></div>\n\
                    <div class="subtirinhas">'+jsonResposta.cliente.cpfClientes+'</div>\n\
                    <div class="subtirinhas">'+jsonResposta.cliente.situacao+'</div>')

             
                }else{

                    alert("Não encontramos o cliente pesquisado!");

                }
                
            }
        });


      

       

    });



      //Pequisar cliente do menu Venda-> Cadastro de Clientes

     /* $("#nomeCliente").bind("keyup",function(){


        let nomeCliente = $("#nomeCliente").val();
        let tirinhaCliente;

        $.ajax({


            type:"post",
            url:BASE_URL+"Clientes/pesquisarCliente",
            data:{"nomeCliente":nomeCliente},
            dataType:"json",
            success:function(retornoClientes){


                if(retornoClientes.status == "OK"){




                    //pegar o id do vendedor através do id do cliente na tabelade vendas

                    $.ajax({

                        type: "get",
                        url:BASE_URL+"VendaPlanos/getVendaByIdClinte",
                        data:{"idCliente":retornoClientes[clienteJson].idClientes},
                        dataType:"json",
                        success:function(vendaJson){


                            if(vendaJson.status == "OK"){


                                if(vendaJson[vendaCliente].vendedores_idVendedores != null ){


                                    tirinhaCliente =  '<a target="_blank" href="'+BASE_URL+'Contrato/recuperarContrato/'+retornoClientes[clienteJson].idClientes+ "/" +vendaJson[vendaCliente].vendedores_idVendedores+'"><img class="imagemPequena" title="Recuperar Contrato" src="'+BASE_URL+'assets/imagens/document.svg" /></a>';

                                }else{

                                    tirinhaCliente = '<a data-toggle="modal" data-target="#mensagemContrato" href="#"><img style="opacity: 90%; cursor:not-allowed" class="imagemPequena" title="Recuperar Contrato" src="'+BASE_URL+'assets/imagens/document.svg" /></a>';

                                }


                                 $("#boxClientes").html('<div class="tirinhas">\n
                                <div class="subtirinhas">'+retornoClientes[clienteJson].nomeClientes+'</div>\n
                                <div class="subtirinhas">\n
                                <div class="alinhamentoDireito">\n

                                //FALTA COLOCAR A TIRINHA AQUI
            <?php

           
            if (isset($vendaPorCliente)) :

            ?>

                <a target="_blank" href="<?php echo BASE_URL; ?>Contrato/recuperarContrato/<?php echo $clientes['idClientes'] . "/" . $vendaPorCliente['vendedores_idVendedores']; ?>"><img class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>
            <?php
            else :

            ?>


                <a data-toggle="modal" data-target="#mensagemContrato" href="#"><img style="opacity: 90%; cursor:not-allowed" class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>


            <?php
            endif;
            ?>

            <img id="<?php echo $clientes['idClientes']; ?>" onclick="mostrar(this)" class="imagemPequena ponteiro" title="Detalhe" src="<?php echo BASE_URL; ?>assets/imagens/detalhes.png" /></a>
            <a id="atualizar" href="<?php echo BASE_URL; ?>Clientes/atualizarClientes/?id=<?php echo $clientes['idClientes']; ?>"><img class="imagemPequena" title="Atualizar" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
            <a href="<?php echo BASE_URL; ?>Clientes/deletarClientes/?id=<?php echo $clientes['idClientes']; ?>"><img class="imagemPequena" title="Excluir" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
        </div>
    </div>


</div>

<div id="<?php echo "detalhes" . $clientes['idClientes']; ?>" class="detalhes" style="display: none;">


    <div class="detalhesConteudo">
        <ul>
            <li><?php echo "RG:" . $clientes['rgClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "CPF:" . $clientes['cpfClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "Endeço: " . $clientes['enderecoClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "CEP: " . $clientes['cepClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "Cidade: " . $clientes['cidadeClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "Estado: " . $clientes['estadoClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "Telefone: " . $clientes['telefoneClientes']; ?></li>
            <br />
            <br />
            <li><?php echo "Data de Nascimento: " . date("d/m/Y", strtotime($clientes['dataNascimentoClientes'])); ?></li>
            <br />
            <br />
            <li><?php echo "Situação: " . $clientes['situacao']; ?></li>

    </div>



</div>



    
    ");






                            }else{


$("#boxClientes").html('<div class="tirinhas">\n
<div class="subtirinhas alinhamentoCentro">\n
    <h3 style="font-size:25px; font-weight:bold;padding-bottom: 10px;">Não há registros</h3>\n
 </div>\n
</div>')


                            }

                        }
                    });





                   
                }else{

                 


                }




            }





        });



/*        $("#boxClientes").html("
        
    
        <div class="tirinhas">


        <div class="subtirinhas"><?php echo $clientes['nomeClientes']; ?></div>
        <div class="subtirinhas">
            <div class="alinhamentoDireito">
                <?php

               
                if (isset($vendaPorCliente)) :

                ?>

                    <a target="_blank" href="<?php echo BASE_URL; ?>Contrato/recuperarContrato/<?php echo $clientes['idClientes'] . "/" . $vendaPorCliente['vendedores_idVendedores']; ?>"><img class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>
                <?php
                else :

                ?>


                    <a data-toggle="modal" data-target="#mensagemContrato" href="#"><img style="opacity: 90%; cursor:not-allowed" class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>


                <?php
                endif;
                ?>

                <img id="<?php echo $clientes['idClientes']; ?>" onclick="mostrar(this)" class="imagemPequena ponteiro" title="Detalhe" src="<?php echo BASE_URL; ?>assets/imagens/detalhes.png" /></a>
                <a id="atualizar" href="<?php echo BASE_URL; ?>Clientes/atualizarClientes/?id=<?php echo $clientes['idClientes']; ?>"><img class="imagemPequena" title="Atualizar" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                <a href="<?php echo BASE_URL; ?>Clientes/deletarClientes/?id=<?php echo $clientes['idClientes']; ?>"><img class="imagemPequena" title="Excluir" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
            </div>
        </div>


    </div>

    <div id="<?php echo "detalhes" . $clientes['idClientes']; ?>" class="detalhes" style="display: none;">


        <div class="detalhesConteudo">
            <ul>
                <li><?php echo "RG:" . $clientes['rgClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "CPF:" . $clientes['cpfClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "Endeço: " . $clientes['enderecoClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "CEP: " . $clientes['cepClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "Cidade: " . $clientes['cidadeClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "Estado: " . $clientes['estadoClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "Telefone: " . $clientes['telefoneClientes']; ?></li>
                <br />
                <br />
                <li><?php echo "Data de Nascimento: " . date("d/m/Y", strtotime($clientes['dataNascimentoClientes'])); ?></li>
                <br />
                <br />
                <li><?php echo "Situação: " . $clientes['situacao']; ?></li>

        </div>



    </div>



<?php
} //end foreach
} else {
?>

<div class="tirinhas">

    <div class="subtirinhas alinhamentoCentro">
        <h3 style="font-size:25px; font-weight:bold;padding-bottom: 10px;">Não há registros</h3>
    </div>
</div>


<?php
}
?>    
        
        "); RETIRE ESTE COMENTÁRIO*/


   /* } );RETIRE ESTE COMENTÁRIO*/




});





