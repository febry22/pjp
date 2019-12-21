<?php
class Master_model extends CI_Model
{
    public function getAllMaster()
    {
        $this->db->from('master_data_company');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addMaster($data)
    {
        $this->db->insert('master_data_company', $data);
    }

    public function deleteMaster($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_data_company');
    }

    public function editMaster($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('master_data_company', $data);
    }

    public function getPartner($company_id)
    {
        if ($company_id != 0) {
            $query = "SELECT `master_data_partner`.* ,`master_data_company`.`name` 
                    FROM `master_data_partner` JOIN `master_data_company` 
                    ON `master_data_partner`.`company_id` = `master_data_company`.`id`
                    WHERE `master_data_partner`.`company_id` = $company_id
                    ORDER BY `master_data_company`.`name` ASC";
        } else {
            $query = "SELECT `master_data_partner`.* ,`master_data_company`.`name` 
                    FROM `master_data_partner` JOIN `master_data_company` 
                    ON `master_data_partner`.`company_id` = `master_data_company`.`id`
                    ORDER BY `master_data_company`.`name` ASC";
        }

        return $this->db->query($query)->result_array();
    }

    public function editPartner($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('master_data_partner', $data);
    }

    public function deletePartner($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_data_partner');
    }

    function get_partner_by_company($company_id)
    {
        $query = $this->db->get_where('master_data_partner', ['company_id' => $company_id]);
        return $query;
    }
}
