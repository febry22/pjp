<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Master_model');
    }

    public function index()
    {
        $data['title'] = 'Companies';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['companies'] = $this->Master_model->getAllMaster();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer');
        } else {
            if (!empty($this->input->post('is_active'))) {
                $status = 1;
            } else $status = 0;

            $data = [
                'name' => $this->input->post('name'),
                'is_active' => $status
            ];

            $this->Master_model->addMaster($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    New companies added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Master_model->deleteMaster($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Company deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('master');
    }

    public function edit()
    {
        $data['title'] = 'Companies';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['companies'] = $this->Master_model->getAllMaster();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');

            if (!empty($this->input->post('is_active'))) {
                $status = 1;
            } else $status = 0;

            $data = [
                'name' => $this->input->post('name'),
                'is_active' => $status
            ];

            $this->Master_model->editMaster($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Company updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master');
        }
    }

    public function partner()
    {
        $data['title'] = 'Company Branch';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['companies'] = $this->Master_model->getAllMaster();
        $data['partner'] = $this->Master_model->getPartner(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/partner', $data);
        $this->load->view('templates/footer');
    }

    public function addpartner()
    {
        $this->form_validation->set_rules('partner_name', 'Partner name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('company_id', 'Company', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Field cannot empty!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/partner');
        } else {
            $company_id = $this->input->post('company_id');

            $data = [
                'partner_name' => $this->input->post('partner_name'),
                'code' => $this->input->post('code'),
                'company_id' => $company_id
            ];

            $this->db->insert('master_data_partner', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New branch added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/partner');
        }
    }

    public function editpartner()
    {
        $data['title'] = 'Company Branch';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['companies'] = $this->Master_model->getAllMaster();
        $data['partner'] = $this->Master_model->getPartner(0);

        $this->form_validation->set_rules('partner_name', 'Partner name', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('company_id', 'Company', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/partner', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $company_id = $this->input->post('company_id');

            $data = [
                'partner_name' => $this->input->post('partner_name'),
                'code' => $this->input->post('code'),
                'company_id' => $company_id
            ];

            $this->Master_model->editPartner($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Branch updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/partner');
        }
    }

    public function deletepartner()
    {
        $id = $this->input->post('id');
        $this->Master_model->deletePartner($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Branch deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('master/partner');
    }

    public function service()
    {
        $data['title'] = 'Services';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/service', $data);
        $this->load->view('templates/footer');
    }

    public function addservice()
    {
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('name', 'Service name', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Field cannot empty!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/service');
        } else {
            if (!empty($this->input->post('is_active'))) {
                $status = 1;
            } else $status = 0;

            $data = [
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'is_active' => $status
            ];

            $this->db->insert('master_data_service', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New service added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/service');
        }
    }

    public function editservice()
    {
        $data['title'] = 'Company Branch';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('name', 'Service name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/service', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            if (!empty($this->input->post('is_active'))) {
                $status = 1;
            } else $status = 0;

            $data = [
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'is_active' => $status
            ];

            $this->Master_model->editService($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Service updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/service');
        }
    }

    public function deleteservice()
    {
        $id = $this->input->post('id');
        $this->Master_model->deleteService($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Service deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('master/service');
    }
}
