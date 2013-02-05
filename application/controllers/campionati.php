<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Campionati extends CI_Controller {

    public function __construct() {
        parent::__construct();
    
        $this->load->module('campionati');
    }
    public function index($id = "") {
        return get($id);
    }

    public function get($id = "") {

        return json_encode($this->campionati->get($id));
    }

    public function active() {
        
        return json_encode($this->campionati->getActive());
    }

}

