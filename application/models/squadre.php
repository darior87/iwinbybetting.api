<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class squadre extends CI_Model{
    
    public function getAll(){
        return $this->db->get('campionati')->result();
    }
    
    public function get($id = ""){
        return $this->db->query('select * from campionati where id = ?',array($id))->result();
    }
    
    public function getByCampionato($id = ""){
        return $this->db->query('select * from squadre where id in (select squadra from iscrizione where campionato = ?)',array($id));
    }
    
    public function getActive($campionato = ""){
        
        /*
         * squadre attive
         */
        if ($campionato == "") {
            $campionati = $this->db->get('campionati')->result();

            $this->load->model('partite');
            $partite_attive = $this->partite->getActive();

            $campionati_attivi = array();

            foreach ($campionati as $c) {
                foreach ($partite_attive as $p) {
                    if ($p->campionato == $c->id) {
                        array_push($campionati_attivi, $c);
                        break;
                    }
                }
            }

            return $campionati_attivi;
        }
        
        /*
         * squadre attive del campionato
         */
        $squadre_attive_campionato = $this->db->query('(select * from squadre where id in '.
                    '(select casa from partite where campionato = ?))'.
                    'union'.
                    '(select * from squadre id in '.
                    '(select trasferta from partite where campionato = ?))',array($id,$id))->result();
        
        return $squadre_attive_campionato;
    }
    
    
}
