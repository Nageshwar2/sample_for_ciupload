<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mainmodel');
    }

    public function index() {
        $data = array();
        $data['data'] = $this->Mainmodel->get_data();
        return $this->load->view('index', $data);
    }

    public function search() {
        $search = $this->input->post('search_key', true);
        $result['data'] = $this->Mainmodel->select_data('name, image, amount, created_at',array('name'=>$search));
        return $this->load->view('index', $result);
    }

    public function add(){
        return $this->load->view('add');
    }

    public function submit() {
        $ins_data = $this->input->post(NULL, true);
        $path = 'uploads/images';
        print_r($ins_data);
        if(!($ImageName = uploadFile('photo', $path, 5242880, ''))) return header('Location: ' . $_SERVER['HTTP_REFERER']);
        $ins_data['photo'] = json_encode($ImageName);
        if($this->Mainmodel->insert_data($ins_data)) {
            return redirect(base_url());
        }
    }

}