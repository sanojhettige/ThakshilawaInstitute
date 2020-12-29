<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Lecturer extends Model {
    private $table = "lecturers";

    function getLecturers($limit=20, $offset=0, $search=null) {
        $sql = "SELECT id,name,phone_number,address,modified_at,email_address, nic_no from ".$this->table." where status = 1";

        if($search) {
            $sql .=" and name like '%".$search."%' or nic_no like '%".$search."%' or email_address like '%".$search."%'";
        }

        $sql .=" order by modified_at desc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        $query->execute(array(":limit" => $limit));
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return array("count"=>$count, "data"=>$records);
    }

    function getLecturerById($id=null) {
        $query = $this->db->prepare("SELECT * from ".$this->table." where id='".$id."'");
        $query->execute(); 
        return $query->fetch();
    }

    function getLectureClassess($id=null) {
        $query = $this->db->prepare("SELECT class_id from lecturer_classes where lecturer_id='".$id."'");
        $query->execute(); 
        $rows =  $query->fetchAll();
        $items = array();
        foreach($rows as $index=>$row) {
            $items[$index] = $row['class_id'];
        }
        return $items;
    }

    function deleteLecturerById($id=NULL) {
        $date = date("Y-m-d h:i:s");
        $sql = "UPDATE `".$this->table."` SET `status`='4', `modified_at`= '".$date."'  WHERE `id` = ".$id ;
        return $this->db->exec($sql);
    } 

    function createOrUpdateRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        $respId = null;
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `name`= '".$data['name']."' , `address` = '".$data['address']."' , `email_address` = '".$data['email_address']."', `phone_number` = '".$data['phone']."', `nic_no`='".$data['nic_no']."'  WHERE `id` = ".$id ;
            $resp = $this->db->exec($sql);
            $respId = $resp ? $id : null;
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (name,address,email_address,phone_number,nic_no,created_by,created_at,modified_by,status) VALUES (:name, :address, :email_address, :phone_number, :nic_no, :created_by, :created_at, :modified_by, :status)") ;
            $resp =  $stm->execute(array(
                ':name' => $data['name'], 
                ':address' => $data['address'], 
                ':email_address' => $data['email_address'], 
                ':phone_number' => $data['phone'],
                ':nic_no' => $data['nic_no'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
            $respId = $resp ? $this->db->lastInsertId() : null;
        }
        if($respId > 0) {
            $this->createOrUpdateUserAccount($respId, $data);
            return $this->assignClassess($respId, $data['class_id']);
        }
    }

    function assignClassess($id=NULL, $class_ids=null) {
        $sql = "DELETE FROM lecturer_classes WHERE lecturer_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();

        $sql = "INSERT INTO lecturer_classes (lecturer_id,class_id) VALUES ";
        $n = 0;
        $query = array();
        $iData = array();

        foreach($class_ids as $index=>$class) {
            $query = '(:lecturer_id' . $n . ', :class_id' . $n.')';

            $iData[$index]['lecturer_id' . $n] = $id;
            $iData[$index]['class_id' . $n] = $class;

            $stmt = $this->db->prepare($sql." ".$query);
            $itemRows[$n] =  $stmt->execute($iData[$index]);
            $n += 1;
        }
        return $class_ids ? $n : true;
    }

    function createOrUpdateUserAccount($lId=null, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');

        $query = $this->db->prepare("SELECT * from `users` where  `reference_id` = ".$lId." and `role_id` = '6'");
        $query->execute(); 
        $user =  $query->fetch();

        $password = password_encrypt(123);
        if($user['id'] > 0) {
            $sql = "UPDATE `users` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `name`= '".$data['name']."' , `email` = '".$data['email_address']."'  WHERE `id` = ".$user['id'] ;
            return $this->db->exec($sql);
        } else {
            $stm = $this->db->prepare("INSERT INTO users (name,email,reference_id,role_id,password,reset_pin,created_by,created_at,modified_by,status) VALUES (:name, :email, :reference_id, :role_id, :password, :reset_pin, :created_by, :created_at, :modified_by, :status)") ;
            return $stm->execute(array(
                ':name' => $data['name'], 
                ':email' => $data['email_address'],
                ':reference_id' => $lId,
                ':role_id' => 6, 
                ':password' => $password,
                ':reset_pin' => rand(1111,9999),
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
        }
    }
}