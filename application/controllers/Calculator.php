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
                'jatuh_tempo' => strtotime($this->input->post('jatuh_tempo')),
                'up_fee' => $this->input->post('up_fee'),
                'created_at' => time(),
                'created_by' => $data['user']['id'],
            ];

            $this->db->insert('calculator_log', $datalog);

            // get config
            $config = $this->db->get('config')->row_array();

            // diff between date
            $date1 = $this->input->post('jatuh_tempo');
            $date2 = date("d-m-Y");
            $diff = abs(strtotime($date2) - strtotime($date1));
            
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            // biaya admin skp
            if($adm_skp == 1) $b_adm_skp = $config['admin_skp'];
            else $b_adm_skp = 0;

            // biaya jasa raharja, adm stnk, tnkb
            if($this->input->post('category-stnk') == 'car') 
            {   
                $category = 'Mobil';
                $b_js = $config['js_mobil'];
                $b_adm_stnk = $config['adm_stnk_mobil'];
                $b_tnkb = $config['tnkb_mobil'];
                $denda_jr = $config['denda_jr_mobil'];
            }
            else 
            {
                $category = 'Motor';
                $b_js = $config['js_motor'];
                $b_adm_stnk = $config['adm_stnk_motor'];
                $b_tnkb = $config['tnkb_motor'];
                $denda_jr = $config['denda_jr_motor'];
            }

            // denda
            $pajak_ar = [];
            if($years > 0){
                if($months > 0 || $days > 0){
                    // denda jatuh tempo
                    $multiplier = ($years*12) + $months;
                    $d_jatuh_tempo = ($this->input->post('last_pajak')*$multiplier*2)/100;

                    // denda jasa raharja
                    $d_jr = $denda_jr*$years;

                    // pajak
                    $date1Unix = strtotime($date1);
                    if($months > 10){
                        $year_diff = date("Y", time()) - date("Y", $date1Unix);

                        $y1 = date("Y", $date1Unix);
                        for ($i = 0; $i <= $year_diff; $i++) {
                            $y2 = $y1 + 1;
                            array_push($pajak_ar, $y1.' - '.$y2);
                            $y1 = $y2;
                        }
                    }
                    elseif($months <= 10){
                        $y1 = date("Y", $date1Unix);
                        for ($i = 0; $i < 2; $i++) {
                            $y2 = $y1 + 1;
                            array_push($pajak_ar, $y1.' - '.$y2);
                            $y1 = $y2;
                        }
                    }
                }
            }

            $data = [
                "years" => $years,
                "$months" => $months,
                "$days" => $days,
                "category" => $category,
                "nopol" => $this->input->post('nopol'),
                "type" => $type,
                "service" => $service['name'],
                "total" => $this->input->post('total'),
                "b_adm_skp" => $b_adm_skp,
                "acc_bpkb_leasing" => $config['acc_bpkb_leasing'],
                "last_pajak" => $this->input->post('last_pajak'),
                "pajak_ar" => $pajak_ar,
                "jatuh_tempo" => $this->input->post('jatuh_tempo'),
                "d_jatuh_tempo" => $d_jatuh_tempo,
                "jr" => $b_js,
                "d_jr" => $d_jr,
                "adm_stnk" => $b_adm_stnk,
                "tnkb" => $b_tnkb
            ];
            
            $this->pdf->generate('pdf/stnk', $data);   
        }
    }
}