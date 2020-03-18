<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Document_model');
        $this->load->model('Master_model');
    }

    public function index()
    {
        $data['title'] = 'Export STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stnks'] = $this->Document_model->getStnkDone($data['user']['id'], $data['user']['role_id'], $data['user']['partner_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/index', $data);
        $this->load->view('templates/footer');
    }

    public function bpkb()
    {
        $data['title'] = 'Export BPKB';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bpkbs'] = $this->Document_model->getBpkbDone($data['user']['id'], $data['user']['role_id'], $data['user']['partner_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/bpkb', $data);
        $this->load->view('templates/footer');
    }
}