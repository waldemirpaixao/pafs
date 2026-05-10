<script type="text/javascript">
    //Submenu
    $('li').eq(10).addClass('stiloFixoSubmenu');

    //Menu
    $('li').eq(9).addClass('stiloFixo');
    $("#submenuVendas").fadeToggle("slow");
</script>

<div class="margem">

    <br>
    <br>




    <?php
    /*echo "SERVER";
      print_r("\n");
      echo print_r($_SERVER);
      print_r("\n");
      echo "--------------------------------------------";
      print_r("\n");
      echo "REQUEST";
      print_r("\n");
      echo print_r($_REQUEST);
      echo "\n";
        echo "Ano corrente";
      echo $_SESSION['ano'];*/


    use \Models\Clientes;
    use Models\Venda;

    if (isset($mensagem)):
        if ($mensagem == "Cliente cadastrado com sucesso!"):


    ?>

            <div class="success alinhamentoCentro"><?php echo $mensagem; ?> </div>

        <?php

        elseif ($mensagem == "Não foi possível cadastrar o cliente!"):


        ?>


            <div class="danger alinhamentoCentro"><?php echo $mensagem; ?> </div>
    <?php endif;
    endif; ?>





    <h1 class="estiloBorda">Venda de Planos</h1>
    <br/>
    <hr/>

    <!--Link do modal-->
    <!-- <div class=" card circulo">

        <img data-toggle="modal" data-target="#clientes" class="circulo" src="<?php echo BASE_URL; ?>assets/imagens/add.svg">
    </div>-->



    <?php
    $cliente = new Clientes();
    $allClient = isset($viewData['allClient']) ? $viewData['allClient'] : $cliente->getAllCliente($_SESSION['idEmpresa']);
    $pagina = isset($viewData['pagina']) ? $viewData['pagina'] : 1;
    $totalPaginas = isset($viewData['totalPaginas']) ? $viewData['totalPaginas'] : 1;
    //print_r($allClient);
    // exit();

    $venda = new Venda();





    if ($allClient != NULL) {




        foreach ($allClient as $clientes) {
            $arrayVenda = $venda->getVendaByIdCliente($clientes['idClientes']);

            if (!isset($arrayVenda)):
    ?>




                <div class="tirinhas">


                    <div class="subtirinhas"><?php echo $clientes['nomeClientes']; ?></div>


                    <div class="subtirinhas">
                        <div class="alinhamentoDireito">
                            <div>
                                <a id="atualizar" href="<?php echo BASE_URL; ?>FormularioVendaPlanos/planos/<?php echo $clientes['idClientes']; ?>"><img alt="Realizar compras" title="carrinho de compras" class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/supermarket.svg" /></a>
                                <a id="evoluirContrato" href="<?php echo BASE_URL; ?>FormularioVendaPlanos/planos/<?php echo $clientes['idClientes']; ?>"><img alt="Evoluir Contrato" title="Evoluir Contrato" class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/contrato.png" /></a>
                            </div>
                        </div>

                    </div>


                </div>
                <hr/>


            <?php

            else:

            ?>



                <div class="tirinhas">




                    <div class="subtirinhas"><?php echo $clientes['nomeClientes']; ?></div>



                    <div class="subtirinhas">
                        <div class="alinhamentoDireito">
                            <div>
                                <a id="atualizar" href="<?php echo BASE_URL; ?>AtualizarFormularioVendaPlanos/atualizarPlanos/<?php echo $clientes['idClientes']; ?>"><img alt="Atualizar compras" title="Atualizar compras" class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/atualizar_compras.png" /></a>
                                <a id="evoluirContrato" href="<?php echo BASE_URL; ?>FormularioVendaPlanos/planos/<?php echo $clientes['idClientes']; ?>"><img alt="Evoluir Contrato" title="Evoluir Contrato" class="imagemPequena" src="<?php echo BASE_URL; ?>assets/imagens/contrato.png" /></a>
                            </div>
                        </div>
                    </div>



                </div>
<hr/>

        <?php
            endif;
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

    <?php
    // Adicionar paginação aqui se $totalPaginas > 1
    if (isset($totalPaginas) && $totalPaginas > 1) : //verifica se há mais de uma página
    ?>

        <div class="alinhamentoCentro">
            <ul class="pagination">

                <?php
                // Paginação enxuta: mostra apenas algumas páginas ao redor da atual
                $maxLinks = 5; // Número máximo de links de página a mostrar
                $inicio = max(1, $pagina - floor($maxLinks / 2));
                $fim = min($totalPaginas, $inicio + $maxLinks - 1);

                // Ajusta o início se o fim estiver no limite
                if ($fim - $inicio + 1 < $maxLinks) {
                    $inicio = max(1, $fim - $maxLinks + 1);
                }

                // Link para Anterior
                if ($pagina > 1) :
                ?>
                    <li><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/<?php echo $pagina - 1; ?>">&laquo; Anterior</a></li>
                <?php endif; ?>

                <?php
                // Link para primeira página se necessário
                if ($inicio > 1) :
                ?>
                    <li><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/1">1</a></li>
                    <?php if ($inicio > 2) : ?>
                        <li class="disabled"><span>...</span></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php
                // Links das páginas centrais
                for ($q = $inicio; $q <= $fim; $q++) :
                    if ($pagina == $q) :
                ?>
                        <li class="active"><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/<?php echo $q; ?>"><?php echo $q; ?></a></li>
                    <?php else : ?>
                        <li><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/<?php echo $q; ?>"><?php echo $q; ?></a></li>
            <?php
                    endif;
                endfor;
                ?>

                <?php
                // Link para última página se necessário
                if ($fim < $totalPaginas) :
                    if ($fim < $totalPaginas - 1) :
            ?>
                        <li class="disabled"><span>...</span></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/<?php echo $totalPaginas; ?>"><?php echo $totalPaginas; ?></a></li>
                <?php endif; ?>

                <?php
                // Link para Próximo
                if ($pagina < $totalPaginas) :
                ?>
                    <li><a href="<?php echo BASE_URL; ?>VendaPlanos/pagina/<?php echo $pagina + 1; ?>">Próximo &raquo;</a></li>
                <?php endif; ?>

            </ul>
        </div>
    <?php endif; ?>

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