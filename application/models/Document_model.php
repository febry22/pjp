<?php
class Document_model extends CI_Model
{
    public function getStnk($id, $role_id)
    {
        if ($role_id == 1 || $role_id == 4) {
            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` 
                    FROM `doc_stnk` JOIN `master_data_service` 
                    ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`delete_status` = 0
                    ORDER BY `doc_stnk`.`date_created` DESC";
        } elseif ($role_id == 2) {
            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` 
                    FROM `doc_stnk` JOIN `master_data_service` 
                    ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`created_by` = $id AND `doc_stnk`.`delete_status` = 0
                    ORDER BY `doc_stnk`.`date_created` DESC";
        }

        return $this->db->query($query)->result_array();
    }
}
