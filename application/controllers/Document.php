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
        $data['stnks'] = $this->Document_model->getStnk($data['user']['id'], $data['user']['role_id'], $data['user']['partner_id']);

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

        $this->form_validation->set_rules('type-stnk', 'Type', 'required');
        $this->form_validation->set_rules('service-id-stnk', 'Service', 'required');
        $this->form_validation->set_rules('category-stnk', 'Category', 'required');
        $this->form_validation->set_rules('param-stnk', 'Location', 'required');
        $this->form_validation->set_rules('behalf_of', 'Behalf of', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/addstnk', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $next = $this->Document_model->get_next_id_stnk();

            // Upload img config
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '1024';
            $config['upload_path'] = './assets/img/stnk/';
            $this->load->library('upload', $config);

            if (!$this->input->post('add_cost')) $add_cost = 0;
            else $add_cost = $this->input->post('add_cost');

            $doc_id = 'PJP/' . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $next;
            $total = $this->input->post('total') + $add_cost;

            // Upload STNK asli
            if ($this->upload->do_upload('stnk_asli')) {
                $this->db->set('stnk_asli',  $this->upload->data('file_name'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                    . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('document/addstnk');
            }

            // Upload STNK fc
            if ($this->upload->do_upload('stnk_fc')) {
                $this->db->set('stnk_fc', $this->upload->data('file_name'));
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                    . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('document/addstnk');
            }

            $data = [
                'service_id' => $this->input->post('service-id-stnk'),
                'doc_id' => $doc_id,
                'behalf_of' => $this->input->post('behalf_of'),
                'note' => $this->input->post('note'),
                'sub_total' => $this->input->post('total'),
                'total' => $total,
                'status' => 'Draft',
                'created_by' => $user['id'],
                'company_id' => $user['company_id'],
                'partner_id' => $user['partner_id'],
                'date_created' => time(),
                'modified_by' => $user['id'],
                'date_modified' => time(),
                'delete_status' => 0
            ];

            $this->db->insert('doc_stnk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New document added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('document');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = [
            'modified_by' => $user['id'],
            'date_modified' => time(),
            'delete_status' => 1
        ];

        $this->Document_model->deleteStnk($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Document deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('document');
    }
}
