<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Menu_model->getAllMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('_order', 'Order', 'required|integer');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $order = $this->db->get_where('user_menu', ['_order' => $this->input->post('_order')])->row_array();

            if ($order) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Menu order is used!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu');
            } else {
                $data = [
                    'menu' => $this->input->post('menu'),
                    '_order' => $this->input->post('_order')
                ];

                $this->Menu_model->addMenu($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    New menu added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->Menu_model->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Menu deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }

    public function edit()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->Menu_model->getAllMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('_order', 'Order', 'required|integer');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');

            $order = $this->db->get_where('user_menu', ['_order' => $this->input->post('_order'), 'id !=' => $id])->row_array();

            if ($order) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Menu order is used!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu');
            } else {
                $data = [
                    'menu' => $this->input->post('menu'),
                    '_order' => $this->input->post('_order')
                ];

                $this->Menu_model->editMenu($id, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Menu updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu');
            }
        }
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_model->getAllMenu();
        $data['submenu'] = $this->Menu_model->getSubMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function addsubmenu()
    {
        $this->form_validation->set_rules('title', 'Submenu Name', 'required');
        $this->form_validation->set_rules('menu_id', 'Parent Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('_order', 'Order', 'required|integer');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Field cannot empty!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('menu/submenu');
        } else {
            $ord = $this->input->post('_order');
            $menu_id = $this->input->post('menu_id');

            $order = $this->db->get_where('user_sub_menu', ['_order' => $ord, 'menu_id' => $menu_id])->row_array();

            if ($order) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Sub menu order is already used!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu/submenu');
            } else {
                if (!empty($this->input->post('is_active'))) {
                    $status = 1;
                } else $status = 0;

                $data = [
                    'title' => $this->input->post('title'),
                    'menu_id' => $menu_id,
                    'url' => $this->input->post('url'),
                    'icon' => $this->input->post('icon'),
                    '_order' => $ord,
                    'is_active' => $status
                ];

                $this->db->insert('user_sub_menu', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                New sub menu added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu/submenu');
            }
        }
    }

    public function editsubmenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Menu_model->getAllMenu();
        $data['submenu'] = $this->Menu_model->getSubMenu();

        $this->form_validation->set_rules('title', 'Submenu Name', 'required');
        $this->form_validation->set_rules('menu_id', 'Parent Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('_order', 'Order', 'required|integer');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $ord = $this->input->post('_order');
            $menu_id = $this->input->post('menu_id');

            $order = $this->db->get_where('user_sub_menu', ['_order' => $ord, 'menu_id' => $menu_id, 'id !=' => $id])->row_array();

            if ($order) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Sub menu order is used!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu/submenu');
            } else {
                if (!empty($this->input->post('is_active'))) {
                    $status = 1;
                } else $status = 0;

                $data = [
                    'title' => $this->input->post('title'),
                    'menu_id' => $menu_id,
                    'url' => $this->input->post('url'),
                    'icon' => $this->input->post('icon'),
                    '_order' => $ord,
                    'is_active' => $status
                ];

                $this->Menu_model->editSubMenu($id, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Sub menu updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('menu/submenu');
            }
        }
    }

    public function deletesubmenu()
    {
        $id = $this->input->post('id');
        $this->Menu_model->deleteSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Sub Menu deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu/submenu');
    }
}
