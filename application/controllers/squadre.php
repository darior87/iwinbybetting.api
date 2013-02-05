<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Squadre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('squadre');
    }
    public function index() {
        return $this->get();
    }

    public function get($id = "") {
        return json_encode($this->squadre->get($id));
    }

    public function campionato($id = "") {
        return json_encode($this->squadre->getByCampionato($id));
    }

    public function active($campionato = "") {
        $squadre = $this->squadre->getActive($campionato);
    }

}