<script type="text/javascript">
    $('li').eq(1).addClass('stiloFixo');
    $('li').eq(5).addClass('stiloFixoSubmenu');
    $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br/>
    <br/>
   

    <?php

    use Models\DiaAreceber;

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

    $diasAreceber = new DiaAreceber();
    $diaAreceberArray = $diasAreceber->getAllByEmpresa($_SESSION['idEmpresa']);


    if(!isset($diaAreceberArray)):

    ?>



   
    <h1 class="estiloBorda">Dias a receber</h1>

    <br />

    <h4 style="opacity: 0.8;">Informe a quantidade de dias antes do vencimento, deseja que gere o boleto.</h4>

    <br />

    <form id="diasCadastrar" method="POST" action="<?php echo BASE_URL; ?>DiasAreceber/cadastrar">



        <label class="rotulo">Quantos dias?</label>
        <input form="diasCadastrar" class="campoTexto" type="text" name="dias"/>


        <input form="diasCadastrar" type="submit" class="botao" value="Salvar"/>


    </form>

    <?php

    else:

    ?>



    <h1 class="estiloBorda">Atualizar Dias a receber</h1>

    <br />

    <h4 style="opacity: 0.8;">Informe a quantidade de dias antes do vencimento, deseja que gere o boleto.</h4>

    <br />

    <form id="diasAtualizar" method="POST" action="<?php echo BASE_URL; ?>DiasAreceber/atualizar">



    <label class="rotulo">Quantos dias?</label>
    <input type="hidden" name="idDias" form="diasAtualizar" value="<?php echo $diaAreceberArray['iddiaAreceber']; ?>"/>
    <input form="diasAtualizar" class="campoTexto" type="text" name="dias" value="<?php echo $diaAreceberArray['dias']; ?>">


    <input form="diasAtualizar" type="submit" class="botao" value="Salvar">


    </form>

    <?php endif;?>
</div>