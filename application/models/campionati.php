<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class campionati extends CI_Model{
    
    public function getAll(){
        return $this->db->get('campionati')->result();
    }
    
    public function get($id){
        return $this->db->query('select * from campionati where id = ?',array($id))->result();
    }
    
    public function getActive(){
        
        $campionati = $this->db->get('campionati')->result();
        
        $this->load->model('partite');
        $partite_attive = $this->partite->getActive();
        
        $campionati_attivi = array();
        
        foreach($campionati as $c){
            foreach($partite_attive as $p){
                if($p->campionato == $c->id){
                    array_push($campionati_attivi, $c);
                    break;
                }
            }
        }
        
        return $campionati_attivi;
    }
    
    
}
