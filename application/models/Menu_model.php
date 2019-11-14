<?php
class Menu_model extends CI_Model
{
    public function getAllMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function addMenu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function editMenu($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function getAllSubMenu()
    {
        $query = "SELECT `user_sub_menu`.* ,`user_menu`.`menu` 
                    FROM `user_sub_menu` JOIN `user_menu` 
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.* ,`user_menu`.`menu` 
                    FROM `user_sub_menu` JOIN `user_menu` 
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }

    public function deleteSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function editSubMenu($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function count_all_submenu()
    {
        return $this->db->get('user_sub_menu')->num_rows();
    }
}
