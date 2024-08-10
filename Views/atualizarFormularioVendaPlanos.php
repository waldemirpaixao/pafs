<script type="text/javascript">
    //Submenu
    $('li').eq(10).addClass('stiloFixoSubmenu');

    //Menu
    $('li').eq(9).addClass('stiloFixo');
    $("#submenuVendas").fadeToggle("slow");
</script>

<?php

use \Models\Clientes;
use \Models\Empresa;
use \Models\Dependentes;
use \Models\Planos;
use \Models\Vendedor;
use \Models\ComplementoPlano;
use Models\Contrato;
use Models\FormaDePagamento;

$empresa = new Empresa();
$dadosEmpresa = $empresa->getEmpresaByIdColaborador($_SESSION['idColaboradores']);

$clientes = new Clientes();
$cliente = $clientes->getClientById($id);
$dependente = new Dependentes();
$dependent = $dependente->getDependentesByIdTitular($id);

//planos

$planos = new Planos();
$plano = $planos->getAllPlanos($_SESSION['idEmpresa']);

//Vendedores

$vendedores = new Vendedor();
$vendedor = $vendedores->getAllVendedor($_SESSION['idEmpresa']);


// complemento
$complementoPlanos =  new ComplementoPlano();
$complementoPlano = $complementoPlanos->getAllComplementoPlanos($_SESSION['idEmpresa']);


//Forma De Pagamento
$formaDePagamento = new FormaDePagamento();
$formaPagamentoArray = $formaDePagamento->getAllByEmpresa($_SESSION['idEmpresa']);

//require('vendor/autoload.php');


//pegar as informações do contrato
$contrato = new Contrato();
$contatoArray = $contrato->getcontratobyIdCliente($id);

?>

<section class="planosTotal">

    <div class="conteudo">
        <div class="logo">
            <img width="60%" src="<?php echo BASE_URL; ?>/assets/imagens/LogoMarca.png">
        </div>


    </div>

    <form target="_blank" id="salvar" action="<?php echo BASE_URL; ?>FormularioVendaPlanos/registerVenda" method="post">


        <div class="formularioTotal">
            <h1 class="estiloBorda">Atualização de Venda de Planos</h1>
            <br />
            <br />

        <label class="estiloBorda">Número do Contrato: <?php echo $contatoArray['numeroContrato'];?></label>

            <label class="estiloBorda">Contratante: <?php echo $cliente['nomeClientes']; ?></label>

            <br />
            <br />
            <div class="colunasConteudo">




                <div class="colunas">

                    <!--Id do cliente-->
                    <input type="hidden" value="<?php echo $cliente['idClientes'] ?>" name="idCliente">

                    <label class="rotulo">Data de Adesão</label>
                    <input id="dataAdesao" class="campoTexto" type="date" name="dataAdesao" value="<?php echo $contatoArray['dataAdesao'];?>">

                </div>


                <div style="display: flex;">
                    <div class="colunaVendedor">
                        <label class="rotulo">Data de Vigência</label>
                        <input id="dataVigencia" class="campoTexto" type="date" name="dataVencimento" value="<?php echo $contatoArray['dataAdesao'];?>">

                    </div>
                    <div class="colunaVendedor">
                        <label class="rotulo">Desconto</label>
                        <input id="desconto" class="campoTexto" type="text" name="desconto" value="0">
                        <script>
                            $('#desconto').mask("#.##0,##", {
                                reverse: true
                            });
                        </script>

                    </div>
                </div>


                <div class="colunas">




                    <label class="rotulo">Vendedor</label><br>
                    <select id="vendedor" name="vendedor">

                        <option id="vendedor" name="vendedor" value="nulo">Escolha o vendedor...</option>
                        <?php
                        foreach ($vendedor as $todosVendedores) :
                        ?>
                            <option name="vendedor" value="<?php echo $todosVendedores['idVendedores']; ?>"><?php echo $todosVendedores['nomeVendedores'] ?></option>


                        <?php
                        endforeach;
                        ?>

                    </select>






                </div>



            </div>



            <div class="colunasConteudo">
                <div class="colunas">
                <label class="rotulo">Forma de Pagamento</label><br />
                <select class="campoTexto" id="formaPagamento" name="formaPagamento">
                    <option value="nulo">Escolha a sua opção...</option>

                    <?php
                    foreach ($formaPagamentoArray as $formaPagamento) :
                    ?>
                        <option value="<?php echo $formaPagamento['idformaPagamento']; ?>"><?php echo $formaPagamento['nomeformaPagamento'] ?></option>


                    <?php
                    endforeach;
                    ?>

                </select>
                </div>
                
                <div class="colunas"  style="padding:25px;">
                <label class="rotulo">Portabilidade</label><br />
                <input  type="radio" name="portabilidade" id="sim" value="sim"> <label class="rotulo" for="sim">Sim</label>
                <input  type="radio" name="portabilidade" id="nao" value="não"> <label class="rotulo" for="nao">Não</label>
                <br />
                <br />
            </div>



            </div>

            <br/>
              

            <div >
                <label>Observação</label><br/>
                <textarea name="observacao" style="width:100%; padding:10px;" rows="3"></textarea>
            </div>
                         

            </div>

            
            
    
         


           <br/>
           <br/>
            <div class="painel">PLANOS</div>



            <?php
            foreach ($plano as $todosPlanos) :
            ?>

                <div class="colunaTotal">

                    <br />


                    <input id="a<?php echo $todosPlanos['idPlanos']; ?>" class="clickPlanos" type="radio" name="plano" value="<?php echo $todosPlanos['idPlanos']; ?> " />
                    <label for="a<?php echo $todosPlanos['idPlanos']; ?>" onclick="valorPlano(this)" id="<?php echo $todosPlanos['idPlanos']; ?>" class="rotulo" style="cursor: pointer;"> <?php echo $todosPlanos['nomePlanos'] . " - R$ " . $todosPlanos['valorPlanos']; ?> </label>
                    <input id="valor<?php echo $todosPlanos['idPlanos']; ?>" type="hidden" value="<?php echo $todosPlanos['valorPlanos']; ?>" name="valorPlanoParcial" />

                    <div>
                        <?php echo $todosPlanos['descricao']; ?>
                    </div>

                </div>


            <?php

            endforeach;

            ?>


            <br />
            <div class="painel">DEPENDENTES</div>
            <br />

            <div class="linhasColunas">

                <div class="bordasTabelas">Dependentes</div>
                <div class="bordasTabelas">CPF</div>
                <!--  <div class="bordasTabelas">Data de Nascimento</div>-->

            </div>

            <?php if ($dependent != NULL) :

            ?>


                <?php if (count($dependent) <= 8 || count($dependent) >= 8) : ?>

                    <?php foreach ($dependent as $depende) : ?>
                        <div class="linhasColunas">

                            <input type="hidden" name="idDependente[]" value="<?php echo $depende['idDependentes']; ?>" />
                            <div class="conteudoTabelas"><?php echo $depende['nomeDependentes']; ?></div>
                            <div class="conteudoTabelas"><?php echo $depende['cpfDependentes'] != null ? $depende['cpfDependentes'] : 'Não Informado'; ?></div>
                            <!--<div class="conteudoTabelas"><//?php echo date("d/m/Y", strtotime($depende['dataNascimentoDependentes'])); ?></div>-->


                        </div>

                    <?php endforeach; ?>

                    <?php if (count($dependent) > 8) : ?>

                        <div class="subtirinhas">
                            <h3 style="color: #ff0000; font-weight: bold;">Será Cobrada uma taxa adicional, igual ao valor de R$ 5,00 reais por pessoa, a quantidade de Dependentes é superior a 8 </h3>
                        </div>

                        <input id="dependente" type="hidden" name="valorExtraDependente" value="<?php echo (count($dependent) - 8) * 5; ?>">
                    <?php endif;  ?>


                    <!--<//?php foreach ($dependent as $depende) : ?>
                <div class="linhasColunas">

                    <input type="hidden" name="idDependente[]" value="<//?php echo $depende['idDependentes']; ?>" />
                    <div class="conteudoTabelas"><//?php echo $depende['nomeDependentes']; ?></div>
                    <div class="conteudoTabelas"><//?php echo $depende['cpfDependentes']!= null? $depende['cpfDependentes']: 'Não Informado'; ?></div>-->
                    <!--<div class="conteudoTabelas"><//?php echo date("d/m/Y", strtotime($depende['dataNascimentoDependentes'])); ?></div>-->


                    <!--</div>-->

                    <!--<//?php endforeach; ?>-->
                <?php endif; ?>

            <?php else : ?>
                <input id="dependente" type="hidden" name="valorExtraDependente" value="<?php echo 0; ?>">
            <?php endif; ?>

            <hr>



            <hr />
            
            <!--<div class="colunasConteudo">

            <div class="colunaVendedor">

                <label class="rotulo">Assinatura digital do Vendedor</label>
                <input id="assinaturaDigitalVendedor" type="hidden" name="assinaturaDigitalVendedor"  />
                <div class="assinaturaDigital" style="padding: 10px; font-size: 20px; line-height: 70px; border-top-left-radius: 35px; border-bottom-left-radius:35px">
                    <div style="width: 70px; height: 70px; background-color: #ffffff; border-radius: 35px;">
                        <img width="40px" src="<//?php echo BASE_URL . "assets/imagens/assinatura.svg"; ?>">
                    </div>&nbsp;
                    <div id="hashDigitalVendedor"></div>


                </div>



            </div>-->






        </div>


        <!--<label class="rotulo">Assinatura digital do Associado Titular</label><br>
        <input type="hidden" name="assinaturaDigitalClientes" value=" <//?php echo $cliente['assinaturaDigitalClientes']; ?>" />
        <div class="assinaturaDigital" style="padding: 10px; font-size: 20px; line-height: 70px; border-top-left-radius: 35px; border-bottom-left-radius:35px">
            <div style="width: 70px; height: 70px; background-color: #ffffff; border-radius: 35px;">
                <img width="40px" src="<//?php echo BASE_URL . "assets/imagens/assinatura.svg"; ?>">
            </div>&nbsp;

            <//?php echo $cliente['assinaturaDigitalClientes']; ?>
        </div>




        </div>-->

        <div class="total">

            <div style="display:flex; ">

                <h1>Total:</h1> ;&nbsp;<h1 id="valor" style="color:red;">R$ 00,00</h1>
                <input type="hidden" id="valorPlano" name="valorPlano" value="0">
            </div>
        </div>

        <div class="painelBotao">
            <input type="submit" value="Atualizar Contrato" name="salvar" class="btn-salvar80">
        </div>
        <br />
        <br />
        <div class="painelBotao">
            <div class="painel">



                <h1><?php echo $dadosEmpresa['nomeEmpresa'] . '-' . $dadosEmpresa['siglaEmpresa']; ?></h1>
                <br />
                <div class="fonte">
                    <?php echo $dadosEmpresa['enderecoEmpresa'] . ", " . $dadosEmpresa['numeroEmpresa'] . " - " . $dadosEmpresa['bairroEmpresa'] . " - "; ?>
                    <?php echo $dadosEmpresa['cidadeEmpresa'] . " - " . $dadosEmpresa['estadoEmpresa']; ?><br />
                    <?php echo "Tel: " . $dadosEmpresa['telefoneEmpresa'] . " -  E-mail: " . $dadosEmpresa['emailEmpresa']; ?>
                </div>
                <br />
                <br />

            </div>
        </div>

    </form>


</section>