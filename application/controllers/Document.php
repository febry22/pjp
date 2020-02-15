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

            $doc_id = 'PJP/S/' . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $next;
            $total = $this->input->post('total') + $add_cost;

            // Upload KTP asli
            $ktp_asli = $_FILES['ktp_asli']['name'];
            if ($ktp_asli) {
                if ($this->upload->do_upload('ktp_asli')) {
                    $this->db->set('ktp_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload KTP fc
            $ktp_fc = $_FILES['ktp_fc']['name'];
            if ($ktp_fc) {
                if ($this->upload->do_upload('ktp_fc')) {
                    $this->db->set('ktp_fc', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload STNK asli
            $stnk_asli = $_FILES['stnk_asli']['name'];
            if ($stnk_asli) {
                if ($this->upload->do_upload('stnk_asli')) {
                    $this->db->set('stnk_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload STNK fc
            $stnk_fc = $_FILES['stnk_fc']['name'];
            if ($stnk_fc) {
                if ($this->upload->do_upload('stnk_fc')) {
                    $this->db->set('stnk_fc', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload BPKB asli
            $bpkb_asli = $_FILES['bpkb_asli']['name'];
            if ($bpkb_asli) {
                if ($this->upload->do_upload('bpkb_asli')) {
                    $this->db->set('bpkb_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload BPKB fc
            $bpkb_fc = $_FILES['bpkb_fc']['name'];
            if ($bpkb_fc) {
                if ($this->upload->do_upload('bpkb_fc')) {
                    $this->db->set('bpkb_fc',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload SK Kehilangan
            $sk_kehilangan = $_FILES['sk_kehilangan']['name'];
            if ($sk_kehilangan) {
                if ($this->upload->do_upload('sk_kehilangan')) {
                    $this->db->set('sk_kehilangan',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload KTP fc baru
            $ktp_baru_fc = $_FILES['ktp_baru_fc']['name'];
            if ($ktp_baru_fc) {
                if ($this->upload->do_upload('ktp_baru_fc')) {
                    $this->db->set('ktp_baru_fc',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload Invoice
            $invoice = $_FILES['invoice']['name'];
            if ($invoice) {
                if ($this->upload->do_upload('invoice')) {
                    $this->db->set('invoice',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload SK Lising
            $sk_lising = $_FILES['sk_lising']['name'];
            if ($sk_lising) {
                if ($this->upload->do_upload('sk_lising')) {
                    $this->db->set('sk_lising',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            // Upload SK Lising
            $kertas_gesek = $_FILES['kertas_gesek']['name'];
            if ($kertas_gesek) {
                if ($this->upload->do_upload('kertas_gesek')) {
                    $this->db->set('kertas_gesek',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addstnk');
                }
            }

            $data = [
                'service_id' => $this->input->post('service-id-stnk'),
                'cost_id' => $this->input->post('param-stnk'),
                'category' => $this->input->post('category-stnk'),
                'doc_id' => $doc_id,
                'behalf_of' => $this->input->post('behalf_of'),
                'no_bpkb' => $this->input->post('no_bpkb'),
                'nama_stnk' => $this->input->post('nama_stnk'),
                'nama_bpkb' => $this->input->post('nama_bpkb'),
                'police_num_old' => $this->input->post('police_num_old'),
                'police_num_new' => $this->input->post('police_num_new'),
                'note' => $this->input->post('note'),
                'sub_total' => $this->input->post('total'),
                'add_cost' => $add_cost,
                'desc_cost' => $this->input->post('desc_cost'),
                'total' => $total,
                'status' => 'draft',
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

    public function detailstnk($id)
    {
        $data['title'] = 'STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stnk'] = $this->Document_model->getDetailStnk($id);
        $data['services'] = $this->Master_model->getAllService();
        $data['costs'] = $this->Master_model->getAllCost();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/detailstnk', $data);
        $this->load->view('templates/footer');
    }

    public function editstnk($id)
    {
        $data['title'] = 'STNK';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['stnk'] = $this->Document_model->getDetailStnk($id);
        $data['services'] = $this->Master_model->getAllService();
        $data['costs'] = $this->Master_model->getAllCost();

        $this->form_validation->set_rules('behalf_of', 'Behalf of', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/editstnk', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            // Upload img config
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '1024';
            $config['upload_path'] = './assets/img/stnk/';
            $this->load->library('upload', $config);

            if (!$this->input->post('add_cost')) $add_cost = 0;
            else $add_cost = $this->input->post('add_cost');

            $total = $data['stnk']['sub_total'] + $add_cost;

            // Upload KTP asli
            $ktp_asli = $_FILES['ktp_asli']['name'];
            if ($ktp_asli) {
                if ($this->upload->do_upload('ktp_asli')) {
                    $old_image = $data['stnk']['ktp_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload KTP fc
            $ktp_fc = $_FILES['ktp_fc']['name'];
            if ($ktp_fc) {
                if ($this->upload->do_upload('ktp_fc')) {
                    $old_image = $data['stnk']['ktp_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload STNK asli
            $stnk_asli = $_FILES['stnk_asli']['name'];
            if ($stnk_asli) {
                if ($this->upload->do_upload('stnk_asli')) {
                    $old_image = $data['stnk']['stnk_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('stnk_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload STNK fc
            $stnk_fc = $_FILES['stnk_fc']['name'];
            if ($stnk_fc) {
                if ($this->upload->do_upload('stnk_fc')) {
                    $old_image = $data['stnk']['stnk_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('stnk_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload BPKB asli
            $bpkb_asli = $_FILES['bpkb_asli']['name'];
            if ($bpkb_asli) {
                if ($this->upload->do_upload('bpkb_asli')) {
                    $old_image = $data['stnk']['bpkb_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('bpkb_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload BPKB fc
            $bpkb_fc = $_FILES['bpkb_fc']['name'];
            if ($bpkb_fc) {
                if ($this->upload->do_upload('bpkb_fc')) {
                    $old_image = $data['stnk']['bpkb_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('bpkb_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload SK Kehilangan
            $sk_kehilangan = $_FILES['sk_kehilangan']['name'];
            if ($sk_kehilangan) {
                if ($this->upload->do_upload('sk_kehilangan')) {
                    $old_image = $data['stnk']['sk_kehilangan'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('sk_kehilangan',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload KTP fc baru
            $ktp_baru_fc = $_FILES['ktp_baru_fc']['name'];
            if ($ktp_baru_fc) {
                if ($this->upload->do_upload('ktp_baru_fc')) {
                    $old_image = $data['stnk']['ktp_baru_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_baru_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload Invoice
            $invoice = $_FILES['invoice']['name'];
            if ($invoice) {
                if ($this->upload->do_upload('invoice')) {
                    $old_image = $data['stnk']['invoice'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('invoice',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload SK Lising
            $sk_lising = $_FILES['sk_lising']['name'];
            if ($sk_lising) {
                if ($this->upload->do_upload('sk_lising')) {
                    $old_image = $data['stnk']['sk_lising'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('sk_lising',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            // Upload SK Lising
            $kertas_gesek = $_FILES['kertas_gesek']['name'];
            if ($kertas_gesek) {
                if ($this->upload->do_upload('kertas_gesek')) {
                    $old_image = $data['stnk']['kertas_gesek'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/stnk/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('kertas_gesek',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editstnk/' . $id);
                }
            }

            $data = [
                'behalf_of' => $this->input->post('behalf_of'),
                'no_bpkb' => $this->input->post('no_bpkb'),
                'nama_stnk' => $this->input->post('nama_stnk'),
                'nama_bpkb' => $this->input->post('nama_bpkb'),
                'police_num_old' => $this->input->post('police_num_old'),
                'police_num_new' => $this->input->post('police_num_new'),
                'note' => $this->input->post('note'),
                'add_cost' => $add_cost,
                'desc_cost' => $this->input->post('desc_cost'),
                'total' => $total,
                'modified_by' => $user['id'],
                'date_modified' => time(),
                'status' => $this->input->post('status')
            ];

            $this->Document_model->editStnk($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Document updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

    public function bpkb()
    {
        $data['title'] = 'BPKB';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bpkbs'] = $this->Document_model->getBpkb($data['user']['id'], $data['user']['role_id'], $data['user']['partner_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/bpkb', $data);
        $this->load->view('templates/footer');
    }

    public function addbpkb()
    {
        $data['title'] = 'BPKB';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['services'] = $this->Master_model->getAllService();

        $this->form_validation->set_rules('type-bpkb', 'Type', 'required');
        $this->form_validation->set_rules('service-id-bpkb', 'Service', 'required');
        $this->form_validation->set_rules('category-bpkb', 'Category', 'required');
        $this->form_validation->set_rules('param-bpkb', 'Location', 'required');
        $this->form_validation->set_rules('behalf_of', 'Behalf of', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/addbpkb', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $next = $this->Document_model->get_next_id_bpkb();

            // Upload img config
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '1024';
            $config['upload_path'] = './assets/img/bpkb/';
            $this->load->library('upload', $config);

            if (!$this->input->post('add_cost')) $add_cost = 0;
            else $add_cost = $this->input->post('add_cost');

            $doc_id = 'PJP/B/' . date("Y") . '/' . date("m") . '/' . date("d") . '/' . $next;
            $total = $this->input->post('total') + $add_cost;

            // Upload KTP asli
            $ktp_asli = $_FILES['ktp_asli']['name'];
            if ($ktp_asli) {
                if ($this->upload->do_upload('ktp_asli')) {
                    $this->db->set('ktp_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload KTP fc
            $ktp_fc = $_FILES['ktp_fc']['name'];
            if ($ktp_fc) {
                if ($this->upload->do_upload('ktp_fc')) {
                    $this->db->set('ktp_fc', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload STNK asli
            $stnk_asli = $_FILES['stnk_asli']['name'];
            if ($stnk_asli) {
                if ($this->upload->do_upload('stnk_asli')) {
                    $this->db->set('stnk_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload STNK fc
            $stnk_fc = $_FILES['stnk_fc']['name'];
            if ($stnk_fc) {
                if ($this->upload->do_upload('stnk_fc')) {
                    $this->db->set('stnk_fc', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload BPKB asli
            $bpkb_asli = $_FILES['bpkb_asli']['name'];
            if ($bpkb_asli) {
                if ($this->upload->do_upload('bpkb_asli')) {
                    $this->db->set('bpkb_asli',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload BPKB fc
            $bpkb_fc = $_FILES['bpkb_fc']['name'];
            if ($bpkb_fc) {
                if ($this->upload->do_upload('bpkb_fc')) {
                    $this->db->set('bpkb_fc',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload SK Kehilangan
            $sk_kehilangan = $_FILES['sk_kehilangan']['name'];
            if ($sk_kehilangan) {
                if ($this->upload->do_upload('sk_kehilangan')) {
                    $this->db->set('sk_kehilangan',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload KTP fc baru
            $ktp_baru_fc = $_FILES['ktp_baru_fc']['name'];
            if ($ktp_baru_fc) {
                if ($this->upload->do_upload('ktp_baru_fc')) {
                    $this->db->set('ktp_baru_fc',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload Invoice
            $invoice = $_FILES['invoice']['name'];
            if ($invoice) {
                if ($this->upload->do_upload('invoice')) {
                    $this->db->set('invoice',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload SK Lising
            $sk_lising = $_FILES['sk_lising']['name'];
            if ($sk_lising) {
                if ($this->upload->do_upload('sk_lising')) {
                    $this->db->set('sk_lising',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            // Upload SK Lising
            $kertas_gesek = $_FILES['kertas_gesek']['name'];
            if ($kertas_gesek) {
                if ($this->upload->do_upload('kertas_gesek')) {
                    $this->db->set('kertas_gesek',  $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/addbpkb');
                }
            }

            $data = [
                'service_id' => $this->input->post('service-id-bpkb'),
                'cost_id' => $this->input->post('param-bpkb'),
                'category' => $this->input->post('category-bpkb'),
                'doc_id' => $doc_id,
                'behalf_of' => $this->input->post('behalf_of'),
                'no_bpkb' => $this->input->post('no_bpkb'),
                'nama_stnk' => $this->input->post('nama_stnk'),
                'nama_bpkb' => $this->input->post('nama_bpkb'),
                'police_num_old' => $this->input->post('police_num_old'),
                'police_num_new' => $this->input->post('police_num_new'),
                'note' => $this->input->post('note'),
                'sub_total' => $this->input->post('total'),
                'add_cost' => $add_cost,
                'desc_cost' => $this->input->post('desc_cost'),
                'total' => $total,
                'status' => 'draft',
                'created_by' => $user['id'],
                'company_id' => $user['company_id'],
                'partner_id' => $user['partner_id'],
                'date_created' => time(),
                'modified_by' => $user['id'],
                'date_modified' => time(),
                'delete_status' => 0
            ];

            $this->db->insert('doc_bpkb', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New document added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('document/bpkb');
        }
    }

    public function detailbpkb($id)
    {
        $data['title'] = 'BPKB';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bpkb'] = $this->Document_model->getDetailBpkb($id);
        $data['services'] = $this->Master_model->getAllService();
        $data['costs'] = $this->Master_model->getAllCost();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('document/detailbpkb', $data);
        $this->load->view('templates/footer');
    }

    public function editbpkb($id)
    {
        $data['title'] = 'BPKB';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bpkb'] = $this->Document_model->getDetailBpkb($id);
        $data['services'] = $this->Master_model->getAllService();
        $data['costs'] = $this->Master_model->getAllCost();

        $this->form_validation->set_rules('behalf_of', 'Behalf of', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('document/editbpkb', $data);
            $this->load->view('templates/footer');
        } else {
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            // Upload img config
            $config['allowed_types'] = 'jpg|png';
            $config['max_size']     = '1024';
            $config['upload_path'] = './assets/img/bpkb/';
            $this->load->library('upload', $config);

            if (!$this->input->post('add_cost')) $add_cost = 0;
            else $add_cost = $this->input->post('add_cost');

            $total = $data['bpkb']['sub_total'] + $add_cost;

            // Upload KTP asli
            $ktp_asli = $_FILES['ktp_asli']['name'];
            if ($ktp_asli) {
                if ($this->upload->do_upload('ktp_asli')) {
                    $old_image = $data['bpkb']['ktp_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload KTP fc
            $ktp_fc = $_FILES['ktp_fc']['name'];
            if ($ktp_fc) {
                if ($this->upload->do_upload('ktp_fc')) {
                    $old_image = $data['bpkb']['ktp_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload STNK asli
            $stnk_asli = $_FILES['stnk_asli']['name'];
            if ($stnk_asli) {
                if ($this->upload->do_upload('stnk_asli')) {
                    $old_image = $data['bpkb']['stnk_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('stnk_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload STNK fc
            $stnk_fc = $_FILES['stnk_fc']['name'];
            if ($stnk_fc) {
                if ($this->upload->do_upload('stnk_fc')) {
                    $old_image = $data['bpkb']['stnk_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('stnk_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload BPKB asli
            $bpkb_asli = $_FILES['bpkb_asli']['name'];
            if ($bpkb_asli) {
                if ($this->upload->do_upload('bpkb_asli')) {
                    $old_image = $data['bpkb']['bpkb_asli'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('bpkb_asli',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload BPKB fc
            $bpkb_fc = $_FILES['bpkb_fc']['name'];
            if ($bpkb_fc) {
                if ($this->upload->do_upload('bpkb_fc')) {
                    $old_image = $data['bpkb']['bpkb_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('bpkb_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload SK Kehilangan
            $sk_kehilangan = $_FILES['sk_kehilangan']['name'];
            if ($sk_kehilangan) {
                if ($this->upload->do_upload('sk_kehilangan')) {
                    $old_image = $data['bpkb']['sk_kehilangan'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('sk_kehilangan',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload KTP fc baru
            $ktp_baru_fc = $_FILES['ktp_baru_fc']['name'];
            if ($ktp_baru_fc) {
                if ($this->upload->do_upload('ktp_baru_fc')) {
                    $old_image = $data['bpkb']['ktp_baru_fc'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('ktp_baru_fc',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload Invoice
            $invoice = $_FILES['invoice']['name'];
            if ($invoice) {
                if ($this->upload->do_upload('invoice')) {
                    $old_image = $data['bpkb']['invoice'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('invoice',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload SK Lising
            $sk_lising = $_FILES['sk_lising']['name'];
            if ($sk_lising) {
                if ($this->upload->do_upload('sk_lising')) {
                    $old_image = $data['bpkb']['sk_lising'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('sk_lising',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            // Upload SK Lising
            $kertas_gesek = $_FILES['kertas_gesek']['name'];
            if ($kertas_gesek) {
                if ($this->upload->do_upload('kertas_gesek')) {
                    $old_image = $data['bpkb']['kertas_gesek'];

                    if ($old_image) {
                        unlink(FCPATH . '/assets/img/bpkb/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('kertas_gesek',  $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
                        . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('document/editbpkb/' . $id);
                }
            }

            $data = [
                'behalf_of' => $this->input->post('behalf_of'),
                'no_bpkb' => $this->input->post('no_bpkb'),
                'nama_stnk' => $this->input->post('nama_stnk'),
                'nama_bpkb' => $this->input->post('nama_bpkb'),
                'police_num_old' => $this->input->post('police_num_old'),
                'police_num_new' => $this->input->post('police_num_new'),
                'note' => $this->input->post('note'),
                'add_cost' => $add_cost,
                'desc_cost' => $this->input->post('desc_cost'),
                'total' => $total,
                'modified_by' => $user['id'],
                'date_modified' => time(),
                'status' => $this->input->post('status')
            ];

            $this->Document_model->editBpkb($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Document updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('document/bpkb');
        }
    }

    public function deletebpkb()
    {
        $id = $this->input->post('id');
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = [
            'modified_by' => $user['id'],
            'date_modified' => time(),
            'delete_status' => 1
        ];

        $this->Document_model->deleteBpkb($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Document deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('document/bpkb');
    }
}
