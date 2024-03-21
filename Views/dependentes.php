<script type="text/javascript">
    $('li').eq(6).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php

    use \Models\Dependentes;
    use \Models\Clientes;

    if (isset($mensagem)) :

        if ($mensagem == "Dependente cadastrado com sucesso!" || $mensagem == "Dependente deletado com sucesso!" ) :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Não foi possível cadastrar o dependente!" || $mensagem = "Ops! algo deu errado.") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Dependente já Cadastrado!") :

        ?>
            <div class="warning alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif;
    ?>



    <div class="flexivel">
        <div>
            <h1 class="estiloBorda">Cadastro de dependentes</h1>
        </div>
        <!--Link do modal-->
        <div class=" card circulo">

            <img alt="Adicionar Dependentes" title="Adicionar Dependentes" data-toggle="modal" data-target="#clientes" class="circulo" src="<?php echo BASE_URL; ?>assets/imagens/add.svg">
        </div>
    </div>




    <br />
    <br />
    <br />
    <br />




    <?php
    $dependentes = new Dependentes();
    $allDependentes = $dependentes->getAllDependentes($_SESSION['idEmpresa']);
    //print_r($allClient);
    // exit();



    if ($allDependentes != NULL) {




        foreach ($allDependentes as $todosDependentes) {
    ?>


            <div class="tirinhas">

                <div class="subtirinhas"><?php echo $todosDependentes['nomeDependentes']; ?></div>
                <div class="subtirinhas"><?php echo "CPF: " . $todosDependentes['cpfDependentes']; ?></div>
                <div class="subtirinhas"><?php echo "Titular: " . $todosDependentes['nomeClientes']; ?></div>
                <div class="subtirinhas">
                    <div class="alinhamentoDireito">
                        <img id="<?php echo $todosDependentes['idDependentes']; ?>" onclick="mostrar(this)" class="imagemPequena ponteiro" title="Detalhe" src="<?php echo BASE_URL; ?>assets/imagens/detalhes.png" /></a>
                        <a id="atualizar" href="<?php echo BASE_URL; ?>Dependentes/atualizarDependentes/?id=<?php echo $todosDependentes['idDependentes']; ?>"><img class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                        <a href="<?php echo BASE_URL; ?>Dependentes/deletarDependentes/<?php echo $todosDependentes['idDependentes']; ?>"><img  onclick=" return confirm('Deseja escluir realmente o dependente <?= $todosDependentes['nomeDependentes']; ?> ?')"  class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
                        <div>
                        </div>


                    </div>
                </div>
            </div>
            <div style="display: none;" id="<?php echo "detalhes" . $todosDependentes['idDependentes']; ?>" class="detalhes">

                <div class="detalhesConteudo">
                    <ul>

                        <li><?php echo "CPF:" . $todosDependentes['cpfDependentes']; ?></li>
                        <br />
                        <br />
                        <li><?php echo "Data de nascimento: " . date("d/m/Y", strtotime($todosDependentes['dataNascimentoDependentes'])); ?></li>

                </div>
            </div>









        <?php
        } //end foreach
    } else {
        ?>

        <div class="tirinhas">

            <div class="subtirinhas alinhamentoCentro">
                <h3 style="font-size:25px; font-weight:bold;padding-bottom: 10px;">Não há registros</h3>
            </div>
        </div>


    <?php
    }
    ?>





    <!--modal-->


    <div class="modal" role="dialog" id="clientes">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">

                    <button class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title estiloBorda">Cadastro de Dependentes</h2>
                </div>

                <div class="modal-body">

                    <form id="form" method="Post" action="<?php echo BASE_URL; ?>Dependentes/registerDependentes">

                        <br>
                        <br>
                        <br>

                        <?php

                        $clientes = new Clientes();
                        $cliente = $clientes->getAllCliente($_SESSION['idEmpresa']);


                        ?>

                        <label class="rotulo">Escolha o titular do contrato</label>
                        <select class="campoTexto" name="idCliente">
                            <?php

                            foreach ($cliente as $todosClientes) :

                            ?>

                                <option value="<?php echo $todosClientes['idClientes']; ?>"><?php echo $todosClientes['nomeClientes']; ?></option>

                            <?php

                            endforeach;


                            ?>
                        </select>
                        <label class="rotulo">Nome Completo</label>
                        <input class="campoTexto" type="text" name="nome" placeholder="José da Silva" />

                        <label class="rotulo">CPF</label><br>
                        <input class="campoTexto" type="text" name="cpf" placeholder="033.024.987-00" />

                        <label class="rotulo">Data de Nascimento</label>
                        <input class="campoTexto" type="date" name="dataNascimento" />


                        <input class="botao" type="submit" value="Salvar" />

                    </form>
                    <div class="modal-footer">

                        <br />
                        <h3 class="modal-title estiloBorda">PAFS</h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>