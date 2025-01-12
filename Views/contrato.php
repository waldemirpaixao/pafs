<?php

/*use Planos;
use Empresa;
use Clientes;
use Vendedor;
use Mpdf\Mpdf;
use Dependentes;
use Models\Venda;
use Dompdf\Dompdf;
use ComplementoPlano;*/


use Dompdf\Dompdf;
use \Models\Clientes;
use \Models\Empresa;
use \Models\Dependentes;
use \Models\Planos;
use \Models\Vendedor;
use \Models\ComplementoPlano;
use Models\Contrato;
use \Models\Venda;
use Mpdf\Mpdf;

ob_start();




?>

<html>

<head>

    <meta charset="UTF-8">
    <title>PAFS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /><!--midias sociais do rodape-->

</head>

<style>
    /*
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
*/
    /* 
    Created on : 30/01/2019, 21:21:55
    Author     : waldemir
*/


    * {
        font-family: sans-serif, 'News Cycle';
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;


    }


    body {}



    h2 {

        text-align: center;
    }

    .leftmenu {

        width: 200px;
        /*background-color:  #483D8B;*/
        background-color: #1f232a;
        position: absolute;
        left: 0px;
        top: 0px;

        margin-bottom: 0px;
        padding-bottom: 0px;




    }

    .fechado {
        font-weight: bolder;
        font-size: 20px;
        color: #FF6347;
    }

    .fechadoOpacity {


        color: #FF6347;
        opacity: 0.5;

    }

    .aberto {
        font-weight: bolder;
        font-size: 20px;
        color: #00BE8B;
    }

    .abertoOpacity {

        color: #00BE8B;
        opacity: 0.5;

    }


    .containertop {

        margin-left: 200px;

    }

    .top {


        /*background-color: #40367c;*/
        background-color: #232830;
        color: #FFF;
        height: 50px;
        line-height: 50px;
        padding-right: 50px;
        display: flex;


    }

    .top_right {
        float: right;
        padding-right: 10px;
        width: 100%;


    }

    .alinhamentoDireita {

        text-align: right;

    }

    .top_right a {


        color: #FFF;
        transition: 0.2s linear;
    }

    .top_right a:hover {

        text-decoration: none;
        color: #DC143C;
        font-size: 16px;
        font-weight: bold;


    }

    .infoCompany {


        padding: 5px;
        width: 200px;
        color: #FFFFFF;
        text-align: center;

        line-height: 1%;
        margin-bottom: 10px;

    }

    .allname {


        margin-top: 60px;
        color: #FFF;
        margin-bottom: 30px;
        line-height: 100px;
        text-align: center;
    }

    .menuarea,
    .menuServicos,
    .menuProdutos {


        margin-top: 5px;

    }

    .menuarea ul,
    .menuProdutos ul,
    .menuServicos ul {

        padding: 0px;
        margin: 0px;
        list-style: none;

    }

    .menu ul li a {

        color: rgba(245, 245, 245, 0.5);
    }


    .menuarea li:hover,
    .menuProdutos li:hover,
    .menuServicos li:hover {

        background-color: #000;
        border-left: 2px solid #FFD700;
        color: #fff;



    }

    .stiloFixo {

        background-color: #000;
        border-left: 2px solid #FFD700;

    }


    .menuarea li,
    .menuProdutos li,
    .menuServicos li {

        height: 40px;
        line-height: 40px;
        padding-left: 30px;
        background-size: 15px 15px;
        background-repeat: no-repeat;
        background-position: 8px 14px;



    }

    .menuarea li a,
    .menuProdutos li a,
    .menuServicos li a {


        display: block;
        text-decoration: none;
        color: #fff;


    }

    .menuarea li:nth-child(1) {


        background-image: url(../imagens/home.png);


    }

    .menuarea li:nth-child(2) {


        background-image: url(../imagens/service.png);
    }

    #submenuConfiguracoes li:nth-child(1) {


        background-image: url(../imagens/company.png);
    }

    #submenuConfiguracoes li:nth-child(2) {


        background-image: url(../imagens/cadastrar.png);

    }


    #submenuConfiguracoes li:nth-child(3) {


        background-image: url(../imagens/order.png);
    }

    #submenuConfiguracoes li:nth-child(4) {


        background-image: url(../imagens/check.svg);
    }


    #submenuConfiguracoes li:nth-child(5) {


        background-image: url(../imagens/partner.png);
    }




    .menuarea li:nth-child(4) {


        background-image: url(../imagens/seller.png);
    }


    .menuarea li:nth-child(6) {


        background-image: url(../imagens/credit-cards.png);
    }


    #submenuVendas li:nth-child(1) {


        background-image: url(../imagens/profile.png);
    }


    #submenuVendas li:nth-child(2) {


        background-image: url(../imagens/cadastrar.png);
    }


    #submenuVendas li:nth-child(3) {


        background-image: url(../imagens/product.png);
    }


    #submenuFinanceiro li:nth-child(1) {


        background-image: url(../imagens/dollar.png);
    }

    #submenuFinanceiro li:nth-child(2) {


        background-image: url(../imagens/money.png);
    }

    #submenuFinanceiro li:nth-child(3) {


        background-image: url(../imagens/lucro.png);
    }


    .menuarea li:nth-child(8) {


        background-image: url(../imagens/category.png);
    }



    /*.menuarea li:nth-child(4){


    background-image: url(../imagens/order.png);
}

#submenu li:nth-child(1){


    background-image: url(../imagens/category.png);
}

#submenu li:nth-child(2){


    background-image: url(../imagens/cadastrar.png);
}

#submenu li:nth-child(3){


    background-image: url(../imagens/list.png);
}


.menuarea li:nth-last-child(5){



    background-image: url(../imagens/credit-cards.png);
}



.menuarea li:nth-child(7){


    background-image: url(../imagens/notice.png);
}


.menuarea li:nth-last-child(3){


    background-image: url(../imagens/suggestion.png);
}

.menuarea li:nth-last-child(2){


    background-image: url(../imagens/help.png);
}

.menuarea li:nth-last-child(1){


    background-image: url(../imagens/partner.png);
}

.menuProdutos li:nth-child(1){

    background-image: url(../imagens/restaurant.png);
}

.menuServicos li:nth-child(1){
    background-image: url(../imagens/service.png);

}*/

    .areaContentLogin {

        padding: 10px;


    }

    .areaPerfil {

        width: 100%;
        color: #483D8B;


    }


    .formPerfil {

        width: 80%;


        margin: 50px auto;

    }

    .labelPerfil {
        margin-top: 50px;
        margin-bottom: 10px;


        width: 100%;
        /*background-color: #FFD700;*/

        margin-right: 10px;
    }

    .subtitle {
        background-color: #eee;
        padding: 10px;
        border-radius: 10px;


    }

    .estiloBorda {


        width: 100%;
        border-left: 4px solid #FFD700;
        padding: 10px;

    }



    .containerFoto {

        width: 50%;




    }

    .dadosPessoais {

        width: 50%;
        padding-top: 20px;







    }


    .margem {

        width: 80%;
        margin: auto;
        color: #483D8B;
        margin-top: 20px;




    }


    .btn-salvar100 {


        background-color: #90EE90;
        padding: 15px;
        width: 100%;
        color: #483D8B;
        border-radius: 10px;
        /*float:right;*/
        font-weight: bold;
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 30px;
    }


    .btn-salvar100:hover {

        background-color: #1b6d85;
        color: #fff;

    }




    .btn-salvar80 {


        background-color: #90EE90;
        padding: 15px;
        width: 100%;
        color: #483D8B;
        border-radius: 10px;
        /*float:right;*/
        font-weight: bold;
        font-size: 20px;

    }


    .btn-salvar80:hover {

        background-color: #1b6d85;
        color: #fff;

    }







    .perfilContainer {

        display: flex;


    }

    .foto {

        height: 300px;
        width: 300px;
        background-color: #eee;
        margin: 12% auto;
        border-radius: 150px;
        box-sizing: border-box;

    }

    .profileImage {

        height: 300px;
        width: 300px;
        margin: auto;
        border-radius: 150px;
    }


    .profilePerfil {

        height: 100px;
        width: 100px;
        margin: auto;
        border-radius: 50px;
        border: 1px solid #ffffff;
    }

    .cameraAttachImage {

        background-color: #eee;
        margin: auto;
        width: 100%;
        text-align: center;
        padding: 5px;
        line-height: 100%;
        border-radius: 10px;


    }


    .imgCamAttach {
        margin-top: 5px;
        height: 20%;
        width: 20%;
        cursor: pointer;



    }

    .fieldName {

        font-size: 20px;
        font-weight: bolder;

    }

    .inputProfile {


        outline: none;
        border-radius: 10px;
        font-size: 20px;
        padding: 15px;
        width: 100%;
        color: #483D8B;
        margin-bottom: 15px;
        border: 1px solid #483D8B;




    }

    .inputProfile:focus {

        border: 2px solid #483D8B;
        border-radius: 10px;
        background-color: #FFD700;


    }


    /* Customize the label (the container) */
    .containerCheckBox {

        display: inline-block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;


    }

    /* Hide the browser's default checkbox */
    .containerCheckBox input {

        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0px;
        width: 0px;

    }


    /* Create a custom checkbox */
    .customCheckBox {

        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border: 1px solid #2196F3;

    }

    /* On mouse-over, add a grey background color */

    .containerCheckBox input:checked~.customCheckBox {

        background-color: #2196F3;
    }


    /* Create the checkmark/indicator (hidden when not checked) */
    .customCheckBox:after {


        content: "";
        position: absolute;
        display: none;


    }


    /* Show the checkmark when checked */

    .containerCheckBox input:checked~.customCheckBox:after {

        display: block;
    }



    /* Style the checkmark/indicator */


    .containerCheckBox .customCheckBox:after {


        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg);


    }


    .btn-salvar {


        background-color: #90EE90;
        padding: 15px;
        width: 100%;
        color: #483D8B;
        border-radius: 10px;
        /*float:right;*/
        font-weight: bold;
        font-size: 20px;
        margin-top: 10px;

    }

    .btn-salvar:hover {

        background-color: #1b6d85;
        color: #fff;

    }

    .enderecoPerfil {

        margin-top: 20px;

    }

    .upload-btn {

        position: relative;
        overflow: hidden;
        display: inline-block;
        margin-right: 20px;



    }


    .btn {


        background: none;
        border: none;
        padding: 30px 20px;


        font-weight: bold;


        background-image: url("../imagens/attach.png");
        background-size: 60px;
        background-repeat: no-repeat;
        background-position: center;

    }

    .boxUploadImage {


        border: 1px solid #ddd;
        width: 100%;
        display: flex;
        padding: 100px;
        background-color: #F5F5F5;





    }

    .documentDelete {

        width: 30%;
        height: 30%;
        margin: 10px;

    }

    .documentImage {

        width: 100%;
        height: 100%;

    }

    .fotoItem {

        border: 1px solid #ddd;
        width: 300px;
        height: 300px;
        text-align: center;
        padding: 10px;
        margin: 10px;

    }

    .upload-btn input[type="file"] {


        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;

    }

    .danger {

        background-color: #F08080;
        border: 2px solid #CD5C5C;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        text-align: center;

    }

    .warning {

        background-color: #FFD700;
        border: 2px solid #DAA520;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
        width: 100%;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
        text-align: center;

    }



    .success {

        background-color: #2F4F4F;
        border: 2px solid #8FBC8F;
        color: #fff;
        font-weight: bold;
        font-size: 20px;
        width: 100%;
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
        text-align: center;


    }


    .dashboard {



        background-color: #696969;
        width: 100%;
        height: 100%;
        bottom: 0px;
        left: 0px;
        right: 0px;
        top: 0px;
    }

    /* The switch - the box around the slider */
    .switch {

        margin-right: 10px;
        margin-left: 10px;
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;

    }

    /* Hide default HTML checkbox */

    .switch input {

        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */

    .slider {

        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0px;
        background-color: #FF6347;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {


        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: #ffffff;
        -webkit-transition: .4s;
    }

    input:checked+.slider {

        background-color: #00BE8B;
    }

    input:focus+.slider {

        box-shadow: 0 0 1px #00BE8B;
    }

    input:checked+.slider:before {

        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */

    .slider.round {

        border-radius: 34px;
    }

    .slider.round:before {


        border-radius: 50%;
    }

    .barra {

        background-color: #f5f5f5;
        width: 100%;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 10px;

    }


    /*snackbar*/


    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {

        visibility: hidden;
        /* Hidden by default. Visible on click */
        min-width: 250px;
        /* Set a default minimum width */
        margin-left: -125px;
        /* Divide value of min-width by 2 */
        background-color: #333;
        /* Black background color */
        color: #fff;
        /* White text color */
        text-align: center;
        /* Centered text */
        border-radius: 2px;
        /* Rounded borders */
        padding: 16px;
        /* Padding */
        position: fixed;
        /* Sit on top of the screen */
        z-index: 1;
        /* Add a z-index if needed */
        left: 50%;
        /* Center the snackbar */
        bottom: 30px
            /* 30px from the bottom */
    }

    #snackbar.show {

        visibility: visible;
        /* Show the snackbar */
        /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
  However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }


    /* Animations to fade the snackbar in and out */

    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }


    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }

        to {
            bottom: 30px;
            opacity: 1;
        }
    }


    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }


    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }

        to {
            bottom: 0;
            opacity: 0;
        }
    }


    .cardsPayment {


        margin: 5% auto;
        background: #ccc;

        width: 80%;


    }

    #submenuConfiguracoes,
    #submenuVendas,
    #submenuFinanceiro {

        position: relative;
        display: none;
        background: #2E3D44;
        color: rgba(245, 245, 245, 0.5);


    }

    /*formulários*/

    .planosTotal {

        width: 100%;
        margin: auto;
        font-size: 20px;
        color: #372D7A;



    }


    .planos {


        display: flex;
        width: 100%;
        margin-top: 5vh;
        margin-bottom: 5vh;
    }

    .titulo {
        text-align: center;
        padding: 10px;
        width: 100%;
        background-color: rgba(200, 192, 155, 1);
        font-weight: bold;
        font-size: 15pt;
    }

    .conteudoPlano {


        padding: 10px;
        background-color: rgba(200, 192, 155, 0.3);
        width: 100%;
        height: 35vh;
        font-size: 14pt;
        font-family: sans-serif, 'News Cycle';
    }

    .prata,
    .bronze,
    .ouro {


        width: 100%;

    }

    .conteudo {

        width: 100%;
        display: flex;
    }

    .logo {

        width: 30%;
        text-align: center;
        padding: 20px;


    }

    .infoEmpresa {
        padding: 20px;
        width: 70%;

        text-align: center;

    }


    .formularioTotal {

        width: 100%;

        box-sizing: border-box;

    }

    .colunasConteudo {


        display: flex;
        width: 100%;

    }

    .rotulo {

        font-family: sans-serif, 'News Cycle';
        /*color: #372D7A;*/
        color: #000000;
        font-size: 8pt;



    }

    .campo {

        width: 100%;
        font-size: 20px;
        padding: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 5px;
        border-radius: 5px;


    }



    .campoTexto:focus {

        background: rgba(194, 194, 154, 0.2);

    }


    .campoTexto {


        width: 100%;
        font-size: 12pt;
        padding: 5px;

        margin-top: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #372D7A;
        outline: none;
        box-sizing: border-box;

    }

    .colunas {

        width: 33%;
        padding: 5px;


    }



    .linha {

        background: #333;
    }

    .colunaUnica {

        padding: 10px;
        width: 99%;
        display: flex;
    }


    .colunaUnicaFormulario {

        padding: 10px;
        width: 99%;

    }

    .colunaUnicaPlanos {

        padding: 10px;
        display: flex;


    }

    .alinhamentoCentro {

        text-align: center;
    }


    .colunaTotal {


        width: 20%;



    }

    .coluna6 {

        background: #f5f5f5;

        border: 1px solid #000;
        padding: 5px;
        margin: 5px;
        text-align: center;
    }

    .colunaDependentes {

        background: #f5f5f5;

        border: 1px solid #000;
        padding: 5px;
        margin: auto;
        width: 100%;
        text-align: center;
    }

    .colunaComSemSeguro {


        text-align: center;
        width: 50%;
        padding: 10px;
        margin: auto;

    }

    .colunaConteudo {


        padding-left: 10px;
    }



    #vendedor {

        width: 100%;
        font-size: 12pt;
        padding: 5px;
        margin-bottom: 20px;
        margin-top: 10px;
        border-radius: 5px;
        ;


    }




    .colunaVendedor {

        width: 50%;
        padding: 10px;


    }

    /* login*/

    .boxLogin {

        width: 100%;
        height: 100%;
        background: #f5f5f5 !important;
        font-size: 20px;
        color: #372D7A;


    }



    .box {

        width: 50%;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        position: absolute;
        margin-top: 10%;
        left: 25%;
        z-index: 1;
        box-sizing: border-box;
        border: 1px solid #ddd;



    }

    .right {


        text-decoration: none;
        width: 100%;
        margin-right: 0px;





    }

    .botao {


        background-color: #90EE90;
        padding: 20px;
        width: 100%;
        color: #483D8B;
        border-radius: 2px;
        font-weight: bold;
        font-size: 20px;
        margin-top: 10px;
        border-radius: 5px;

    }


    .botao:hover {


        background: rgba(60, 179, 113, 0.5);
    }


    .logoLogin {

        width: 100%;
        text-align: center;
        padding: 20px;
        margin: 20px;


    }

    .margem {

        width: 80%;
        box-sizing: border-box;
        margin: auto;
        box-sizing: border-box;

    }

    .metadeTela1 {

        width: 30%;
        padding: 10px;
        box-sizing: border-box;

    }


    .metadeTela2 {

        width: 70%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid rgba(194, 194, 154, 0.2);
    }

    .numero {

        font-size: 35pt;
        font-weight: bold;
    }

    .coluna {

        background-color: #f1f1f1;
        width: 100%;
        border-radius: 5px;
        padding: 10px;
        margin: 10px;
        float: left;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .boxDashBoard {

        display: flex;
    }


    .labelAzulMaisClaro {

        color: #4969A9 !important;

    }

    .imagemLogo {




        width: 300px;
        height: 300px;
        background-color: #d3d3d3;
        border-radius: 150px;
        margin: auto;

    }



    .imagemLogoTamanho {


        width: 300px;
        height: 300px;
        border-radius: 150px;





    }

    .circulo {


        background: #00BE8B;
        width: 100px;
        height: 100px;
        cursor: pointer;
        border-radius: 50px;
        margin-bottom: 50px;
    }

    .card {


        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .tirinhas {

        font-size: 20px;


        display: flex;
        background-color: rgba(194, 194, 154, 0.2);
        width: 100%;
        border-radius: 20px;
        margin: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);





    }

    .assinaturaDigital {

        display: flex;
    }


    .detalhes {

        font-size: 20px;



        background-color: rgba(194, 194, 154, 0.2);
        width: 100%;
        border-radius: 20px;
        margin: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);





    }

    .detalhesConteudo {

        width: 100%;
        padding: 40px;
        line-height: 20px;


    }

    .subtirinhas {

        width: 100%;
        text-align: center;
        padding-top: 20px;
        line-height: 20px;


    }

    .ponteiro {

        cursor: pointer;
    }


    .alinhamentoDireito {
        text-align: right;
    }


    .fonte {
        font-size: 8pt;
    }

    .coresPlanos {

        margin: auto;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: #c0c0c0;
        text-align: center;



    }


    .imagemPequena {

        width: 50px;
        position: relative;
        top: -10px;
        margin-right: 20px;
    }

    .cabecalho {


        width: 100%;
        display: flex;
    }



    .contrato {



        margin: auto;
        max-width: 80%;
        width: 100%;
        font-size: 18px;
        text-align: left;


    }


    .contratoInner {

        text-align: center;
        margin: auto;
        max-width: 80%;
        width: 100%;



    }




    .contratoBox {

        margin-top: 10vh;





    }



    .alinea {


        text-indent: 1.5em;
    }



    .assinatura {


        margin-top: 20px;
        width: 100%;
        display: flex;
        text-align: center;
        padding-bottom: 20px;
    }


    .contratante {

        width: 50%;

    }

    .contratada {


        width: 50%;

    }

    .separador {


        margin-bottom: 10vh;
    }



    .total {


        padding: 10px;
        width: 85%;
        margin-bottom: 5vh;
        margin: auto;

    }

    .painel {

        width: 100%;
        text-align: center;
        color: white;
        background: linear-gradient(to right, #6ea5c5, #372D7A);
        padding: 5px;
        margin: auto;
        font-family: sans-serif, 'News Cycle';
        letter-spacing: 2px;
    }

    .painelBotao {

        width: 85%;
        margin: auto;
    }



    .colunaTotal {


        width: 100%;

    }


    .colunaConteudo {


        padding: 10px;
    }

    .bordasTabelas {

        border: 1px solid #696969;
        width: 100%;
        text-align: center;
        background-color: rgba(176, 196, 222, 0.3);
        color: #000;
        padding: 10px;

    }

    .conteudoTabelas {

        border: 1px solid #696969;
        width: 100%;
        text-align: center;
        background-color: #fff;

    }

    .linhasColunas {

        display: flex;

    }




    .alinhamentoImagem {

        text-align: right;
        cursor: pointer;
    }



    .justificar {
        text-align: justify;
    }


    .negrito {

        font-weight: bold;
    }

    .fundoTabela {

        text-align: center;
        background-color: rgba(176, 196, 222, 0.3);
        padding: 2px;
    }

    /*esta sendo usado no javascript*/
</style>






</head>



<body>
    <script type="text/javascript">
        $('li').eq(8).addClass('stiloFixo');
        $("#submenuVendas").fadeToggle("slow");
    </script>

    <?php

    /* use Dompdf\Dompdf;
    use \Models\Clientes;
    use \Models\Empresa;
    use \Models\Dependentes;
    use \Models\Planos;
    use \Models\Vendedor;
    use \Models\ComplementoPlano;
    use \Models\Venda;
    use Mpdf\Mpdf;*/

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
    $vendedorEspecifico = $vendedores->getVendedorById($idVendedor);


    // complemento
    $complementoPlanos =  new ComplementoPlano();
    $complementoPlano = $complementoPlanos->getAllComplementoPlanos($_SESSION['idEmpresa']);



    //venda

    $venda = new Venda();
    $vendaClienteVendedor = $venda->getVendaByIdClinteIdVendedor($idVendedor, $id); //id do cliente

    //contrato
    $contrato = new Contrato();
    $contratoArray = $contrato->getcontratobyIdCliente($id)

    //require('vendor/autoload.php');

    ?>

    <section class="planosTotal">


        <form target="_blank" action="<?php echo BASE_URL; ?>FormularioVendaPlanos/registerVenda" method="post">

            <div class="formularioTotal">
                <!-- <div class="colunasConteudo">-->
                <table class="rotulo" border="0" width="100%">
                    <tr>
                        <td> <img width="20%" src="<?php echo BASE_URL; ?>/assets/imagens/LogoMarca.jpeg"></td>
                        <td colspan="4">
                            <?php echo $dadosEmpresa['nomeEmpresa'] . '-' . $dadosEmpresa['siglaEmpresa']; ?>
                            <br />
                            <div class="fonte">
                                <?php echo $dadosEmpresa['enderecoEmpresa'] . ", " . $dadosEmpresa['numeroEmpresa'] . " - " . $dadosEmpresa['cepEmpresa'] . "<br/>"; ?>
                                <?php echo $dadosEmpresa['bairroEmpresa'] . " - " . $dadosEmpresa['cidadeEmpresa'] . " - " . $dadosEmpresa['estadoEmpresa']; ?><br />
                                <?php echo "Tel: " . $dadosEmpresa['telefoneEmpresa'] . " -  E-mail: " . $dadosEmpresa['emailEmpresa']; ?>
                            </div>

                        </td>


                    </tr>

                    <tr>

                        <td width="25%" class="negrito fundoTabela">
                            <!--<div class="colunas">-->
                            <label class="rotulo">Titular do plano</label>
                        </td>
                        <td colspan="4" class="fundoTabela">
                            <?php echo $cliente['nomeClientes']; ?>

                            <!--</div>-->
                        </td>
                    </tr>

                    <tr>
                        <td class="negrito fundoTabela">
                            <label class="rotulo">CPF</label><br />

                        </td>

                        <td class="fundoTabela">
                            <!--<div class="colunas">-->

                            <?php echo $cliente['cpfClientes']; ?>

                            <!--</div>-->
                        </td>


                        <td class="negrito fundoTabela">
                            <!--<div class="colunas">-->

                            <label class="rotulo">Data Nasc.</label><br />
                        </td>
                        <td colspan="2" class="fundoTabela">
                            <?php echo date("d/m/Y", strtotime($cliente['dataNascimentoClientes'])); ?>

                            <!--</div>-->
                        </td>
                    </tr>
                    <tr>
                        <td class="negrito fundoTabela">
                            <!-- <div class="colunas">-->
                            <label class="rotulo">Endereço</label>
                        </td>
                        <td colspan="2" class="fundoTabela">
                            <?php echo $cliente['enderecoClientes']; ?>

                            <!--</div>-->
                        </td>
                        <td class="negrito fundoTabela">
                            <!-- <div class="colunas">-->
                            <label class="rotulo">Bairro</label>
                        </td>
                        <td class="fundoTabela">
                            <?php echo $cliente['bairroClientes']; ?>

                            <!--</div>-->
                        </td>
                    </tr>
                    <tr>
                        <td class="negrito fundoTabela">
                            <!--   <div class="colunas"> -->
                            <label class="rotulo">Cidade</label>
                        </td>
                        <td class="fundoTabela">
                            <?php echo $cliente['cidadeClientes']; ?>
                            <!--   </div> -->
                        </td>
                        <td class="negrito fundoTabela">
                            <!--<div class="colunas">-->
                            <label class="rotulo">Tel.</label>
                        </td>
                        <td colspan="2" class="fundoTabela">
                            <?php echo $cliente['telefoneClientes']; ?>

                            <!--</div>-->
                        </td>
                    </tr>
                    <tr>


                        <td class="negrito fundoTabela">
                            <!-- <div class="colunas">-->

                            <!--Id do cliente-->


                            <label class="rotulo">Data de Adesão</label>
                        </td>
                        <td class="fundoTabela">
                            <?php echo date("d/m/Y", strtotime($vendaClienteVendedor['dataAdesao'])); ?>

                            <!--  </div> -->


                        </td>
                        <td class="negrito fundoTabela">
                            <!--<div class="colunas">-->
                            <label class="rotulo">E-mail</label>
                        </td>
                        <td colspan="2" class="fundoTabela">
                            <?php echo $cliente['emailClientes']; ?>

                            <!--</div>-->
                        </td>

                    </tr>

                    <tr>
                        <td class="negrito fundoTabela"><label class="rotulo">Vendedor(a)</label></td>

                        <td colspan="4" class="fundoTabela">
                            <!--<div class="colunas">-->


                            <?php echo $vendedorEspecifico['nomeVendedores']; ?>


                            <!-- </div>-->
                        </td>
                    </tr>

                </table>
            </div>

            <!--</div>-->
            <br />

            <div class="painel">PLANOS SEM SEGUROS</div>



            <?php
            foreach ($plano as $todosPlanos) :


            ?>

                <div class=" rotulo colunaTotal justificar">

                    <br />



                    <?php

                    if ($todosPlanos['idPlanos'] == $vendaClienteVendedor['planos_idPlanos']) :

                    ?>
                        <img width="20px" src="<?php echo BASE_URL; ?>assets/imagens/check-mark.png" />
                        <?php
                        echo $todosPlanos['nomePlanos'] . " - R$ " . $todosPlanos['valorPlanos'];
                        echo "<br/>";
                        echo $todosPlanos['descricao'];
                        ?>


                        <br />

                    <?php
                    else :
                        echo $todosPlanos['nomePlanos'] . " - R$ " . $todosPlanos['valorPlanos'];
                        echo "<br/>";
                        echo $todosPlanos['descricao'];

                    ?>


                    <?php endif; ?>


                    <br />


                </div>


            <?php

            endforeach;

            ?>


            <br />

            <div class="painel">DEPENDENTES</div>
            <br />

            <table width="100%" class=" rotulo linhasColunas">
                <tr class="">
                    <td style="font-size: 14pt;" class=" negrito bordasTabelas">Dependentes</td>
                    <td style="font-size: 14pt;" class=" negrito bordasTabelas">CPF</td>
                    <!--<td class="negrito bordasTabelas">Data de Nascimento</td>-->
                </tr>



                <?php if ($dependent != NULL) : ?>
                    <?php if (count($dependent) <= 8 || count($dependent) >= 8) : ?>

                        <div class="subtirinhas">
                            <h3 style="color: #ff0000; font-weight: bold;">Será Cobrada uma taxa adicional, igual ao valor de R$ 5,00 reais por pessoa, a quantidade de Dependentes é superior a 8 </h3>
                        </div>

                        <input type="hidden" name="valorExtraDependente" value="<?php echo count($dependent) * 8; ?>">


                    <?php else : ?>
                        <input type="hidden" name="valorExtraDependente" value="<?php echo 0; ?>">

                    <?php endif; ?>
                    <?php foreach ($dependent as $dependeContrato) : ?>


                        <tr class="">
                            <td style="font-size: 14pt;" class="conteudoTabelas"><?php echo $dependeContrato['nomeDependentes']; ?></td>
                            <td style="font-size: 14pt;" class="conteudoTabelas"><?php echo $dependeContrato['cpfDependentes'] != null ?  $dependeContrato['cpfDependentes'] : "Não Informado"; ?></td>
                            <!-- <td class="conteudoTabelas"><//?php echo date("d/m/Y", strtotime($depende['dataNascimentoDependentes'])); ?></td>-->

                        </tr>


                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <br />
            <p class="rotulo">Portabilidade: <?php echo $contratoArray['portabilidade']; ?> <br />
                Observação: <?php echo $contratoArray['observacao'] !== "" ? $contratoArray['observacao'] : " Não há observação. "; ?></p>


            <div class="colunasConteudo">

                <?php
                if ($vendaClienteVendedor['adesaoVenda'] == "sim") :
                ?>

                    <!--<img width="20px" src="<//?php echo BASE_URL; ?>assets/imagens/check-mark.png" />
            <label>Adesão do plano - É o pagamento antecipado no valor do plano escolhido</label><br/>-->

                <?php

                endif;



                ?>


            </div>

            <br />
            <table class="rotulo">
                <tr>
                    <td>Assinatura do vendedor:</td>
                    <td>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                        &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td> <label class="rotulo">Data de Vigência: </label>
                        <?php echo date("d/m/Y", strtotime($vendaClienteVendedor['dataVencimentoVenda'])); ?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>

                    <td>Assinatura do titular:</td>
                </tr>
            </table>

            <!--<div class="colunaUnica alinhamentoCentro">

                <label class="rotulo ">Todos os titulares Terão o direito a idenização em caso de morte acidental e assistência funeral por qualquer causa de morte</label>
            </div>
            </div>-->


            <table>
                <tr>
                    <td>
                        <h4>Total Sem desconto</h4>
                    </td>
                    <td>
                        <h4 style="color:green;"><?php echo "R$" . number_format($vendaClienteVendedor['valorPlanos'] + $vendaClienteVendedor['valorExtraDependente'], 2, ",", "."); ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Desconto</h4>
                    </td>
                    <td>
                        <h4 style="color:green;"><?php echo "R$" . number_format($vendaClienteVendedor['desconto'], 2, ",", "."); ?></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Total com desconto:</h4>
                    </td>
                    <td>
                        <h4 style="color:green;"><?php echo "R$" . number_format($vendaClienteVendedor['valorPlanos'] + $vendaClienteVendedor['valorExtraDependente'] - $vendaClienteVendedor['desconto'], 2, ",", "."); ?></h4>
                    </td>
                </tr>



            </table>
            <!--rodapé-->


            <br /><!--Limite para a próxima página-->
            <!--<div class="painel fonte">


                <br />
                <//?php echo $dadosEmpresa['nomeEmpresa'] . '-' . $dadosEmpresa['siglaEmpresa']; ?>
                <br />
                <div class="fonte">
                    <//?php echo $dadosEmpresa['enderecoEmpresa'] . ", " . $dadosEmpresa['numeroEmpresa'] . " - " . $dadosEmpresa['cepEmpresa'] . "<br/>"; ?>
                    <//?php echo $dadosEmpresa['bairroEmpresa'] . " - " . $dadosEmpresa['cidadeEmpresa'] . " - " . $dadosEmpresa['estadoEmpresa']; ?><br />
                    <//?php echo "Tel: " . $dadosEmpresa['telefoneEmpresa'] . " -  E-mail: " . $dadosEmpresa['emailEmpresa']; ?>
                </div>

                <br />


            </div>-->

        </form>


    </section>
    <br />
    <br />
    <br />
    <br />
    <br />









    <!---Contrato-->
    <section class="contratoBox">

        <div style="text-align: center; ">

            <img width="20%" src="<?php echo BASE_URL; ?>/assets/imagens/LogoMarca.jpeg">
            <div>
                <div class="separador"></div>

                <div class="contrato">
                    <div class="contratoInner">
                        <strong class="rotulo"> <?php echo "CNPJ: " . $dadosEmpresa['cnpjEmpresa']; ?></strong><br />
                        <br />
                        <h3> CONTRATO </h3>
                        <h6>Nº <?php echo str_replace("-", "", str_replace(".", "", $cliente['cpfClientes'])) . "/" . date('Y'); ?></h6>

                        <?php


                        ?>


                    </div>



                    <br />
                    <p class="justificar rotulo">
                        <strong>Cláusula Primeira: das partes</strong><br />

                        O signatário (a) deste instrumento na qualidade de contratante, identificado e qualificado na ficha cadastral do beneficiário.

                    </p>

                    <p class="justificar rotulo">

                        <strong>Cláusula Segunda: do objeto</strong><br />
                        Através de recursos próprios ou de empresa por ela designadas, a CONTRATADA disponibiliza para o CONTRATANTE e seus beneficiários inscritos previamente em seu plano de auxilio funeral, assistência e atendimento de serviços funerários, nos termos autorizados pela Lei Federal 13.261 de 22 de Março de 2016.

                    </p>

                    <p class="justificar rotulo">
                        <strong>
                            Cláusula Terceira: dos serviços:
                        </strong>
                        <br />

                        I - Terão direito ao uso dos serviços, todos os beneficiários de que trata a cláusula quarta de acordo com a opção de atendimento feita pelo contratante, compreendendo:<br />

                        <!--<div class="planos">-->

                    <table width="100%">
                        <!--<div class="prata">-->
                        <tr class="prata ">
                            <td class="titulo ">
                                <!--<div class="titulo">-->
                                PLANO BÁSICO
                            </td>
                            <td class="titulo "><!--<div class="titulo">-->
                                PLANO PRATA
                            </td><!--</div>-->
                        </tr>
                        <!--</div>-->
                        <tr>
                            <td class="conteudoPlano ">
                                <!-- <div class="conteudoPlano">-->
                                • Urna mortuária simples<br />
                                • Vestuário completo<br />
                                • Higienização do Corpo<br />
                                • Ornamentação com flores artificial<br />
                                • Coroa de flores artificial<br />
                                • Translado de 50 KM<br />
                                • Material para velório conforme a religião<br />

                            </td>
                            <td class="conteudoPlano "><!--<div class="conteudoPlano">-->
                                • Urna mortuária semi-luxo c/visor<br />
                                • Vestuário completo<br />
                                • Higienização do corpo<br />
                                • Ornamentação c/ flores artificial<br />
                                • Coroa de flores Artificial<br />
                                • Kit café<br />
                                • Translado de 200 km rodados<br />
                                • Material para velório conforme a religião<br />
                                • Ônibus somente em perímetro urbano<br />

                            </td><!--</div>-->
                        </tr>
                        <tr>
                            <td><br /></td>
                        </tr>
                        <tr>
                            <td><br /></td>
                        </tr>
                        <tr class="bronze "><!--<div class="bronze">-->
                            <td class="titulo "><!--<div class="titulo">-->
                                PLANO BRONZE
                            </td><!--</div>-->

                            <td class="titulo"> <!--<div class="titulo">-->
                                PLANO OURO
                            </td><!--</div>-->
                        </tr>
                        <tr>
                            <td class="conteudoPlano"><!--<div class="conteudoPlano">-->
                                • Uma mortuária semi-luxo c/visor<br />
                                • Vestuário completo<br />
                                • Higienização do corpo<br />
                                • Ornamentação c/ flores naturais <br />
                                • Coroa de flores natural<br />
                                • Kit café<br />
                                • Translado de 300 km rodados<br />
                                • Material para velório conforme a religião<br />
                                • Ônibus somente em perímetro urbano<br />

                            </td><!--</div>-->

                            <td class="conteudoPlano"><!--<div class="conteudoPlano">-->
                                • Urna mortuária luxo c/ visor<br />
                                • Vestuário completo<br />
                                • Higienização do corpo<br />
                                • Ornamentação c/ flores naturais <br />
                                • Coroa de flores naturais<br />
                                • Kit café<br />
                                • Translado de 400 km rodados<br />
                                • Material para velório conforme a religião<br />
                                • Ônibus somente em perímetro urbano<br />
                            </td>
                        </tr>


                    </table>

                    <br />


                    <p class="justificar rotulo">

                        II - Dos serviços de que se trata o inciso I quando o beneficiário for criança, será atendido com urna compatível com sua
                        estatura física, na cor branca ou verniz, sem visor e com alça dura e vestuário padrão independente da opção especificada no
                        contrato.
                        Os serviços mencionados neste contrato terão seus valores de acordo com a opção do plano escolhido e poderão ser
                        reajustados anualmente, de acordo com a IGPM.
                    </p>
                    <p class="rotulo">
                        <?php
                        //PEGA OS PLANOS CORRESPONDENTES COM A EMPRESA
                        $planos = new Planos();
                        $arrayPlanos = $planos->getAllPlanos($_SESSION['idEmpresa']);


                        ?>
                        a) <?php echo $arrayPlanos[1][1] ?>: <strong> R$ <?php echo str_replace(".", ",", $arrayPlanos[1][2]) ?> </strong></strong><br />
                        b) <?php echo $arrayPlanos[2][1] ?>: <strong> R$ <?php echo str_replace(".", ",", $arrayPlanos[2][2]) ?> </strong></strong><br />
                        c) <?php echo $arrayPlanos[3][1] ?>: <strong> R$ <?php echo str_replace(".", ",", $arrayPlanos[3][2]) ?> </strong></strong><br />
                        d) <?php echo $arrayPlanos[0][1] ?>: <strong> R$ <?php echo str_replace(".", ",", $arrayPlanos[0][2]) ?> </strong> <br />


                    </p>

                    <p class="justificar rotulo">
                        <strong>Cláusula Quarta: dos beneficiários</strong><br />
                        I - Terá direito aos serviços descritos neste instrumento, o contratante e seus beneficiários indicados, desde que regularmente inscritos na ficha cadastral:<br /><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a) Contratante;<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b) Conjugue ou companheiro (a);<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c) Filhos e netos;<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; d) Pessoas próximas sem grau de parentesco. <br />
                        <br />

                        II - Além do(s) beneficiário(s) acima mencionado(s) fica facultado ao CONTRATANTE,
                        designar outro(s) e para tanto, a contribuição mensal dos serviços contratados,
                        discriminados e identificados na cláusula terceira, será acrescido o valor de adesão do plano escolhido,
                        apenas 1x no ato da contratação, desta, para cada um dos designados, observada a carência estipulada na cláusula sétima,
                        excetuando-se o(s) filhos nascido(s) após a assinatura do presente contrato com apresentação da respectiva certidão de nascimento ou adoção,
                        devidamente autenticada;<br />

                        III - Não será permitida a inscrição de pessoas depois de falecidas.<br />
                        O CONTRATANTE poderá incluir ou substituir beneficiário(s) a qualquer momento,
                        desde que esteja de acordo com todos os itens desta cláusula. Sendo que, os beneficiários
                        inscritos após a assinatura deste contrato, deverão obrigatoriamente cumprir o período de
                        carência descrito na cláusula sétima deste contrato.<br />

                        IV - O numero de beneficiários inscritos sem a cobrança de taxa adicional,
                        varia de acordo com o tipo do plano escolhido, sendo: plano prata (5 beneficiários),
                        plano bronze (5 beneficiários) e plano ouro (5 beneficiários).<br />
                    </p>
                    <p class="justificar rotulo">
                        <strong> Cláusula quinta: das remunerações</strong><br />
                        I - A CONTRATADA será remunerada pela disponibilização dos serviços e atendimento previstos.<br />

                        II - O CONTRATANTE deverá realizar o pagamento de 48 parcelas/remuneração,
                        que será correspondente a aproximadamente 2% (dois por cento) do valor dos serviços, estando especificado no inciso II da terceira cláusula desse contrato.<br />

                        III - A remuneração deverá ser paga mensalmente nos pontos de atendimento da CONTRATADA ou em locais por ela indicados.
                    </p>
                    <p class="justificar rotulo">
                        <strong>Cláusula Sexta: do prazo de contrato</strong><br />
                        I - Este contrato é único e intransferível, é valido pelo prazo de 48 (quarenta e oito) meses,
                        a partir do pagamento da taxa de inscrição.<br />

                        II - O prazo do contrato será automaticamente renovado sem ônus e carência,
                        desde que não seja comunicado o cancelamento por uma das partes, até 30 (trinta) dias
                        antes do vencimento, podendo assim colocar ou alterar dependentes.<br />
                    </p>
                    <p class="justificar rotulo">

                        <strong>Cláusula Sétima: da carência</strong><br />
                        I - Para prestação dos serviços contratados; o presente contrato terá carência de 90 (noventa)
                        dias a partir do pagamento da taxa de inscrição.<br />

                        II - Na hipótese de ocorrer atraso superior a 90 (noventa) dias no pagamento das mensalidades e houver negociação,
                        a prestação dos serviços contratados somente ocorrerá após 90 (noventa) dias de carência,
                        do inicio do pagamento do débito negociado.<br />

                        III - Os beneficiários inscritos após a assinatura deste contrato, deverão obrigatoriamente
                        cumprir o período de carência descrito no item 7.1 desta cláusula, contados a partir da data da sua inclusão.
                        Para morte de caráter violento, com exceção de suicídio, devidamente comprovado por boletim de ocorrência,
                        ou natimortos e recém-nascido de até 30 (trinta) dias, sendo filho do(a) CONTRATANTE,
                        fica o beneficio desobrigado do cumprimento da carência.<br />

                    </p>
                    <p class="justificar rotulo">


                        <strong>Cláusula Oitava: das obrigações do contratante</strong><br />
                        I - São obrigações do CONTRATANTE:<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a) Manter em dia o pagamento das mensalidades:</span><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b) Manter seus dados cadastrais atualizados:<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c) Em caso de falecimento, comunicar imediatamente a PAFS, através dos pontos de atendimento,
                        ou pelos <strong>telefones: (79)3215-5418 ou (79) 9 9955-7207</strong>. de posse da carteira de &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;identificação
                        do plano e do comprovante do último pagamento, bem como providenciar liberação do laudo médico.<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; d) Providenciar junto ao cartório a certidão de óbito do beneficiário falecido.<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; e) Fornecer a CONTRATADA dados pessoais e os seguintes documentos do beneficiário falecido: CPF, RG e Certidão de Óbito;<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; f) O CONTRATANTE beneficiário obriga-se a cumprir todas as cláusulas do presente contrato.<br />


                    </p>
                    <p class="justificar rotulo">
                        <strong> Cláusula Nona: da rescisão</strong><br />
                        I - O presente contrato poderá ser rescindido nas seguintes condições:<br />
                        a) Pelo CONTRATANTE, quando adimplente. Mediante comunicação por escrito e devolução da carteira de identificação do plano.<br />
                        b) Pelo CONTRATANTE, adimplente, que tenha utilizado os serviços oriundos desse contrato,
                        mediante comunicação por escrito, devolução da carteira de identificação do plano e do pagamento
                        dos valor de serviços realizados, descrito no inciso II da terceira cláusula deste contrato.<br />
                        c) Pela CONTRATADA sem prévia comunicação, ocorrendo inadimplência por um período
                        igual ou superior a 90 (noventa) dias no pagamento das mensalidades por parte do CONTRATANTE,
                        ou acúmulo de três parcelas consecutivas ou alternadas. Bem como, pelo fornecimento de informações
                        ou documentos falsos na assinatura deste contrato ou no momento da solicitação de qualquer serviço.<br />
                    </p>
                    <p class="justificar rotulo">
                        <strong>Cláusula Décima: das condições gerais</strong><br />
                        I - Este contrato garante a prestação de serviço funerário ao CONTRATANTE que estiver
                        cadastrado no seguro oferecido pelo plano contratado, e seus dependentes que estiverem
                        cadastrados no seguro oferecido pelo plano, terão direito a cobertura nacional,
                        e os dependentes que não estiverem inclusos no seguro, só terão direito a assistência funeral no estado de Sergipe.<br />
                        II - A CONTRATADA prestará os serviços pactuados neste instrumento em um raio máximo de 1 .OOO km
                        sendo do plano Ouro, iniciados na sede da CONTRATADA.<br />
                        III - Quando a remoção, ultrapassar a quilometragem franqueada pela CONTRATADA conforme opção,
                        a diferença correspondente ficará por conta da família que pagará à CONTRATADA com base na
                        tabela da ABREDIF (Associação Brasileira das Empresas e Diretores Funerários).<br />
                        IV - Este contrato não cobre terrenos em cemitérios, gavetas, jazidos, sepultamento
                        de membros amputados ou outros fornecimentos não previstos no contrato.
                        Suspende-se as garantias conferidas por este contrato em caso de calamidade pública,
                        revoluções, guerras, ou qualquer outro movimento semelhante.<br />
                        V - Caso haja duplicidade de qualquer beneficiário em outro contrato que não o presente,
                        ficam inteiramente revogadas e sem efeito as condições contidas naquele contrato,
                        passando a vigorar única e tão somente as condições contidas neste contrato.<br />
                        VI - Se houver alguma despesa para liberação do corpo do falecido, será por conta da família.<br />
                        VII - O CONTRATANTE que durante a vigência deste contrato atrasar três mensalidades consecutivas
                        ou alternadas, terá todos os seus direitos suspensos temporariamente.<br />
                        VIII - No caso de falecimento do CONTRATANTE, o presente passará a seus dependentes, devendo ser obedecida ordem de sucessão legal.<br />
                        IX - Não se responsabiliza a CONTRATADA por serviço executados por terceiros não autorizados.<br />
                        X - Incide sobre este Plano Funerário o Imposto Sobre Serviços - ISS.<br />
                        XI - O cancelamento, exclusões, inclusões e substituições serão feitas apenas mediante solicitação escrita com firma reconhecida
                        pelo CONTRATANTE (titular) do contrato.<br />
                        XII - Fica eleito o foro da PAFS, para dirimir qualquer duvida decorrente do presente contrato.<br />
                        E, por assim estarem de perfeito acordo em tudo quando foi lavrado neste contrato, obrigam-se a cumpri-lo assinando.<br />
                    </p>
                    <p class="rotulo" style="padding-top:20px;">
                        Aracaju, SE <?php echo date('d/m/Y', strtotime($vendaClienteVendedor['dataAdesao'])); ?>

                    </p>
                    <br />

                    <table class="assinatura">

                        <tr class="contratante">
                            <td>

                                <strong> Contratante</strong><br />
                                <strong><?php echo $cliente['nomeClientes']; ?></strong>
                            </td>
                            <td class="contratada">
                                <strong> Contratada </strong><br />
                                <strong><?php echo $dadosEmpresa['nomeEmpresa']; ?><strong>
                            </td>
                        </tr>

                    </table>

                    <br />
                </div>



    </section>

    <?php include 'footer.php';


    $html = ob_get_contents();
    ob_get_clean();

    /*$dompdf = new Dompdf(["enable_remote"=>true]);
$dompdf->loadHtml($html);

$dompdf->setPaper("A4");

$dompdf->render();

$dompdf->stream("file.pdf", ["Attachment" => false]);*/


    $mpdf = new Mpdf();

    $mpdf->WriteHTML($html);
    $mpdf->Output();




    ?>