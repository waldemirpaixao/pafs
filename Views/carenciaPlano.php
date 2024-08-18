<script type="text/javascript">
    $('li').eq(1).addClass('stiloFixo');
    $('li').eq(6).addClass('stiloFixoSubmenu');
    $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br/>
    <br/>
   

    <?php

use Models\CarenciaPlano;


    if (isset($mensagem)) :

        if ($mensagem == "Cadastrado com Sucesso!" || $mensagem == "Atualizado com Sucesso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Erro ao cadastrar!" || $mensagem == "Erro ao atualizar!") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Forma de pagamento já cadastrada!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>



    <?php

    $carenciaPlano = new CarenciaPlano();
    $diaCarenciaPlanoArray = $carenciaPlano->getAllByEmpresa($_SESSION['idEmpresa']);


    if(!isset($diaCarenciaPlanoArray)):

    ?>



   
    <h1 class="estiloBorda">Carência do plano</h1>

    <br />

    <h4 style="opacity: 0.8;">Defina a quantidade de dias de carência do plano para clientes que faz portabilidade</h4>

    <br />

    <form id="diasCadastrar" method="POST" action="<?php echo BASE_URL; ?>CarenciaPlano/cadastrar">



        <label class="rotulo">Quantos dias de carência do pleno?</label>
        <input form="diasCadastrar" class="campoTexto" type="text" name="dias"/>


        <input form="diasCadastrar" type="submit" class="botao" value="Salvar"/>


    </form>

    <?php

    else:

    ?>



    <h1 class="estiloBorda">Atualizar dias de carência</h1>

    <br />

    <h4 style="opacity: 0.8;">Defina a quantidade de dias de carência do plano para clientes que faz portabilidade</h4>

    <br />

    <form id="diasAtualizar" method="POST" action="<?php echo BASE_URL; ?>CarenciaPlano/atualizar">



    <label class="rotulo">Quantos dias de carência do pleno?</label>
    <input type="hidden" name="idDias" form="diasAtualizar" value="<?php echo $diaCarenciaPlanoArray['idcarenciaPlano']; ?>"/>
    <input form="diasAtualizar" class="campoTexto" type="text" name="dias" value="<?php echo $diaCarenciaPlanoArray['diasCarenciaPlano']; ?>">


    <input form="diasAtualizar" type="submit" class="botao" value="Atualizar">


    </form>

    <?php endif;?>
</div>