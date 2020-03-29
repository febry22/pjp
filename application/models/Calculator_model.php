<?php
class Calculator_model extends CI_Model
{
    public function getLog($id, $role_id)
    {
        if ($role_id == 1) {
            $query = "SELECT `calculator_log`.* ,`master_data_service`.`name`,`master_data_cost`.`param1`,`master_data_cost`.`param2` FROM `calculator_log` 
                    JOIN `master_data_service` ON `calculator_log`.`service_id` = `master_data_service`.`id`
                    JOIN `master_data_cost` ON `calculator_log`.`cost_id` = `master_data_cost`.`id`
                    ORDER BY `calculator_log`.`created_at` DESC";
        } else{
            $query = "SELECT `calculator_log`.* ,`master_data_service`.`name`,`master_data_cost`.`param1`,`master_data_cost`.`param2` FROM `calculator_log` 
                    JOIN `master_data_service` ON `calculator_log`.`service_id` = `master_data_service`.`id`
                    JOIN `master_data_cost` ON `calculator_log`.`cost_id` = `master_data_cost`.`id`
                    WHERE `calculator_log`.`created_by` = $id
                    ORDER BY `calculator_log`.`created_at` DESC";
        }

        return $this->db->query($query)->result_array();
    }

    public function FunctionName($data)
    {
        
    }
}