<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calculator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Master_model');
    }

    public function index()
    {
        $data['title'] = 'Calculate STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('calculator/index', $data);
        $this->load->view('templates/footer');
    }
}