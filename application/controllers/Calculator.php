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

    public function printpdf()
    {      
        // service type
        if($this->input->post('type-stnk') == 'stnk') $type = 'STNK';
        else $type = 'BPKB';
        
        // service name
        $service = $this->db->get_where('master_data_service', array('id' => $this->input->post('service-id-stnk')))->row_array();

        // P = orientasi jenis kertas, menggunakan Potrait
        // mm = jenis ukuran milimeter
        // A4 = ukuran kertas
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        
        //salah satu yang paling wajib adalah kita harus menyertakan jenis huruf dan ukuran huruf dengan menggunakan fungsi SetFont()
        //disini menggunakan jenis huruf Arial, ukuran huruf 16 dan tipe Bold
        $pdf->SetFont('Arial','B',16);
        
        //untuk menampilkan teks kedalam file PDF kita menggunakan fungsi Write()
        //parameter awalnya untuk posisi teks 20, kemudian diikuti dengan isi teksnya "Hello World"
        $pdf->Image(base_url().'assets/img/pdf_logo.png',12,20,10,10);
        $pdf->Write('50','PJP - Prakiraan Biaya');
        
        //kemudian kita tambahkan lagi baris baru menggunakan fungsi Ln()
        $pdf->Ln();
        
        //dan kita tambahkan teks baru
        //untuk posisinya biarkan saja 0 agar jarak spasinya tidak terlalu jauh
        $pdf->Write('-35',$type.' - '.$service['name']);

        $pdf->Output('I','Calculate_STNK_'.rand());
    }
}