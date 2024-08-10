<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>PAFS</title>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/templatelogin.css"> <!-- css da página -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-1.2.6.pack.js"></script> <!--Mascara cnpj-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.maskedinput-1.1.4.pack.js"></script><!--Mascara cnpj-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/pafs.js"></script><!--JavaScript criado pelo autor-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script> <!--jquery -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script> <!--jquery mask telefone -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script><!--java script do bootstrap-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/vendedor/vendedor.js"></script><!--java script do vendedor-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/clientes/clientes.js"></script><!--java script do clientes-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/dependentes/dependentes.js"></script><!--java script do dependente-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/formularioVenda/formularioVenda.js"></script><!--java script do formularioVenda-->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bancos/bancos.js"></script><!-- Api para os bancos-->

    <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet" /><!--Fonte da página-->

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css"> <!-- css bootstrap-->
</head>

<body onload="alturaLateral()">
    <div class="leftmenu">
        <div class="allname">

            <div class="round-image-login">


                <?php if ($_SESSION['logoEmpresa'] != NULL) : ?>
                    <img class="profilePerfil" src="<?php echo BASE_URL; ?>assets/profile/<?php echo $_SESSION['logoEmpresa']; ?>" alt="Logo" title="logo" />



                <?php elseif ($_SESSION['logoEmpresa'] == NULL) : ?>

                    <img class="profilePerfil" src="<?php echo BASE_URL; ?>/assets/imagens/company.png" alt="Logo" title="logo" />

                <?php endif; ?>


            </div>



        </div>


        <div>
            <div class="infoCompany">

                <?php //echo $_SESSION['emailEmpresa']; 
                ?>

            </div>
            <div class="infoCompany">

                <?php //echo $_SESSION['siglaEmpresa']; 
                ?>

            </div>
            <div class="infoCompany">

                <?php //echo $_SESSION['nomeEmpresa']; 
                ?>

            </div>

        </div>

        <div class="menuarea">

            <ul>

                <li><a href="<?php echo BASE_URL; ?>Home/">Home</a></li>

                <li><a id="menuConfiguracoes" href="#">Configurações &nbsp;&nbsp;&nbsp;&nbsp;<img width="10px" src="<?php echo BASE_URL; ?>/assets/imagens/down.svg"></a></li>
                <div id="submenuConfiguracoes">
                    <li><a href="<?php echo BASE_URL; ?>DependentesExtras">Dependenetes Extras</a></li>
                    <li><a href="<?php echo BASE_URL; ?>FormaDePagamento">Forma de Pagamento</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Bancos">Bancos</a></li>
                    <li><a href="<?php echo BASE_URL; ?>DiasAreceber">Dias a receber</a></li>

                </div>

                <li><a id="menuCadastros" href="#">Cadastros &nbsp;&nbsp;&nbsp;&nbsp;<img width="10px" src="<?php echo BASE_URL; ?>/assets/imagens/down.svg"></a></li>
                <div id="submenuCadastros">
                    <li><a href="<?php echo BASE_URL; ?>Empresa">Cadastrar Empresa</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Clientes">Cadastro de Clientes</a></li>
                    <!--<li id="atualizarCliente"><a href="<?php echo BASE_URL; ?>Clientes/atualizarClientes/?id=<?php echo $_SESSION['idClientes']; ?>">Atualizar Clientes</a></li>-->


                    <li><a href="<?php echo BASE_URL; ?>Dependentes">Cadastro de Dependentes</a></li>


                    <li><a href="<?php echo BASE_URL; ?>Planos">Cadastro Planos</a></li>
                    <!--<li><a href="<?php echo BASE_URL; ?>produtos">Cadastrar Produtos</a></li>-->
                    <!--<li><a href="<?php echo BASE_URL; ?>boletos">Cadastrar Boletos</a></li>-->
                    <li><a href="<?php echo BASE_URL; ?>Vendedores">Cadastro Vendedores</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Despesas">Cadastro de Despesas</a></li>
                </div>


                <li><a id="menuVendas" href="#">Vendas &nbsp;&nbsp;<img width="10px" src="<?php echo BASE_URL; ?>/assets/imagens/down.svg"></a></li>
                <div id="submenuVendas">

                    <li><a href="<?php echo BASE_URL; ?>VendaPlanos">Vendas Plano Funeral</a></li>

                    <!--<li><a href="ProdutosFunerarios">Seguros</a></li>-->

                </div>

                <li><a id="menuFinanceiro" href="#">Financeiro &nbsp;&nbsp;<img width="10px" src="<?php echo BASE_URL; ?>/assets/imagens/down.svg"></a></li>
                <div id="submenuFinanceiro">
                    <li><a href="<?php echo BASE_URL; ?>Atrasados">Atrasados</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Areceber">A Receber</a></li>
                    <li><a href="<?php echo BASE_URL; ?>Recebidas">Recebidas</a></li>
                    <li><a href="<?php echo BASE_URL; ?>ReceitaDespesas">Receitas e Despesas</a></li>
                   
                </div>

                <li><a id="menuContrato" href="#">Contrato &nbsp;&nbsp;<img width="10px" src="<?php echo BASE_URL; ?>/assets/imagens/down.svg"></a></li>
                <div id="submenuContrato">
                    <li><a id="menuContratoPesquisa" href="<?php echo BASE_URL; ?>PesquisarContrato">Pesquisar Contrato</a></li>
                    <li><a id="menuContratoAtualizar" href="<?php echo BASE_URL; ?>AtualizarContrato">Atualizar Contrato</a></li>
                </div>

            </ul>
        </div>

    </div>

    <div class="containertop">

        <div class="top">


            <div class="top_right"><?php echo "Olá , tudo bem " . $_SESSION['nomeColaboradores'] . " ?"; ?></div>
            <div class="top_right alinhamentoCentro"><?php echo $_SESSION['nomeEmpresa']; ?></div>
            <div class="top_right alinhamentoDireita"><a href="<?php echo BASE_URL; ?>home/logOut">Sair</a></div>



        </div>


        <div class="areaContentLogin">

            <script type="text/javascript">
                var BASE_URL = "<?php echo BASE_URL; ?>";
            </script>
            <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>
    </div>

</body>

</html>