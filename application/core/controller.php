<?php

class Controller {
    /**
     * @var null Database Connection
     */
    public $db = null;
    public $myDb = null;

    /**
     * @var null Model
     */
    public $model = null;

    function __construct() {
        $this->openDatabaseConnection();
        $this->openMysqliDatabaseConnection();
        $this->loadModel();
    }

    private function openDatabaseConnection() {

        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    private function openMysqliDatabaseConnection() {
        $this->myDb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    /**
     * Loads "model".
     * @return object model
     */
    public function loadModel() {
        require APP . 'model/model.php';
        $this->model = new Model($this->db);
    }
}
