<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Document_model');
    }

    public function index()
    {
        $data['title'] = 'STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['stnks'] = $this->Document_model->getStnk($data['user']['id'], $data['user']['role_id']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/index', $data);
            $this->load->view('templates/footer');
        } else {
            // if (!empty($this->input->post('is_active'))) {
            //     $status = 1;
            // } else $status = 0;

            // $data = [
            //     'name' => $this->input->post('name'),
            //     'is_active' => $status
            // ];

            // $this->Master_model->addMaster($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    New document added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('document');
        }
    }
}
