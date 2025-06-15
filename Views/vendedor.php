<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<script type="text/javascript">
    $('li').eq(8).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>
<br>
<br>
<br>


<div class="margem">




    <div class="flexivel">
        <div>
            <h1 class="estiloBorda">Vendedores</h1>
        </div>
        <!--Link do modal-->
        <div class=" card circulo">

            <img title="Adicionar Vendedores" alt="Adicionar Vendedores" data-toggle="modal" data-target="#vendedores" class="circulo" src="<?php echo BASE_URL; ?>assets/imagens/add.svg">

        </div>
    </div>

    <?php

    use \Models\Vendedor;

    if (isset($mensagem)) :
        if ($mensagem == "Salvo com sucesso!" || $mensagem == "Deletado com sucesso!") : ?>
            <div class="success alinhamentoCentro"><?php echo $mensagem; ?></div>
        <?php elseif ($mensagem == "Problema ao salvar o arqiuvo!" || $mensagem == "Não foi possivel deletar!" || $mensagem == "Vendedor Já Cadastrado") : ?>
            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?></div>
    <?php endif;
    endif; ?>
    <hr />


    <!--<div style="width: 100%;" ><h2 class=" alinhamentoCentro">Lista de vendedores</h2></div>-->


    <?php
    //$seller = new Vendedor();

    $seller = new Vendedor();

    $venda = $seller->getAllVendedor($_SESSION['idEmpresa']);



    if ($venda != NULL) {



        foreach ($venda as $vendedores) {
    ?>

            <div class="tirinhas">
                <div class="subtirinhas"><?php echo $vendedores['nomeVendedores']; ?></div>
                <div class="subtirinhas "><?php echo $vendedores['emailVendedores']; ?></div>
                <div class="subtirinhas"><?php echo $vendedores['telefoneVendedores']; ?></div>

                <div class="subtirinhas">
                    <div class="alinhamentoDireito">
                        <div>
                            <a id="atualizar" href="<?php echo BASE_URL; ?>Vendedores/atualizarVendedores/?id=<?php echo $vendedores['idVendedores']; ?>"><img class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                            <a href="<?php echo BASE_URL; ?>Vendedores/deletarVendedores/?id=<?php echo $vendedores['idVendedores']; ?>"><img class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        <?php
        }
    } else {
        ?>

        <div class="tirinhas">

            <div class="subtirinhas alinhamentoCentro">
                <h3 style="font-size:25px; font-weight:bold;padding-bottom: 10px;">Não há registros</h3>
            </div>
        </div>

    <?php } ?>











    <!--Modal-->
    <div class="modal" role="dialog" id="vendedores">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title estiloBorda">Cadastro de Vendedores</h2>
                </div>

                <div class="modal-body">

                    <form method="POST" action="<?php echo BASE_URL; ?>Vendedores/inserirVendedores">
                        <label class="rotulo">Nome do vendedor</label><br>
                        <input class="campoTexto" type="text" name="nomeVendedor" required />


                        <label class="rotulo">E-mail</label><br>
                        <input class="campoTexto" type="email" name="emailVendedor" required />

                        <label class="rotulo">Telefone</label><br>
                        <input id="telefone" class="campoTexto" type="tel" name="telefoneVendedor" required />
                        <script>
                            $("#telefone").mask("(99) 99999-9999");
                        </script>

                        <input class="botao" type="submit" value="Salvar" />
                    </form>
                </div>

                <div class="modal-footer">


                    <h3 class="modal-title estiloBorda">PAFS</h3>

                </div>

            </div>

        </div>

    </div>

</div>