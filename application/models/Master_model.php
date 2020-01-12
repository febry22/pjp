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

    public function getAllService()
    {
        $this->db->from('master_data_service');
        $this->db->order_by('type', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function editService($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('master_data_service', $data);
    }

    public function deleteService($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_data_service');
    }

    public function getAllCost()
    {
        $query = "SELECT `master_data_cost`.* ,`master_data_service`.`name` 
                    FROM `master_data_cost` JOIN `master_data_service` 
                    ON `master_data_cost`.`service_id` = `master_data_service`.`id`
                    ORDER BY `master_data_cost`.`type` ASC";

        return $this->db->query($query)->result_array();
    }

    public function editCost($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('master_data_cost', $data);
    }

    public function deleteCost($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_data_cost');
    }

    function get_service_by_type($type)
    {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get_where('master_data_service', ['type' => $type]);
        return $query;
    }

    function get_param_by_service($service_id)
    {
        $this->db->order_by('param1', 'ASC');
        $query = $this->db->get_where('master_data_cost', ['service_id' => $service_id]);
        return $query;
    }

    function get_fee($serv_id, $param1, $param2)
    {
        return $this->db->get_where('master_data_cost', ['service_id' => $serv_id, 'param1' => $param1, 'param2' => $param2]);
    }

    function get_fee_by_id($id)
    {
        return $this->db->get_where('master_data_cost', ['id' => $id]);
    }
}
