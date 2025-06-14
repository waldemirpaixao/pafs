<script type="text/javascript">
    $('li').eq(5).addClass('stiloFixoSubmenu');
    $('li').eq(3).addClass('stiloFixo');
    $("#submenuCadastros").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php


    use \Models\Clientes;
    use  \Models\Venda;



    if (isset($mensagem)) :
        if ($mensagem == "Cliente cadastrado com sucesso!") :


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Não foi possível cadastrar o cliente!" || $mensagem == "Cliente Já Cadastrado") :


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif; ?>




    <div class="flexivel">
        <div>
            <h1 class="estiloBorda">Cadastro de clientes</h1>
        </div>
        <!--Link do modal-->
        <div class=" card circulo">

            <img alt="Adicionar Dependentes" title="Adicionar Dependentes" data-toggle="modal" data-target="#clientes" class="circulo" src="<?php echo BASE_URL; ?>assets/imagens/add.svg">
        </div>
    </div>




    <br />
    <div class="margin-15">
        <input type="text" placeholder="Digite o nome do cliente..." class="campoTexto" id="nomeCliente">
    </div>
    <br />
    <Strong>Nome</Strong>
    <hr />
    <?php

    $cliente = new Clientes();

    $allClient = $cliente->getAllCliente($_SESSION['idEmpresa']);

    $pagina = $page; //vindo do clicar na página


    $totalDeItens = count($allClient);

    $itensPorPagina = 10; //quantidade de itens por página


    $respostaClientePorPagina = $cliente->getClientePorPagina($pagina, $itensPorPagina, $_SESSION['idEmpresa']);

    $totalPaginas = ceil($totalDeItens / $itensPorPagina); //total de páginas, arredondando para cima








    if ($respostaClientePorPagina != NULL) {






        foreach ($respostaClientePorPagina as $clientes) {


            $venda = new Venda();
            $vendaPorCliente = $venda->getVendaByIdCliente($clientes['idClientes']);
    ?>

            <div id="boxClientes">

                <div class="tirinhas">



                    <div class="subtirinhas"><?php echo $clientes['nomeClientes']; ?></div>
                    <div class="subtirinhas">
                        <div class="alinhamentoDireito">
                            <?php


                            if (isset($vendaPorCliente)) :

                            ?>

                                <a target="_blank" href="<?php echo BASE_URL; ?>Contrato/recuperarContrato/<?php echo $clientes['idClientes'] . "/" . $vendaPorCliente['vendedores_idVendedores']; ?>"><img class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>
                            <?php
                            else :

                            ?>


                                <a data-toggle="modal" data-target="#mensagemContrato" href="#"><img style="opacity: 90%; cursor:not-allowed" class="imagemPequena" title="Recuperar Contrato" src="<?php echo BASE_URL; ?>assets/imagens/document.svg" /></a>


                            <?php
                            endif;
                            ?>

                            <img id="<?php echo $clientes['idClientes']; ?>" onclick="mostrar(this)" class="imagemPequena ponteiro" title="Detalhe" src="<?php echo BASE_URL; ?>assets/imagens/detalhes.png" /></a>
                            <a id="atualizar" href="<?php echo BASE_URL; ?>Clientes/atualizarClientes/?id=<?php echo $clientes['idClientes']; ?>"><img class="imagemPequena" title="Atualizar" src="<?php echo BASE_URL; ?>assets/imagens/refresh.svg" /></a>
                            <a href="<?php echo BASE_URL; ?>Clientes/deletarClientes/<?php echo $clientes['idClientes']; ?>"><img onclick="return confirm('Deseja realmente deletar o cliente <?php echo $clientes['nomeClientes']; ?>')" class="imagemPequena" title="Excluir" src="<?php echo BASE_URL; ?>assets/imagens/delete.svg" /></a>
                        </div>

                    </div>


                </div>

                <div id="<?php echo "detalhes" . $clientes['idClientes']; ?>" class="detalhes" style="display: none;">


                    <div class="detalhesConteudo">
                        <ul>
                            <li><?php echo "RG:" . $clientes['rgClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "CPF:" . $clientes['cpfClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "Endeço: " . $clientes['enderecoClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "CEP: " . $clientes['cepClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "Cidade: " . $clientes['cidadeClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "Estado: " . $clientes['estadoClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "Telefone: " . $clientes['telefoneClientes']; ?></li>
                            <br />
                            <br />
                            <li><?php echo "Data de Nascimento: " . date("d/m/Y", strtotime($clientes['dataNascimentoClientes'])); ?></li>
                            <br />
                            <br />
                            <li><?php echo "Situação: " . $clientes['situacao']; ?></li>

                    </div>



                </div>

                <hr />

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

    if ($totalPaginas > 1) : //verifica se há mais de uma página

        ?>

            <div class="alinhamentoCentro">
                <ul class="pagination">

                    <?php
                    for ($q = 1; $q <= $totalPaginas; $q++) :
                        if ($pagina == $q) :
                    ?>
                            <li class="active"><a href="<?php echo BASE_URL; ?>Clientes/pagina/<?php echo $q; ?>"><?php echo $q; ?></a></li>
                        <?php else : ?>
                            <li><a href="<?php echo BASE_URL; ?>Clientes/pagina/<?php echo $q; ?>"><?php echo $q; ?></a></li>
                    <?php
                        endif;
                    endfor;
                    ?>
                </ul>
            </div>
        <?php endif; ?>


            </div>





            <div class="modal" role="dialog" id="mensagemContrato">
                <div class="modal-dialog modal-sm-">

                    <div class="modal-content">
                        <div class="modal-header">

                            <button class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title estiloBorda">Mensagem</h2>
                        </div>

                        <div class="modal-body">


                            <br />
                            <br />
                            <br />
                            <h3 class="alinhamentoCentro">Por favor, realizar primeiro a venda do plano para o cliente!</h3>

                            <br />
                            <br />
                            <br />



                            <div class="modal-footer">

                                <br />
                                <h3 class="modal-title estiloBorda">PAFS</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


</div>








<!--modal-->


<div class="modal" role="dialog" id="clientes">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">

                <button class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title estiloBorda">Cadastro de clientes</h2>
            </div>

            <div class="modal-body">

                <form id="form" method="Post" action="<?php echo BASE_URL; ?>Clientes/registerClientes">

                    <br>
                    <br>
                    <br>
                    <label class="rotulo">Nome Completo</label>
                    <input class="campoTexto" type="text" name="nome" />


                    <label class="rotulo">Data de Nascimento</label>
                    <input class="campoTexto" type="date" name="dataNascimento" />


                    <label class="rotulo">RG</label><br>
                    <input class="campoTexto" type="text" name="rg" />

                    <label class="rotulo">CPF</label><br>
                    <input class="campoTexto" type="text" name="cpf" />


                    <br>
                    <label class="rotulo" for="telephone">Telefone</label>
                    <input class="campoTexto" maxlength="11" id="telephone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" type="tel" name="telefone" /><br>

                    <script type="text/javascript">
                        $('#telephone').mask("(00) 0000-00009");
                    </script><!--Mascara telefone-->


                    <label class="rotulo">E-m@il</label>
                    <input class="campoTexto" type="email" name="email" />



                    <label class="rotulo">Endereço</label>
                    <input class="campoTexto" id="endereco" type="text" name="endereco" />

                    <label class="rotulo">CEP</label>
                    <input class="campoTexto" id="CEP" type="text" name="cep" />


                    <label class="rotulo">Complemento</label>
                    <input class="campoTexto" id="complemento" type="text" name="complemento" />

                    <label class="rotulo">Ponto de referência</label>
                    <input class="campoTexto" type="text" name="pontoreferencia" />



                    <label class="rotulo">Bairro</label>
                    <input class="campoTexto" id="bairro" type="text" name="bairro" />

                    <label class="rotulo">Cidade</label>
                    <input class="campoTexto" id="cidade" type="text" name="cidade" />


                    <label class="rotulo">Estado</label>
                    <input class="campoTexto" id="estado" type="text" name="estado" />

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