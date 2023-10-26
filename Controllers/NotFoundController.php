<?php

namespace Controllers;

use \Core\Controller;


class NotFoundController extends Controller{


    public function index() {

        $viewData = array();

        if (!isset($_SESSION['idColaboradores']) && empty($_SESSION['idColaboradores'])) {


            $this->loadTemplate("home", $viewData);
        } else {



            $this->loadTemplateLoginCompany("notFound", $viewData);
        }
    }

}

?>