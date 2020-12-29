<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Class extends Model {
    private $table = "classess";

    function getClassess($limit=20, $offset=0, $search=null) {
        $role = get_session('role_id');
        $refId = get_session('ref_id');
        
        $sql = "SELECT l.name as lecturer_name, s.subject_name, c.id,c.class_code,c.class_name,c.lecturer_id,c.subject_id,c.start_time,c.end_time,c.modified_at from ".$this->table." c ";

        $sql .=" left join lecturers l on l.id = c.lecturer_id";
        $sql .=" left join subjects s on s.id = c.subject_id";

        $sql .= " where c.status = 1 ";
        if($search) {
            $sql .=" and c.class_code like '%".$search."%' or c.class_name like '%".$search."%'";
        }

        if($role === 6) {
            $sql .=" and l.id = $refId";
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
        $respId = null;
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `is_closed`='".$data['is_closed']."', `modified_at`= '".$date."', `modified_by`='".$user_id."', `class_code`= '".$data['class_code']."' , `class_name` = '".$data['class_name']."' , `lecturer_id`= '".$data['lecturer_id']."', `subject_id`= '".$data['subject_id']."', `start_time` = '".$data['start_time']."', `end_time` = '".$data['end_time']."', `monthly_fee` = '".$data['monthly_fee']."', `notes` = '".$data['notes']."'  WHERE `id` = ".$id ;
            $resp =  $this->db->exec($sql);
            $respId = $resp ? $id : null;
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (class_code,class_name,lecturer_id,is_closed,subject_id,start_time,end_time, monthly_fee, notes,created_by,created_at,modified_by,status) VALUES (:class_code, :class_name, :lecturer_id, :is_closed, :subject_id, :start_time, :end_time, :monthly_fee, :notes, :created_by, :created_at, :modified_by, :status)") ;
            $resp = $stm->execute(array(
                ':class_code' => $data['class_code'], 
                ':class_name' => $data['class_name'], 
                ':lecturer_id' => $data['lecturer_id'],
                ':is_closed' => $data['is_closed'],
                ':subject_id' => $data['subject_id'],
                ':start_time' => $data['start_time'],
                ':end_time' => $data['end_time'],
                ':monthly_fee' => $data['monthly_fee'],
                ':notes' => $data['notes'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
            $respId = $resp ? $this->db->lastInsertId() : null;
        }

        if($respId > 0) {
            return $this->assignClassessDays($respId, $data['day_id']);
        }
    }

    function assignClassessDays($id=NULL, $day_ids=null) {
        $sql = "DELETE FROM class_days WHERE class_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();

        $sql = "INSERT INTO class_days (class_id,day_id) VALUES ";
        $n = 0;
        $query = array();
        $iData = array();

        foreach($day_ids as $index=>$day) {
            $query = '(:class_id' . $n . ', :day_id' . $n.')';

            $iData[$index]['class_id' . $n] = $id;
            $iData[$index]['day_id' . $n] = $day;

            $stmt = $this->db->prepare($sql." ".$query);
            $itemRows[$n] =  $stmt->execute($iData[$index]);
            $n += 1;
        }
        return $day_ids ? $n : true;
    }

    function getClassDays($id=null) {
        $query = $this->db->prepare("SELECT day_id from class_days where class_id='".$id."'");
        $query->execute(); 
        $rows =  $query->fetchAll();
        $items = array();
        foreach($rows as $index=>$row) {
            $items[$index] = $row['day_id'];
        }
        return $items;
    }

    function getClassSchedule($class_id=null) {
        $sql = "SELECT cd.day_id,l.name as lecturer_name, s.subject_name, c.id,c.class_code,c.class_name,c.lecturer_id,c.subject_id,c.start_time,c.end_time,c.modified_at from class_days cd ";
        $sql .=" inner join ".$this->table." c on c.id = cd.class_id";
        $sql .=" left join lecturers l on l.id = c.lecturer_id";
        $sql .=" left join subjects s on s.id = c.subject_id"; 
        
        $sql .= " where c.status = 1 ";

        if($class_id > 0) {
            $sql .=" and cd.class_id = ".$class_id;
        }

        $sql .=" order by c.class_name asc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }
    

    function isClassOpened($ids=null) {
        $idList = implode(",", $ids);
        $sql = "SELECT class_name, is_closed from ".$this->table;
        $name = null;
        $sql .= " where status = 1 and id in($idList)";
        $query = $this->db->prepare($sql);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($records as $index=>$row) {
            if($row['is_closed'] === 1) {
                return $row['class_name'];
            }
        }
        return $name;
    }
}