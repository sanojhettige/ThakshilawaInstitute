<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Class extends Model {
    private $table = "classess";

    function getClassess($limit=20, $offset=0, $search=null) {
        $sql = "SELECT l.name as lecturer_name, s.subject_name, c.id,c.class_code,c.class_name,c.lecturer_id,c.subject_id,c.start_time,c.end_time,c.modified_at from ".$this->table." c ";

        $sql .=" left join lecturers l on l.id = c.lecturer_id";
        $sql .=" left join subjects s on s.id = c.subject_id";

        $sql .= " where c.status = 1 ";
        if($search) {
            $sql .=" and c.class_code like '%".$search."%' or c.class_name like '%".$search."%'";
        }

        $sql .=" order by c.modified_at desc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        $query->execute(array(":limit" => $limit));
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return array("count"=>$count, "data"=>$records);
    }

    function getClassById($id=null) {
        $query = $this->db->prepare("SELECT * from ".$this->table." where id='".$id."'");
        $query->execute(); 
        return $query->fetch();
    }

    function deleteClassById($id=NULL) {
        $date = date("Y-m-d h:i:s");
        $sql = "UPDATE `".$this->table."` SET `status`='4', `modified_at`= '".$date."'  WHERE `id` = ".$id ;
        return $this->db->exec($sql);
    } 

    function createOrUpdateRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `class_code`= '".$data['class_code']."' , `class_name` = '".$data['class_name']."' , `lecturer_id`= '".$data['lecturer_id']."', `subject_id`= '".$data['subject_id']."', `start_time` = '".$data['start_time']."', `end_time` = '".$data['end_time']."', `notes` = '".$data['notes']."'  WHERE `id` = ".$id ;
            return $this->db->exec($sql);
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (class_code,class_name,lecturer_id,subject_id,start_time,end_time,notes,created_by,created_at,modified_by,status) VALUES (:class_code, :class_name, :lecturer_id, :subject_id, :start_time, :end_time, :notes, :created_by, :created_at, :modified_by, :status)") ;
            return $stm->execute(array(
                ':class_code' => $data['class_code'], 
                ':class_name' => $data['class_name'], 
                ':lecturer_id' => $data['lecturer_id'],
                ':subject_id' => $data['subject_id'],
                ':start_time' => $data['start_time'],
                ':end_time' => $data['end_time'],
                ':notes' => $data['notes'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
        }
    }
}