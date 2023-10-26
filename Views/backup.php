<script type="text/javascript">
    $('li').eq(8).addClass('stiloFixo');
    $("#submenuVendas").fadeToggle("slow");
</script>

<?php

use \Models\Clientes;
use \Models\Empresa;
use \Models\Dependentes;
use \Models\Planos;
use \Models\Vendedor;
use \Models\ComplementoPlano;
use \Mpdf\Mpdf;



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

//require('vendor/autoload.php');

?>

<section class="planosTotal">

    <div class="conteudo">
        <div class="logo">
            <img width="60%" src="<?php echo BASE_URL; ?>/assets/imagens/LogoMarca.png">
        </div>


    </div>

    <form action="<?php echo BASE_URL; ?>formularioVendaPlanos/registerVenda" method="post">

        <div class="formularioTotal">
            <div class="colunasConteudo">
                <div class="colunas">
                    <!--Id do cliente-->
                    <input type="text" value="<?php echo $cliente['idClientes'] ?>" name="idCliente">
                    <br />
                    <label class="rotulo">Data de Adesão</label>
                    <input class="campoTexto" type="date" name="data">

                </div>

                <div class="colunas">
                    <label class="rotulo">Número do Contrato</label>
                    <input value="<?php echo $cliente['cpfClientes'] . "/" . date('Y'); ?>" name="numeroContrato" class="campoTexto" type="texto" placeholder="123456789/2019">

                </div>


                <div class="colunas">




                    <label class="rotulo">Vendedor</label><br>
                    <select id="vendedor" name="vendedor">

                        <option name="vendedor" value="null">Escolha o vendedor...</option>
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
                    <label class="rotulo">Associado Titular</label>
                    <input class="campoTexto" type="texto" placeholder="José da Silva" name="nome" value="<?php echo $cliente['nomeClientes']; ?>">
                </div>
                <div class="colunas">

                    <label class="rotulo">Data de Nascimento</label>
                    <input class="campoTexto" type="date" name="dataNascimento" value="<?php echo $cliente['dataNascimentoClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">RG</label>
                    <input class="campoTexto" type="texto" placeholder="3.333.333-3" name="rg" value="<?php echo $cliente['rgClientes']; ?>">
                </div>
            </div>
            <div class="colunasConteudo">
                <div class="colunas">
                    <label class="rotulo">CPF</label>
                    <input class="campoTexto" type="texto" placeholder="333.333.333-33" name="cpf" value="<?php echo $cliente['cpfClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">Telefone</label>
                    <input class="campoTexto" type="texto" placeholder="(79)9 999-9999" name="telefone" value="<?php echo $cliente['telefoneClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">E-mail</label>
                    <input class="campoTexto" type="texto" placeholder="contato@contato.com.br" name="email" value="<?php echo $cliente['emailClientes']; ?>">
                </div>
            </div>

            <div class="colunasConteudo">
                <div class="colunas">
                    <label class="rotulo">Endereço</label>
                    <input class="campoTexto" type="texto" placeholder="Rua b, 10" name="endereco" value="<?php echo $cliente['enderecoClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">CEP</label>
                    <input class="campoTexto" type="texto" placeholder="49.000-000" name="cep" value="<?php echo $cliente['cepClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">Complemento</label>
                    <input class="campoTexto" type="texto" placeholder="Complemento" name="complemento" value="<?php echo $cliente['complementoClientes']; ?>">
                </div>
            </div>
            <div class="colunasConteudo">
                <div class="colunas">
                    <label class="rotulo">Ponto de referência</label>
                    <input class="campoTexto" type="texto" placeholder="Ponto de referência" name="pontoReferencia" value="<?php echo $cliente['pontoReferenciaClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">Bairro</label>
                    <input class="campoTexto" type="texto" placeholder="Bairro" name="bairro" value="<?php echo $cliente['bairroClientes']; ?>">
                </div>
                <div class="colunas">
                    <label class="rotulo">Cidade</label>
                    <input class="campoTexto" type="texto" placeholder="Cidade" name="cidade" value="<?php echo $cliente['cidadeClientes']; ?>">
                </div>
            </div>
            <div class="colunasConteudo">
                <div class="colunas">
                    <label class="rotulo">Estado</label>
                    <input class="campoTexto" type="texto" placeholder="Estado" name="estado" value="<?php echo $cliente['estadoClientes']; ?>">
                </div>
            </div>

        </div>

        <hr>
        <div class="painel">PLANOS</div>



        <?php
        foreach ($plano as $todosPlanos) :
        ?>

            <div class="colunaTotal">

                <br />

                <label class="rotulo"><input class="clickPlanos" type="radio" name="plano" value="<?php echo $todosPlanos['idPlanos']; ?> "> <?php echo $todosPlanos['nomePlanos'] . " - R$ " . $todosPlanos['valorPlanos']; ?> </label><br />
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
            <div class="bordasTabelas">Data de Nascimento</div>

        </div>

        <?php if ($dependent != NULL) : ?>
            <?php if (count($dependent) > 8) : ?>

                <div class="subtirinhas">
                    <h3 style="color: #ff0000; font-weight: bold;">Será Cobrada uma taxa adicional, igual ao valor de R$ 8,00 reais por pessoa, a quantidade de Dependentes é superior a 8 </h3>
                </div>
            <?php endif; ?>
            <?php foreach ($dependent as $depende) : ?>
                <div class="linhasColunas">

                    <input type="hidden" name="idDependente[]" value="<?php echo $depende['idDependentes']; ?>" />
                    <div class="conteudoTabelas"><?php echo $depende['nomeDependentes']; ?></div>
                    <div class="conteudoTabelas"><?php echo $depende['cpfDependentes']; ?></div>
                    <div class="conteudoTabelas"><?php echo date("d/m/Y", strtotime($depende['dataNascimentoDependentes'])); ?></div>


                </div>

            <?php endforeach; ?>
        <?php endif; ?>

        <hr>




        <div class="colunasConteudo">
            <input type="radio" name="adesao" value="adesao">&nbsp; Adesão do plano - É o pagamento antecipado no valor do plano escolhido<br>
        </div>

        <hr>

        <div class="colunasConteudo">

            <div class="colunaVendedor">

                <label class="rotulo">Assinatura digital do Vendedor</label>
                <input id="assinaturaDigitalVendedor" type="hidden" name="assinaturaDigital" value="" />
                <div class="assinaturaDigital" style="padding: 10px; font-size: 20px; line-height: 70px; border-top-left-radius: 35px; border-bottom-left-radius:35px">
                    <div style="width: 70px; height: 70px; background-color: #ffffff; border-radius: 35px;">
                        <img width="40px" src="<?php echo BASE_URL . "assets/imagens/assinatura.svg"; ?>">
                    </div>&nbsp;
                    <div id="hashDigitalVendedor"></div>


                </div>



            </div>

            <hr>
            <div class="colunaVendedor">
                <label class="rotulo">Data de Vigência</label>
                <input class="campoTexto" type="date">

            </div>




        </div>
        <hr>

        <label class="rotulo">Assinatura digital do Associado Titular</label><br>
        <input type="hidden" name="assinaturaDigital" value=" <?php echo $cliente['assinaturaDigitalClientes']; ?>" />
        <div class="assinaturaDigital" style="padding: 10px; font-size: 20px; line-height: 70px; border-top-left-radius: 35px; border-bottom-left-radius:35px">
            <div style="width: 70px; height: 70px; background-color: #ffffff; border-radius: 35px;">
                <img width="40px" src="<?php echo BASE_URL . "assets/imagens/assinatura.svg"; ?>">
            </div>&nbsp;

            <?php echo $cliente['assinaturaDigitalClientes']; ?>
        </div>




        <div class="colunaUnica alinhamentoCentro">

            <label class="rotulo ">Todos os titulares Terão o direito a idenização em caso de morte acidental e assistência funeral por qualquer causa de morte</label>
        </div>
        </div>

        <div class="total">

            <div style="display:flex; ">

                <h1>Total:</h1> ;&nbsp;<h1 id="valor" style="color:red;">R$ 00,00</h1>
                <input type="text" id="valorPlano" name="valorPlano">
            </div>
        </div>

<div class="painelBotao">
        <input type="submit" value="Gerar Contrato" name="salvar" class="btn-salvar80">
</div>
        <br/>
        <br/>
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