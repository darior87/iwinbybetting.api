<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class partite extends CI_Model{
    
    public function get($id = ""){
        return $this->db->query('select * from partite where id = ?',array($id))->result();
    }
    
    public function getActive(){
        
        return $this->db->query('select * from partite where data >'.date('Y-m-d'))->result();
    }
    
    public function campionato($id){
        $id_campionato = $this->db->query('select * from campionati where nome = $')->first_row();
        return $this->db->query('select * from partite where campionato = '.$id_campionato->id.' and data >'.data('Y-m-d'))->result();
    }
}
