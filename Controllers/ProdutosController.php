<?php

namespace Controllers;
use \Core\Controller;

class produtosController extends Controller {

    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idUsuarios']) && empty($_SESSION['idUsuarios'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("produtos", $viewData);
        }
    }

   

}
