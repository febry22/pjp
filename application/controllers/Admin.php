<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Admin_model');
        $this->load->model('Master_model');
        $this->load->model('Config_model');
    }

    public function index()
    {
        $data['title'] = 'Manage User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['myrole'] = $this->db->get_where('user_role', ['id' => $this->session->userdata('role_id')])->row_array();

        $data['alluser'] = $this->Admin_model->getAllUser();
        $data['role'] = $this->Admin_model->getAllRole(1);
        $data['companies'] = $this->Master_model->getAllMaster();
        $data['partners'] = $this->Master_model->getPartner(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->Admin_model->getAllRole(0);

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New role added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/role');
        }
    }

    public function deleterole()
    {
        $id = $this->input->post('id');
        $this->Admin_model->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Role deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/role');
    }

    public function editrole()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $this->Admin_model->editRole($id, $role);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Role updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/role');
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Access changed!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function edituser($id)
    {
        $data['title'] = 'Manage User';
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $data['roles'] = $this->Admin_model->getAllRole(1);
        $data['role'] = $this->db->get_where('user_role', ['id' => $data['user']['role_id']])->row_array();
        $data['companies'] = $this->Master_model->getAllMaster();
        $data['partners'] = $this->Master_model->getPartner($data['user']['company_id']);

        $this->form_validation->set_rules('name', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('company_id', 'Company', 'required');
        $this->form_validation->set_rules('partner_id', 'Branch', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edituser', $data);
            $this->load->view('templates/footer');
        } else {
            if (!empty($this->input->post('is_active'))) {
                $status = 1;
            } else $status = 0;

            $data = [
                'fullname' => $this->input->post('name'),
                'role_id' => $this->input->post('role_id'),
                'company_id' => $this->input->post('company_id'),
                'partner_id' => $this->input->post('partner_id'),
                'is_active' => $status
            ];

            $this->Admin_model->editUser($id, $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                User updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/index');
        }
    }

    public function config()
    {
        $data['title'] = 'Configuration';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['config'] = $this->Config_model->getConfig();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/config', $data);
        $this->load->view('templates/footer');
    }

    public function editconfig($id)
    {   
        $data['title'] = 'Configuration';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['config'] = $this->Config_model->getConfig();

        $this->form_validation->set_rules('admin_skp', 'Admin SKP', 'required');
        $this->form_validation->set_rules('acc_bpkb_leasing', 'ACC BPKB Leasing', 'required');
        $this->form_validation->set_rules('denda_jr_motor', 'Denda Jasa Raharja (Motor)', 'required');
        $this->form_validation->set_rules('denda_jr_mobil', 'Denda Jasa Raharja (Mobil)', 'required');
        $this->form_validation->set_rules('js_motor', 'Jasa Raharja (Motor)', 'required');
        $this->form_validation->set_rules('js_mobil', 'Jasa Raharja (Mobil)', 'required');
        $this->form_validation->set_rules('adm_stnk_motor', 'Administrasi STNK (Motor)', 'required');
        $this->form_validation->set_rules('adm_stnk_mobil', 'Administrasi STNK (Mobil)', 'required');
        $this->form_validation->set_rules('tnkb_motor', 'TNKB Motor', 'required');
        $this->form_validation->set_rules('tnkb_mobil', 'TNKB Mobil', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editconfig', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'admin_skp' => $this->input->post('admin_skp'),
                'acc_bpkb_leasing' => $this->input->post('acc_bpkb_leasing'),
                'denda_jatuh_tempo' => $this->input->post('denda_jatuh_tempo'),
                'denda_jr_motor' => $this->input->post('denda_jr_motor'),
                'denda_jr_mobil' => $this->input->post('denda_jr_mobil'),
                'js_motor' => $this->input->post('js_motor'),
                'js_mobil' => $this->input->post('js_mobil'),
                'adm_stnk_motor' => $this->input->post('adm_stnk_motor'),
                'adm_stnk_mobil' => $this->input->post('adm_stnk_mobil'),
                'tnkb_motor' => $this->input->post('tnkb_motor'),
                'tnkb_mobil' => $this->input->post('tnkb_mobil')
            ];

            $this->Config_model->editConfig($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Config updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/config');
        }
    }

    // get partner by company_id
    function get_partner_by_company()
    {
        $company_id = $this->input->post('id', TRUE);
        $data = $this->Master_model->get_partner_by_company($company_id)->result();
        echo json_encode($data);
    }
}
