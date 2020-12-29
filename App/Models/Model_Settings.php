<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Settings extends Model {

    function getAppData() {
        $query = $this->db->prepare("SELECT * from app_settings where id=1");
        $query->execute(); 
        return $query->fetch();
    }

    function updateAppData($data=null) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        $sql = "UPDATE `app_settings` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `app_name`='".$data['app_name']."', `address`='".$data['address']."', `phone_number`= '".$data['phone_number']."' , `fax_number` = '".$data['fax_number']."', `email_address` = '".$data['email_address']."',  `active_season_id` = '".$data['active_season_id']."',  `currency_symbol` = '".$data['currency_symbol']."'  WHERE `id` = 1" ;
        return $this->db->exec($sql);
    }
}