<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pronostici extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pronostici');
        $this->load->model('partite');
    }
    public function index() {
        return $this->get();
    }

    public function generateHits($rischio = 1, $numero_partite = 5) {
        return json_encode($this->pronostici->top($rischio,$partite));
    }

    public function get($partita = "", $id = "") {

        $pronostico = $this->pronostici->get($id);

        if ($pronostico->partita == $partita)
            return json_encode($pronostico);

        if ($id == "" && $partita != "") {
            return json_encode($this->partite->get($partita));
        }

        return json_encode(array());
    }

}
