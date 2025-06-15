<script type="text/javascript">
    $('li').eq(7).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>
<div class="margem">
    <br>
    <br>

    <div class="flexivel">
        <div>
            <h1 class="estiloBorda">Planos Funerais</h1>
        </div>
        <!--Link do modal-->
        <div class=" card circulo">

            <img alt="Adicionar Planos" title="Adicionar Planos" data-toggle="modal" data-target="#planos" class="circulo" src="<?php echo BASE_URL; ?>assets/imagens/add.svg">
        </div>
    </div>
    <hr/>
    

    <?php

    use \Models\Planos;
    use \Models\ComplementoPlano;

    if (isset($mensagem)) :


        if ($mensagem == "Salvo com sucesso!" || $mensagem == "Deletado com sucesso!") : ?>
            <div class="success alinhamentoCentro"><?php echo $mensagem; ?></div>
        <?php elseif ($mensagem == "Problema ao salvar o arqiuvo!" || $mensagem == "Não foi possivel deletar!") : ?>
            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?></div>
        <?php elseif ($mensagem == "Não foi possível salvar" || $mensagem == "Plano já cadastrado!") : ?>
            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?></div>
    <?php
        endif;
    endif;
    ?>

  






    <!--Pegando todos os planos desta empresa-->
    <?php
    $planosFunerais = new Planos;
    $plano = $planosFunerais->getAllPlanos($_SESSION['idEmpresa']);

    if ($plano != NULL) :
    ?>


        <?php foreach ($plano as $planos) { ?>


            <div class="tirinhas">
                <div class="subtirinhas">
                    <div class="coresPlanos"></div>
                </div>
                <div class="subtirinhas"><?php echo $planos['nomePlanos']; ?></div>
                <div class="subtirinhas"><?php echo "R$ " . $planos['valorPlanos']; ?></div>
                <div class="subtirinhas"><?php echo $planos['comissaoPlanos'] . "%"; ?></div>

                <div class="subtirinhas">
                    <div>
                        <div class="alinhamentoDireito">
                            <a id="atualizar" href="<?php echo BASE_URL; ?>Planos/atualizarPlanos/?id=<?php echo $planos['idPlanos']; ?>"><img class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                            <a href="<?php echo BASE_URL; ?>Planos/deletarPlanos/?id=<?php echo $planos['idPlanos']; ?>"><img class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
                        </div>
                    </div>
                </div>
            </div>

<hr/>

        <?php
        }

    else :
        ?>
        <div class="tirinhas">

            <div class="subtirinhas alinhamentoCentro">
                <h3 style="font-size:25px; font-weight:bold;padding-bottom: 10px;">Não há registros</h3>
            </div>
        </div>

    <?php endif; ?>

    <br />
    <br />

    <!--Modal-->

    <div class="modal" role="dialog" id="planos">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title estiloBorda">Planos PAFS</h2>
                </div>

                <div class="modal-body">

                    <form id="formPlanos" method="Post" action="<?php echo BASE_URL; ?>Planos/registerPlanos">

                        <br>
                        <br>
                        <br>

                        <label class="rotulo">Nome do plano</label>
                        <input class="campoTexto" id="endereco" type="text" name="nomePlano" />

                        <label class="rotulo">Valor do Plano</label>
                        <input id="plano" class="campoTexto" type="text" name="valorPlano" />
                        <script>
                            $("#plano").mask('#.##0,00', {
                                reverse: true
                            });
                        </script>

                        <label class="rotulo">Descrição</label>
                        <textarea class="campoTexto" name="descricao" rows="5"></textarea>


                        <label class="rotulo">Comissão do Plano</label>
                        <input class="campoTexto" type="number" name="comissaoPlano" />



                        <?php
                        //pegar os dados do pcomplemento do seguro

                        $complemento = new ComplementoPlano();
                        $complementoPlan = $complemento->getComplementoPlano($_SESSION['idEmpresa']);


                        ?>




                        <?php
                        if (isset($complementoPlan)) :
                        ?>
                            <h3 class="rotulo">Seguro: Complemento do plano</h3>

                            <?php
                            foreach ($complementoPlan as $complementPlan) : ?>



                                <input id="<?php echo $complementPlan['idComplementoPlano']; ?>" type="radio" name="comSemSeguro[]" value="<?php echo $complementPlan['idComplementoPlano']; ?>">
                                <label for="<?php echo $complementPlan['idComplementoPlano']; ?>" style="cursor: pointer;" class="rotulo"><?php echo $complementPlan['nomeComplementoPlano']; ?></label><br>
                        <?php
                            endforeach;
                        endif;
                        ?>
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