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

    use Models\Integracoes;

    $integracaoes = new Integracoes();
    $integracao = $integracaoes->getIntegracoes($idEmpresa);




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





    <h1 class="estiloBorda"> Atualizar Integrações</h1>

    <br />
 <hr/>
    <!--<h4 style="opacity: 0.8;">Escolha o banco para integração.</h4>-->

    <br />


        <form method="POST" action="<?php echo BASE_URL; ?>Integracoes/atualizarChave">


            <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $integracao["empresa_idEmpresa"];?>" />
            <input type="hidden" name="idIntegracao" id="idIntegracao" value="<?php echo $integracao["idintegracao"];?>" />
            

            <label class="rotulo">Atualize a Chave</label>
            <input class="campoTexto" type="text" name="chave" value="<?php echo $integracao["chave"];?>"/>


            <input type="submit" class="botao" value="Atualizar a Chave">


        </form>
  


</div>