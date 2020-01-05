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

            if (!empty($this->input->post('stnk_asli'))) {
                $stnk_asli = 1;
            } else $stnk_asli = 0;

            if (!empty($this->input->post('stnk_fc'))) {
                $stnk_fc = 1;
            } else $stnk_fc = 0;

            if (!empty($this->input->post('ktp_asli'))) {
                $ktp_asli = 1;
            } else $ktp_asli = 0;

            if (!empty($this->input->post('ktp_fc'))) {
                $ktp_fc = 1;
            } else $ktp_fc = 0;

            if (!empty($this->input->post('bpkb_asli'))) {
                $bpkb_asli = 1;
            } else $bpkb_asli = 0;

            if (!empty($this->input->post('bpkb_fc'))) {
                $bpkb_fc = 1;
            } else $bpkb_fc = 0;

            if (!empty($this->input->post('sk_kehilangan'))) {
                $sk_kehilangan = 1;
            } else $sk_kehilangan = 0;

            if (!empty($this->input->post('ktp_baru_fc'))) {
                $ktp_baru_fc = 1;
            } else $ktp_baru_fc = 0;

            if (!empty($this->input->post('invoice'))) {
                $invoice = 1;
            } else $invoice = 0;

            if (!empty($this->input->post('sk_lising'))) {
                $sk_lising = 1;
            } else $sk_lising = 0;

            if (!empty($this->input->post('kertas_gesek'))) {
                $kertas_gesek = 1;
            } else $kertas_gesek = 0;

            $data = [
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'stnk_asli' => $stnk_asli,
                'stnk_fc' => $stnk_fc,
                'ktp_asli' => $ktp_asli,
                'ktp_fc' => $ktp_fc,
                'bpkb_asli' => $bpkb_asli,
                'bpkb_fc' => $bpkb_fc,
                'sk_kehilangan' => $sk_kehilangan,
                'ktp_baru_fc' => $ktp_baru_fc,
                'invoice' => $invoice,
                'sk_lising' => $sk_lising,
                'kertas_gesek' => $kertas_gesek,
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

            if (!empty($this->input->post('stnk_asli'))) {
                $stnk_asli = 1;
            } else $stnk_asli = 0;

            if (!empty($this->input->post('stnk_fc'))) {
                $stnk_fc = 1;
            } else $stnk_fc = 0;

            if (!empty($this->input->post('ktp_asli'))) {
                $ktp_asli = 1;
            } else $ktp_asli = 0;

            if (!empty($this->input->post('ktp_fc'))) {
                $ktp_fc = 1;
            } else $ktp_fc = 0;

            if (!empty($this->input->post('bpkb_asli'))) {
                $bpkb_asli = 1;
            } else $bpkb_asli = 0;

            if (!empty($this->input->post('bpkb_fc'))) {
                $bpkb_fc = 1;
            } else $bpkb_fc = 0;

            if (!empty($this->input->post('sk_kehilangan'))) {
                $sk_kehilangan = 1;
            } else $sk_kehilangan = 0;

            if (!empty($this->input->post('ktp_baru_fc'))) {
                $ktp_baru_fc = 1;
            } else $ktp_baru_fc = 0;

            if (!empty($this->input->post('invoice'))) {
                $invoice = 1;
            } else $invoice = 0;

            if (!empty($this->input->post('sk_lising'))) {
                $sk_lising = 1;
            } else $sk_lising = 0;

            if (!empty($this->input->post('kertas_gesek'))) {
                $kertas_gesek = 1;
            } else $kertas_gesek = 0;

            $data = [
                'name' => $this->input->post('name'),
                'type' => $this->input->post('type'),
                'stnk_asli' => $stnk_asli,
                'stnk_fc' => $stnk_fc,
                'ktp_asli' => $ktp_asli,
                'ktp_fc' => $ktp_fc,
                'bpkb_asli' => $bpkb_asli,
                'bpkb_fc' => $bpkb_fc,
                'sk_kehilangan' => $sk_kehilangan,
                'ktp_baru_fc' => $ktp_baru_fc,
                'invoice' => $invoice,
                'sk_lising' => $sk_lising,
                'kertas_gesek' => $kertas_gesek,
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

    public function cost()
    {
        $data['title'] = 'Cost';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();
        $data['costs'] = $this->Master_model->getAllCost();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/cost', $data);
        $this->load->view('templates/footer');
    }

    public function addcost()
    {
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('service_id', 'Service', 'required');
        $this->form_validation->set_rules('param1', 'Param 1', 'required');
        $this->form_validation->set_rules('param2', 'Param 2', 'required');
        $this->form_validation->set_rules('motorcycle', 'Motorcycle', 'required|numeric');
        $this->form_validation->set_rules('car', 'Car', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Field cannot empty!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/cost');
        } else {
            $data = [
                'type' => $this->input->post('type'),
                'service_id' => $this->input->post('service_id'),
                'param1' => $this->input->post('param1'),
                'param2' => $this->input->post('param2'),
                'motorcycle' => $this->input->post('motorcycle'),
                'car' => $this->input->post('car')
            ];

            $this->db->insert('master_data_cost', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New cost added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/cost');
        }
    }

    // public function editcost()
    // {
    //     $data['title'] = 'Cost';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['services'] = $this->Master_model->getAllService();
    //     $data['costs'] = $this->Master_model->getAllCost();

    //     $this->form_validation->set_rules('type', 'Type', 'required');
    //     $this->form_validation->set_rules('service_id', 'Service', 'required');
    //     $this->form_validation->set_rules('param1', 'Param 1', 'required');
    //     $this->form_validation->set_rules('param2', 'Param 2', 'required');
    //     $this->form_validation->set_rules('motorcycle', 'Motorcycle', 'required|numeric');
    //     $this->form_validation->set_rules('car', 'Car', 'required|numeric');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('master/cost', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $id = $this->input->post('id');

    //         $data = [
    //             'type' => $this->input->post('type'),
    //             'service_id' => $this->input->post('service_id'),
    //             'param1' => $this->input->post('param1'),
    //             'param2' => $this->input->post('param2'),
    //             'motorcycle' => $this->input->post('motorcycle'),
    //             'car' => $this->input->post('car')
    //         ];

    //         $this->Master_model->editCost($id, $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //             Cost updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    //         redirect('master/cost');
    //     }
    // }

    public function editcost($id)
    {
        $data['title'] = 'Cost';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cost'] = $this->db->get_where('master_data_cost', ['id' => $id])->row_array();
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
            $this->load->view('master/editcost', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'type' => $this->input->post('type'),
                'service_id' => $this->input->post('service_id'),
                'param1' => $this->input->post('param1'),
                'param2' => $this->input->post('param2'),
                'motorcycle' => $this->input->post('motorcycle'),
                'car' => $this->input->post('car')
            ];

            $this->Master_model->editCost($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Cost updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('master/cost');
        }
    }

    public function deletecost()
    {
        $id = $this->input->post('id');
        $this->Master_model->deleteCost($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Cost deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('master/cost');
    }

    // get service by type
    function get_service_by_type()
    {
        $type = $this->input->post('id', TRUE);
        $data = $this->Master_model->get_service_by_type($type)->result();
        echo json_encode($data);
    }
}
