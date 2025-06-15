<?php

namespace Controllers;

use Core\Controller;


class CobrancaController extends Controller
{



    private $viewData = array();

    public function index()
    {



        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $this->viewData);
        } else {



            $this->viewData['idEmpresa']  = $_SESSION['idEmpresa'];
            $this->loadTemplateLoginCompany("cobrancaTodos", $this->viewData);
        }
    }


}
