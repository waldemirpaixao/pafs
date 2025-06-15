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

    $integracoes = new Integracoes();
    $chave = $integracoes->getEmpresaById($idEmpresa);




    if (isset($mensagem)) :



        if ($mensagem == "Salvo com sucesso!" || $mensagem == "Atualizado com sucesso!" || $mensagem == "Excluído com sucesso!" ) :


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
 <hr/>
    <!--<h4 style="opacity: 0.8;">Escolha o banco para integração.</h4>-->

    <br />

    <img src=<?php echo BASE_URL . "assets/imagens/banco-asaas.jpeg"; ?> title="Banco Asaas" alt="Banco Assas" />


    <?php
    if ($chave != NULL) {

    ?>

        <div id="boxClientes">

            <div class="tirinhas">
                 <div class="subtirinhas">
                    <?php echo substr($chave, 0,  50)." ......";?>
    </div>

                <div class="subtirinhas">
                    <div class="alinhamentoDireito">

                      <div>
                        <a id="atualizar" href="<?php echo BASE_URL; ?>Integracoes/atualizar/<?php echo $idEmpresa; ?>"><img class="imagemPequena" title="Atualizar" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                        <a href="<?php echo BASE_URL; ?>Integracoes/deletar/<?php echo $idEmpresa; ?>"><img onclick="return confirm('Deseja realmente deletar a chave')" class="imagemPequena" title="Excluir" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
                    </div>
                    <div>

                </div>


            </div>
        </div>
    <?php
    } else {

    ?>

        <form method="POST" action="<?php echo BASE_URL; ?>Integracoes/cadastrar">


            <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $idEmpresa; ?>" />
            <input class="campoTexto" type="hidden" name="nomeBanco" value="ASAAS GESTÃO FINANCEIRA INSTITUIÇÃO DE PAGAMENTOS S.A." />

            <label class="rotulo">Qual a chave?</label>
            <input class="campoTexto" type="text" name="chave" />


            <input type="submit" class="botao" value="Salvar">


        </form>
    <?php } ?>


</div>