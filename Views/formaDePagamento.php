<script type="text/javascript">
    $('li').eq(1).addClass('stiloFixo');
    $('li').eq(3).addClass('stiloFixoSubmenu');
    $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php

    use Models\FormaDePagamento;

    if (isset($mensagem)) :

        if ($mensagem == "Salvo com sucesso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Não foi possivel salvar!") :


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

    $formaPagamento = new FormaDePagamento();
    $arrayFormaPagamento = $formaPagamento->getAllByEmpresa($_SESSION['idEmpresa']);

    ?>






    <!--Configuração de dependentes extras-->
    <h1 class="estiloBorda">Adicionar forma de pagamentos</h1>
    <br />
    <br />
    <br />
    <br />

    <form method="POST" action="<?php echo BASE_URL; ?>FormaDePagamento/cadastrar">



        <label class="rotulo">Forma de pagamento</label>
        <input class="campoTexto" type="text" name="formaPagamento">


        <input type="submit" class="botao" value="Salvar">


    </form>

    <hr />

    <?php

    if (isset($arrayFormaPagamento)) :
    ?>
        <h1 class="estiloBorda">Minhas formas de pagamentos</h1>
        <br/>
        <?php

        foreach ($arrayFormaPagamento as $formaPagamentoArray) :

        ?>




            <div class="tirinhas">
                <div class="subtirinhas">
                    <div class="">

                        <div><img class="imagemPequena" title="<?php echo $formaPagamentoArray['nomeformaPagamento']; ?>" src="<?php echo BASE_URL; ?>assets/imagens/<?php echo strtolower($formaPagamentoArray['nomeformaPagamento']) . ".png"; ?>" /> <?php echo $formaPagamentoArray['nomeformaPagamento']; ?></div>

                    </div>
                </div>




            </div>
        <?php
        endforeach;
    else :

        ?>

<br/>
<h1 class="estiloBorda">Minhas formas de pagamentos</h1>
<br/>
        <h3 class="alinhamentoCentro">Não existe forma de pagamento cadastrada!</h3>


    <?php


    endif;
    ?>






</div>