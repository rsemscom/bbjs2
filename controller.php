<?php

namespace App;


class Controller {

    public function index() {
        $action = isset($_GET['action'])? $_GET['action'] : null;
        $method = $_SERVER['REQUEST_METHOD'];
        if (!$action) {
          return include('view.php');
        }

        /** get model with className
         * @var $model Hotel|Country|null
         */
        $className = "App\\".ucfirst($action);
        try {
            $model = new $className;
            $data = ['method'=> $method];
  //          $data['params'] = $_POST;
  //          $data['get'] = $_GET;
 //           $data['post'] = $_POST;
            parse_str(file_get_contents('php://input'), $_PUT );
//            $data['put'] = $_PUT;
//            return include("data.php");
            switch ($method) {
                case 'GET': $data['items'] = $model->get($_GET['params']); $data['status'] = 'ok'; break;
                case 'POST': $data['status'] = $model->insert($_POST['params']); break;
                case 'PUT': $data['status'] = $model->update($_PUT->params); break;
                case 'DELETE': $data['status'] = $model->remove($_PUT->params); break;
            }
            return include("data.php");
        }
        catch (\Exception $ex) {
            return include("error.php");
        }
    }
};