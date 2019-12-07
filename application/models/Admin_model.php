<?php
class Admin_model extends CI_Model
{
    public function getAllRole($param)
    {
        if ($param == 0) {
            return $this->db->get('user_role')->result_array();
        } else {
            return $this->db->get_where('user_role', ['id !=' => $param])->result_array();
        }
    }

    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }

    public function editRole($id, $role)
    {
        $this->db->where('id', $id);
        $this->db->update('user_role', ['role' => $role]);
    }

    public function getAllUser()
    {
        $query = "SELECT `user`.* ,`user_role`.`role` 
                    FROM `user` 
                    JOIN `user_role` 
                    ON `user`.`role_id` = `user_role`.`id`
                    JOIN `master_data_company`
                    ON `user`.`company_id` = `master_data_company`.`id`
                    WHERE `user`.`role_id` != 1
        ";

        return $this->db->query($query)->result_array();
    }

    public function editUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}
