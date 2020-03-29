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
        $this->load->model('Calculator_model');
    }

    public function index()
    {
        $data['title'] = 'Calc STNK';
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
        $data['title'] = 'Calc STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        // print_r($data['user']['id']);
        // die();

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

            // get config
            $config = $this->db->get('config')->row_array();

            // diff between date
            // jatuh tempo
            $date1 = $this->input->post('jatuh_tempo'); 
            // today
            $date2 = date("d-m-Y");
            $diff = abs(strtotime($date2) - strtotime($date1));
            
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $total_all = 0;
            $d_jatuh_tempo = 0;
            $d_jr = 0;
            $acc_bpkb_leasing = $config['acc_bpkb_leasing'];
            $last_pajak_ = $this->input->post('last_pajak');
            $user_id = $data['user']['id'];

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

            // hide tnkb dan adm stnk
            if($service['name'] != 'Perpanjangan 5 Tahunan'){
                $b_adm_stnk = 0;
                $b_tnkb = 0;
            }

            // up fee
            if($this->input->post('up_fee') == 10){
                // $b_adm_skp = $b_adm_skp + (($b_adm_skp*10)/100);
                $d_jatuh_tempo = $d_jatuh_tempo + (($d_jatuh_tempo*10)/100);
                $b_js = $b_js + (($b_js*10)/100);
                $d_jr = $d_jr + (($d_jr*10)/100);
                $b_adm_stnk = $b_adm_stnk + (($b_adm_stnk*10)/100);
                $b_tnkb = $b_tnkb + (($b_tnkb*10)/100);
                $last_pajak_ = $last_pajak_ + (($last_pajak_*10)/100);
            }
            elseif($this->input->post('up_fee') == 20){
                // $b_adm_skp = $b_adm_skp + (($b_adm_skp*20)/100);
                $d_jatuh_tempo = $d_jatuh_tempo + (($d_jatuh_tempo*20)/100);
                $b_js = $b_js + (($b_js*20)/100);
                $d_jr = $d_jr + (($d_jr*20)/100);
                $b_adm_stnk = $b_adm_stnk + (($b_adm_stnk*20)/100);
                $b_tnkb = $b_tnkb + (($b_tnkb*20)/100);
                $last_pajak_ = $last_pajak_ + (($last_pajak_*20)/100);
            }
            elseif($this->input->post('up_fee') == 30){
                // $b_adm_skp = $b_adm_skp + (($b_adm_skp*30)/100);
                $d_jatuh_tempo = $d_jatuh_tempo + (($d_jatuh_tempo*30)/100);
                $b_js = $b_js + (($b_js*30)/100);
                $d_jr = $d_jr + (($d_jr*30)/100);
                $b_adm_stnk = $b_adm_stnk + (($b_adm_stnk*30)/100);
                $b_tnkb = $b_tnkb + (($b_tnkb*30)/100);
                $last_pajak_ = $last_pajak_ + (($last_pajak_*30)/100);
            }
            elseif($this->input->post('up_fee') == 0){
                // $b_adm_skp = $b_adm_skp;
                $d_jatuh_tempo = $d_jatuh_tempo;
                $b_js = $b_js;
                $d_jr = $d_jr;
                $b_adm_stnk = $b_adm_stnk;
                $b_tnkb = $b_tnkb;
                $last_pajak_ = $last_pajak_;
            }

            // denda
            $jr = $b_js;
            $pajak_ar = [];
            $date1Unix = strtotime($date1);
            if(strtotime($date1) < strtotime($date2)){
                // > 1 hari = 1 bulan
                if($days > 0){
                    $months = $months + 1;
                }

                if($years > 0){
                    if($months > 0 || $days > 0){
                        // echo 'years = '.$years.' months = '.$months.' days = '.$days;
                        // die();
                        // denda jatuh tempo
                        $multiplier = ($years*12) + $months;
                        $d_jatuh_tempo = ($last_pajak_*$multiplier*2)/100;
    
                        // denda jasa raharja
                        $d_jr = $denda_jr*$years;
                        $jr = $b_js*$years;
    
                        // pajak
                        if($months > 10){
                            // denda jasa raharja
                            $d_jr =  $d_jr + $denda_jr;
                            $jr = $jr + $b_js;

                            $year_diff = date("Y", time()) - date("Y", $date1Unix) + 1;
    
                            $y1 = date("Y", $date1Unix);
                            for ($i = 0; $i <= $year_diff; $i++) {
                                $y2 = $y1 + 1;
                                array_push($pajak_ar, $y1.' - '.$y2);
                                $total_all = $total_all + $last_pajak_;

                                $y1 = $y2;
                            }
                        }
                        elseif($months <= 10){
                            $year_diff = date("Y", time()) - date("Y", $date1Unix);
    
                            $y1 = date("Y", $date1Unix);
                            for ($i = 0; $i <= $year_diff; $i++) {
                                $y2 = $y1 + 1;
                                array_push($pajak_ar, $y1.' - '.$y2);
                                $total_all = $total_all + $last_pajak_;

                                $y1 = $y2;
                            }
                        }
                    }
                }
                else{
                    // denda jatuh tempo
                    $d_jatuh_tempo = ($last_pajak_*$months*2)/100;

                    // denda jasa raharja
                    $d_jr = $denda_jr*1;
                    $jr = $b_js*1;

                    $y2 = date("Y", $date1Unix);
                    $y1 = $y2 - 1;
                    array_push($pajak_ar, $y1.' - '.$y2);
                    $total_all = $total_all + $last_pajak_;
                }
            }
            else {
                $y2 = date("Y", $date1Unix);
                $y1 = $y2 - 1;
                array_push($pajak_ar, $y1.' - '.$y2);
                $total_all = $total_all + $last_pajak_;
            }

            // biaya admin skp
            if(count($pajak_ar) > 1) $b_adm_skp = $config['admin_skp'];
            else $b_adm_skp = 0;

            $total_all = $total_all + $this->input->post('total') + $b_adm_skp + $acc_bpkb_leasing + $d_jatuh_tempo + $b_js + $d_jr + $b_adm_stnk + $b_tnkb;
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
                "acc_bpkb_leasing" => $acc_bpkb_leasing,
                "last_pajak_" => $last_pajak_,
                "pajak_ar" => $pajak_ar,
                "jatuh_tempo" => $this->input->post('jatuh_tempo'),
                "d_jatuh_tempo" => $d_jatuh_tempo,
                "jr" => $jr,
                "d_jr" => $d_jr,
                "adm_stnk" => $b_adm_stnk,
                "tnkb" => $b_tnkb,
                "total_all" => $total_all
            ];

            $datalog = [
                'type' => $type,
                'service_id' => $this->input->post('service-id-stnk'),
                'category' => $this->input->post('category-stnk'),
                'cost_id' => $this->input->post('param-stnk'),
                'fee' => $this->input->post('total'),
                'admin_skp' => $adm_skp,
                'nopol' => $this->input->post('nopol'),
                'name' => $this->input->post('fullname'),
                'phone' => $this->input->post('phone'),
                'last_pajak' => $last_pajak_,
                'jatuh_tempo' => strtotime($this->input->post('jatuh_tempo')),
                'up_fee' => $this->input->post('up_fee'),
                'created_at' => time(),
                'created_by' => $user_id,
            ];
            
            $this->db->insert('calculator_log', $datalog);
            $this->pdf->generate('pdf/stnk', $data);
        }
    }

    public function history()
    {
        $data['title'] = 'History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['logs'] = $this->Calculator_model->getLog($data['user']['id'], $data['user']['role_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('calculator/history', $data);
        $this->load->view('templates/footer');
    }
}