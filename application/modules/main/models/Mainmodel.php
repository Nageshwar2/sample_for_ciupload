<?php

class Mainmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function insert_data($data) {
        $this->db->insert('data',array('name'=>$data['name'], 'image'=>$data['photo'], 'amount'=>$data['amount']));
        return $this->db->insert_id();
    }

    public function get_data() {
        return $this->db->select('name, image, amount, created_at')->from('data')->order_by('id', 'DESC')->get()->result();
    }

    public function select_data($select, $where ='') {
        $this->db->select($select)->from('data');
        if($where != '') $this->db->like($where);
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }
}
?>