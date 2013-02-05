<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partite extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('partite');
    }

    public function index() {

        $this->get();
    }

    public function active() {

        return json_encode($this->partite->getAcrive());
    }

    public function get($id = "") {
        return json_encode($this->partite->get($id));
    }
    
    public function campionato($id = ""){
        return json_encode($this->partite->campionato($id));
    }
}