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

                         <label class="rotulo">Parcelas</label>
                         <select class="campoTexto" name="parcela">
                            <option value="">Selecione</option>
                            <option value="1">1x</option>
                            <option value="2">2x</option>
                            <option value="3">3x</option>
                            <option value="4">4x</option>
                            <option value="5">5x</option>
                            <option value="6">6x</option>
                            <option value="7">7x</option>
                            <option value="8">8x</option>
                            <option value="9">9x</option>
                            <option value="10">10x</option>
                            <option value="11">11x</option>
                            <option value="12">12x</option>
                            <option value="13">13x</option>
                            <option value="14">14x</option>
                            <option value="15">15x</option>
                            <option value="16">16x</option>
                            <option value="17">17x</option>
                            <option value="18">18x</option>
                            <option value="19">19x</option>
                            <option value="20">20x</option>
                            <option value="21">21x</option>
                            <option value="22">22x</option>
                            <option value="23">23x</option>
                            <option value="24">24x</option>
                            <option value="25">25x</option>
                            <option value="26">26x</option>
                            <option value="27">27x</option>
                            <option value="28">28x</option>
                            <option value="29">29x</option>
                            <option value="30">30x</option>
                            <option value="31">31x</option>
                            <option value="32">32x</option>
                            <option value="33">33x</option>
                            <option value="34">34x</option>
                            <option value="35">35x</option>
                            <option value="36">36x</option>
                            <option value="37">37x</option>
                            <option value="38">38x</option>
                            <option value="39">39x</option>
                            <option value="40">40x</option>
                            <option value="41">41x</option>
                            <option value="42">42x</option>
                            <option value="43">43x</option>
                            <option value="44">44x</option>
                            <option value="45">45x</option>
                            <option value="46">46x</option>
                            <option value="47">47x</option>
                            <option value="48">48x</option>   



                        </select>

                        <label class="rotulo">Indenização</label>
                        <input id="indenizacao" class="campoTexto" type="text" name="indenizacao" />
                        <script>
                            $("#indenizacao").mask('#.##0,00', {
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