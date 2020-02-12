<?php
class Document_model extends CI_Model
{
    function get_next_id_stnk()
    {
        $query = $this->db->query("SELECT MAX(RIGHT(doc_id,3)) as max FROM doc_stnk WHERE DATE(from_unixtime(date_modified)) = CURDATE()");
        $kd = "";
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $k) {
                $tmp = ((int) $k->max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }

        return $kd;
    }

    public function getStnk($id, $role_id, $partner_id)
    {
        if ($role_id == 1) {
            // $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name`,`master_data_partner`.`partner_name` FROM `doc_stnk` 
            //         JOIN `master_data_service` ON `doc_stnk`.`service_id` = `master_data_service`.`id`
            //         JOIN `master_data_partner` ON `doc_stnk`.`partner_id` = `master_data_partner`.`id`
            //         WHERE `doc_stnk`.`delete_status` = 0
            //         ORDER BY `doc_stnk`.`date_created` DESC";

            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` FROM `doc_stnk` 
                    JOIN `master_data_service` ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`delete_status` = 0
                    ORDER BY `doc_stnk`.`date_created` DESC";
        } elseif ($role_id == 4) {
            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` FROM `doc_stnk` 
                    JOIN `master_data_service` ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`partner_id` = $partner_id AND `doc_stnk`.`delete_status` = 0
                    ORDER BY `doc_stnk`.`date_created` DESC";
        } elseif ($role_id == 2) {
            $query = "SELECT `doc_stnk`.* ,`master_data_service`.`name` FROM `doc_stnk` 
                    JOIN `master_data_service` ON `doc_stnk`.`service_id` = `master_data_service`.`id`
                    WHERE `doc_stnk`.`created_by` = $id AND `doc_stnk`.`delete_status` = 0
                    ORDER BY `doc_stnk`.`date_created` DESC";
        }

        return $this->db->query($query)->result_array();
    }

    public function getDetailStnk($id)
    {
        $this->db->from('doc_stnk');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteStnk($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('doc_stnk', $data);
    }
}
