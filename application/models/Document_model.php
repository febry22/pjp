<?php
class Document_model extends CI_Model
{
    public function getStnk($id, $role_id)
    {
        if ($role_id == 1 || $role_id == 4) {
            // $this->db->from('doc_stnk');
            // $this->db->order_by('date_created', 'DESC');
            // $query = $this->db->get();

            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` 
                    FROM `doc_stnk` JOIN `master_data_service` 
                    ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    ORDER BY `doc_stnk`.`date_created` DESC";
        } elseif ($role_id == 2) {
            // $this->db->from('doc_stnk');
            // $this->db->where('created_by', $id);
            // $this->db->order_by('date_created', 'DESC');
            // $query = $this->db->get();

            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` 
                    FROM `doc_stnk` JOIN `master_data_service` 
                    ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`created_by` = $id
                    ORDER BY `doc_stnk`.`date_created` DESC";
        }

        return $this->db->query($query)->result_array();
    }
}
