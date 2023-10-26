<script type="text/javascript">
    $('li').eq(1).addClass('stiloFixo');
    $('li').eq(4).addClass('stiloFixoSubmenu');
    $("#submenuConfiguracoes").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php

    use Models\Bancos;

    if (isset($mensagem)) :

        if ($mensagem == "Salvo com sucesso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Não foi possivel salvar!") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Banco já Cadastrado!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>



    <?php

    $bancos = new Bancos();
    $arrayBancos = $bancos->getAllByEmpresa($_SESSION['idEmpresa']);

    ?>






    <!--Configuração de dependentes extras-->
    <h1 class="estiloBorda">Adicionar Bancos</h1>
    <br />
    <br />
    <br />
    <br />

    <form method="POST" action="<?php echo BASE_URL; ?>Bancos/cadastrar">



        <label class="rotulo">Quais bancos a empresa trabalha?</label>
        <!--<input list="listabancos" id="bancos" class="campoTexto" type="text" name="nomeBanco">-->



      <!--<datalist class="campoTexto" id="listabancos" > </datalist>-->


      <select name="nomeBanco" class="campoTexto" id="listabancos">

      <option value="vazio">Escolha o seu banco...</option>

      </select>
       

        <input type="submit" class="botao" value="Salvar">


    </form>

    <hr />

    <?php


    if (isset($arrayBancos)) :

        ?>

        <h1 class="estiloBorda">Lista dos meus Bancos</h1>
<br>
        <?php
        foreach ($arrayBancos as $bancoArray) :

    ?>



           


   

            <div class="tirinhas">
                <div class="subtirinhas">
                    <div class="">

                        <div><?php echo $bancoArray['nomebanco']; ?>
                    <br/>
                    <br/>
                    </div>

                    </div>
                </div>




            </div>




        <?php

        endforeach;
        ?>

    <?php

    else :

    ?>

<br/>

<h1 class="estiloBorda">Lista dos meus Bancos</h1>

        <h3 class="alinhamentoCentro">Não existe Bancos cadastrados!</h3>



    <?php

    endif;
    ?>




</div>