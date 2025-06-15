<script type="text/javascript">
    $("li").removeClass("stiloFixo");
    $("li").removeClass("stiloFixoSubmenu");
    $('li').eq(24).addClass('stiloFixo');
    // $('li').eq(5).addClass('stiloFixoSubmenu');
    // $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br />
    <br />


    <?php



    if (isset($mensagem)) :

        

        if ($mensagem == "Salvo com sucesso!" || $mensagem == "Atualizado com Sucesso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Erro ao salvar!" || $mensagem == "Erro ao atualizar!") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Chave já cadastrada!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>





    <h1 class="estiloBorda">Integrações</h1>

    <br />

    <!--<h4 style="opacity: 0.8;">Escolha o banco para integração.</h4>-->

    <br />

    <img src=<?php echo BASE_URL . "assets/imagens/banco-asaas.jpeg"; ?> title="Banco Asaas" alt="Banco Assas" />

    <form method="POST" action="<?php echo BASE_URL; ?>Integracoes/cadastrar">


        <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $idEmpresa; ?>" />
        <input class="campoTexto" type="hidden" name="nomeBanco" value="ASAAS GESTÃO FINANCEIRA INSTITUIÇÃO DE PAGAMENTOS S.A." />

        <label class="rotulo">Qual a chave?</label>
        <input class="campoTexto" type="text" name="chave" />


        <input type="submit" class="botao" value="Salvar">


    </form>



</div>