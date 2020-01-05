<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
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
        $data['title'] = 'STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stnks'] = $this->Document_model->getStnk($data['user']['id'], $data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/index', $data);
        $this->load->view('templates/footer');
    }

    public function addstnk()
    {
        $data['title'] = 'STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('service_id', 'Service', 'required');
        $this->form_validation->set_rules('param1', 'Param 1', 'required');
        $this->form_validation->set_rules('param2', 'Param 2', 'required');
        $this->form_validation->set_rules('motorcycle', 'Motorcycle', 'required|numeric');
        $this->form_validation->set_rules('car', 'Car', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/addstnk', $data);
            $this->load->view('templates/footer');
        } else {
            // $data = [
            //     'type' => $this->input->post('type'),
            //     'service_id' => $this->input->post('service_id'),
            //     'param1' => $this->input->post('param1'),
            //     'param2' => $this->input->post('param2'),
            //     'motorcycle' => $this->input->post('motorcycle'),
            //     'car' => $this->input->post('car')
            // ];

            // $this->Master_model->editCost($id, $data);
            // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            //     Cost updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect('master/cost');
        }
    }
}
