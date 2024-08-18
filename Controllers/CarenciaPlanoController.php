<?php

namespace Controllers;

use Core\Controller;
use Models\CarenciaPlano;


class CarenciaPlanoController extends Controller
{



    private $viewData = array();

    public function index()
    {



        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $this->viewData);
        } else {



            $this->loadTemplateLoginCompany("carenciaPlano", $this->viewData);
        }
    }




    public function cadastrar()
    {


        $dias = addslashes($_POST['dias']);

        $diasAreceber = new CarenciaPlano();
        $inserido = $diasAreceber->inserir($dias,  $_SESSION['idEmpresa']);


        if($inserido){

            $this->viewData['mensagem'] = "Cadastrado com Sucesso!";

            $this->loadTemplateLoginCompany("carenciaPlano", $this->viewData);

        }else{


            $this->viewData['mensagem'] = "Erro ao cadastrar!";
            $this->loadTemplateLoginCompany("carenciaPlano", $this->viewData);
        }



       
    }


    public function atualizar(){



        $dias = addslashes($_POST['dias']);
        $idDias = addslashes($_POST['idDias']);

        $diasAreceber = new CarenciaPlano();
        $atualizado = $diasAreceber->atualizar($idDias,$dias,  $_SESSION['idEmpresa']);

        if($atualizado){



            $this->viewData['mensagem'] = "Atualizado com Sucesso!";

            $this->loadTemplateLoginCompany("carenciaPlano", $this->viewData);

        }else{


            $this->viewData['mensagem'] = "Erro ao atualizar!";
            $this->loadTemplateLoginCompany("carenciaPalno", $this->viewData);
        }


    }
}
