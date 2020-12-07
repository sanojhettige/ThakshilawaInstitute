<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Student extends Model {
    private $table = "students";

    function getStudents($limit=20, $offset=0, $search=null) {
        $sql = "SELECT id,name,gurdian_name,gurdian_contact_number,modified_at from ".$this->table." where status = 1";

        if($search) {
            $sql .=" and name like '%".$search."%' or gurdian_name like '%".$search."%'";
        }

        $sql .=" order by modified_at desc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        $query->execute(array(":limit" => $limit));
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return array("count"=>$count, "data"=>$records);
    }

    function getStudentById($id=null) {
        $query = $this->db->prepare("SELECT * from ".$this->table." where id='".$id."'");
        $query->execute(); 
        return $query->fetch();
    }

    function deleteStudentById($id=NULL) {
        $date = date("Y-m-d h:i:s");
        $sql = "UPDATE `".$this->table."` SET `status`='4', `modified_at`= '".$date."'  WHERE `id` = ".$id ;
        return $this->db->exec($sql);
    } 

    function createOrUpdateRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `name`= '".$data['name']."' , `address` = '".$data['address']."' , `gurdian_name` = '".$data['gurdian_name']."', `gurdian_contact_number`= '".$data['gurdian_contact_number']."'  WHERE `id` = ".$id ;
            return $this->db->exec($sql);
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (name,address,gurdian_name,gurdian_contact_number,created_by,created_at,modified_by,status) VALUES (:name, :address, :gurdian_name, :gurdian_contact_number, :created_by, :created_at, :modified_by, :status)") ;
            return $stm->execute(array(
                ':name' => $data['name'], 
                ':address' => $data['address'], 
                ':gurdian_name' => $data['gurdian_name'],
                ':gurdian_contact_number' => $data['gurdian_contact_number'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
        }
    }
}