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

        elseif ($mensagem == "Chave já cadastrada!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>



    <?php

    $diasAreceber = new DiaAreceber();
    $diaAreceberArray = $diasAreceber->getAllByEmpresa($_SESSION['idEmpresa']);


    if (!isset($diaAreceberArray)):

    ?>



        <input type="hidden" id="idEmpresa" value="<?php echo $idEmpresa; ?>" />

        <h1 class="estiloBorda">Integrações</h1>

        <br />

        <h4 style="opacity: 0.8;">Escolha o banco para integração.</h4>

        <br />

        <form method="POST" action="<?php echo BASE_URL; ?>Bancos/cadastrar">


            <input type="text" id="idEmpresa" value="<?php echo $idEmpresa; ?>" />

            <label class="rotulo">Qual o banco?</label>

            <select name="nomeBanco" class="campoTexto" id="listabancos">

                <option value="vazio">Escolha o seu banco...</option>

            </select>

            <label class="rotulo">Qual a chave?</label>
            <input class="campoTexto" type="text" name="chave" />


            <input type="submit" class="botao" value="Salvar">


        </form>

    <?php

    else:

    ?>



        <h1 class="estiloBorda">Integrações</h1>

        <br />

        <h4 style="opacity: 0.8;">Escolha o banco para integração.</h4>

        <br />

        <form method="POST" action="<?php echo BASE_URL; ?>Integracoes/cadastrar">


            <input type="hidden" id="idEmpresa" value="<?php echo $idEmpresa; ?>" />

            <label class="rotulo">Qual o banco?</label>

            <select name="nomeBanco" class="campoTexto" id="listabancos">

                <option value="vazio">Escolha o seu banco...</option>

            </select>

            <label class="rotulo">Qual a chave?</label>
            <input class="campoTexto" type="text" name="chave" />


            <input type="submit" class="botao" value="Salvar">


        </form>


    <?php endif; ?>
</div>