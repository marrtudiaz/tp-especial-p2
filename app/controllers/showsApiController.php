<?php
require_once './app/models/show.model.php';
require_once './app/views/JSONView.php';
require_once './app/helpers/auth.helper.php';


class ShowsApiController
{

    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct()
    {
        $this->model = new ShowModel();
        $this->view = new JSONView();
        $this->authHelper = new AuthHelper();

        $this->data = file_get_contents("php://input");
    }

    public function getShows($params = NULL)
    {
        $defaultSortBy = "id_show";
        $defaultOrder = "asc";
        $tamanioPag = 10;
        $page = 1;
        
        if (isset($_GET["limit"])) {
            $tamanioPag = $this->Convert($_GET["limit"], $tamanioPag);
        }
        if (isset($_GET["page"])) {
            $page = $this->Convert($_GET["page"], $page);
        }
        if (isset($_GET["sortBy"])) {
            $sortBy = $this->getColumns($_GET["sortBy"]);
        }
       
        $inicioPag = ($page - 1) * $tamanioPag;

        try {

            if (!empty($sortBy) && !empty($_GET["order"] &&!empty($_GET["search"]))) {
                $shows = $this->model->getFiltredShows($inicioPag, $tamanioPag, $_GET["order"], $sortBy,$_GET["search"]);
            } 
            else if (!empty($sortBy) && !empty($_GET["search"])){
                $shows = $this->model->getFiltredShows($inicioPag, $tamanioPag,$defaultOrder, $sortBy, $_GET["search"]);
            }
            else if (!empty($sortBy) && !empty($_GET["order"])) {
                $shows = $this->model->getAllShows($inicioPag, $tamanioPag, $sortBy, $_GET["order"]);
            } else if (!empty($sortBy)) {
                $shows = $this->model->getAllShows($inicioPag, $tamanioPag, $sortBy, $defaultOrder);
            } else if (!empty($_GET["order"])) {
                $shows = $this->model->getAllShows($inicioPag, $tamanioPag, $defaultSortBy, $_GET["order"]);
            } else  {
                $shows = $this->model->getAllShows($inicioPag, $tamanioPag);
            }
        } catch (Exception) {
            $this->view->response("El servidor no pudo interpretar la solicitud,sintaxis invalida", 400);
        }
        if (isset($shows)) {
            $this->view->response($shows, 200);
        }
    }
  
    public function getShow($params = NULL)
    {
        $id = $params[":ID"];
        $show = $this->model->showShowDetail($id);
        if ($show) {
            $this->view->response($show, 200);
        } else {
            $this->view->response("No existe un show con el id {$id}", 404);
        }
    }

    public function deleteShow($params = NULL)
    {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
            return;
        }
        $id = $params[':ID'];
        $show = $this->model->ShowShowDetail($id);

        if ($show) {
            $this->model->deleteShowById($id);
            $this->view->response("El show $id fue eliminado correctamente", 200);
        } else
            $this->view->response("No existe un show con el id {$id}", 404);
    }

    public function addShow($params = NULL)
    {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
            return;
        }
        $data = $this->getData();
        try {
            if ($this->existData($this->getData())) {
                    $id = $this->model->insertShow($data->name, $data->id_artist, $data->date, $data->price);
                    $this->view->response("El show $id fue creado  correctamente", 201);
                }
                
            else {
                $this->view->response("Falta llenar algun campo", 400);
            }
        } catch (Exception) {
            $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }

    public function editShow($params = NULL)
    {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("Necesitas loguearte para poder realizar esta accion", 401);
            return;
        }
        $data = $this->getData();
        try {
            if ($this->existData($this->getData())) {
            $id_show = $params[':ID'];
            $this->model->updateShowById($data->name, $data->id_artist, $data->date, $data->price, $id_show);
            $this->view->response("El show fue modificado correctamente", 200);

            }
            else {
                $this->view->response("Falta llenar algun campo", 400);
            }
        } catch (Exception) {
            $this->view->response("El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }
    public function getData()
    {
        return json_decode($this->data);
    }

    function Convert($param, $defaultParam)
    {
        $result = intval($param);
        if ($result > 0) {
            $result = $param;
        } else {
            $result = $defaultParam;
        }
        return $result;
    }

    function getColumns($param)
    {
        $columns = $this->model->getAllColumns();
        for ($i = 0; $i < sizeof($columns); $i++) {
            $aux = $columns[$i]->COLUMN_NAME;
            if ($aux == $param) {
                return $param;
            }
        }
        return null;
    }

    function existData($param)
    {
        if ($param!=null){
            $param->id_show="skipped";
        }
        $columns = $this->model->getAllColumns();
        for ($i = 0; $i < sizeof($columns); $i++) {
            $aux = $columns[$i]->COLUMN_NAME;
            if (empty($param->$aux)) {
                return false;
            }
        }
        return true;
    }
   
}