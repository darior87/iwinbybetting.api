<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pronostici extends CI_Model {
    /*
     * get all by game id
     */

    public function getAll($id) {
        return $this->db->query('select * from pronostici where partita = ?', array($id))->result();
    }

    /*
     * get specific pronostico
     */

    public function get($id) {
        return $this->db->query('select * from pronostici where id = ?', array($id))->result();
    }

    /*
     * get all by active games
     */

    public function getActive() {

        $this->load->model('partite');

        $partite_attive = $this->partite->getActive();
        $pronostici = arra();

        foreach ($partite_attive as $pa) {
            $pr = $this->db->query('select * from pronostici where partita = ?', array($pa->id))->result();

            foreach ($pr as $p) {
                array_push($pronostici, $p);
            }
        }

        return $pronostici;
    }

    /*
     * top $num_partite
     * 
     * $rischio     fino a che non ci sono più pronostici di quel rischio.
     * 
     * fino a quando arrivo a 5 schedine
     * 
     * @returns schedina autogenerata
     */

    public function top($rischio = 1, $num_partite = 5) {


        $schedina = array();
        $rischio_attuale = $rischio;
        $up = false;
        for ($i = 0; $i < $num_partite; $i++) {

            $pronostico = $this->db->query('select * from pronostici where rischio = ? and partita in (select id from partite where data > ?)', array($rischio_attuale, date('Y-m-d')))->result();

            $i = count($pronostico);

            foreach ($pronostico as $p)
                $schedina = array_push($schedina, $p);


            if ($rischio_attuale <= $rischio && $rischio_attuale >= 1) {
                $rischio_attuale--;
            } elseif ($rischio_attuale > $rischio && $rischio_attuale <= $num_partite) {
                if ($rischio_attuale == 0)
                    $rischio_attuale = $rischio + 1;
                else
                    $rischio_attuale++;
            }
        }
    }

}
