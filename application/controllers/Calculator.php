<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calculator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->load->library('pdf');
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

    public function printpdfstnk()
    {    
        $data['title'] = 'Calculate STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->form_validation->set_rules('nopol', 'Nomor Polisi', 'required');
        $this->form_validation->set_rules('last_pajak', 'Pajak Tahun Lalu', 'required');
        $this->form_validation->set_rules('jatuh_tempo', 'Jatuh Tempo', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('calculator/index', $data);
            $this->load->view('templates/footer');
        }
        else {
            // return $this->load->view('pdf/stnk');

            // admin skp
            if($this->input->post('admin_skp')) $adm_skp = 1;
            else $adm_skp = 0;

            // service type
            if($this->input->post('type-stnk') == 'stnk') $type = 'STNK';
            else $type = 'BPKB';
            
            // service name
            $service = $this->db->get_where('master_data_service', array('id' => $this->input->post('service-id-stnk')))->row_array();

            $datalog = [
                'type' => $type,
                'service_id' => $this->input->post('service-id-stnk'),
                'category' => $this->input->post('category-stnk'),
                'cost_id' => $this->input->post('param-stnk'),
                'fee' => $this->input->post('total'),
                'admin_skp' => $adm_skp,
                'nopol' => $this->input->post('nopol'),
                'last_pajak' => $this->input->post('last_pajak'),
                'jatuh_tempo' => $this->input->post('jatuh_tempo'),
                'up_fee' => $this->input->post('up_fee'),
                'created_at' => time(),
                'created_by' => $data['user']['id'],
            ];

            $this->db->insert('calculator_log', $datalog);

            $data = [
                "type" => $type,
                "service" => $service['name']
            ];
            
            $this->pdf->generate('pdf/stnk', $data);   
        }
    }
}