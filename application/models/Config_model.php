<?php
class Config_model extends CI_Model
{
    public function getConfig()
    {
        return $this->db->get('config')->row_array();
    }

    public function editConfig($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('config', $data);
    }
}
