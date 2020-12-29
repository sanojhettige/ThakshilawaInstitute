<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Student extends Model {
    private $table = "students";

    function getStudents($limit=20, $offset=0, $search=null) {
        $role = get_session('role_id');
        $refId = get_session('ref_id');
        
        $sql = "SELECT s.id,s.name,s.gurdian_name,s.gurdian_contact_number,s.modified_at,s.nic_no from ".$this->table." s ";

        if($role === 6) {
            $sql .=" inner join student_classes sc on sc.student_id = s.id inner join classess c on c.id = sc.class_id";
        }
        
        $sql .=" where s.status = 1";

        if($role === 6) {
            $sql .=" and c.lecturer_id = $refId";
        }

        if($search) {
            $sql .=" and s.name like '%".$search."%' or s.gurdian_name like '%".$search."%' or s.nic_no like '%".$search."%'";
        }

        $sql .=" order by s.modified_at desc";

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

    function getStudentClassess($id=null) {
        $query = $this->db->prepare("SELECT class_id from student_classes where student_id='".$id."'");
        $query->execute(); 
        $rows =  $query->fetchAll();
        $items = array();
        foreach($rows as $index=>$row) {
            $items[$index] = $row['class_id'];
        }
        return $items;
    }

    function deleteStudentById($id=NULL) {
        $date = date("Y-m-d h:i:s");
        $sql = "UPDATE `".$this->table."` SET `status`='4', `modified_at`= '".$date."'  WHERE `id` = ".$id ;
        return $this->db->exec($sql);
    } 

    function createOrUpdateRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        $respId = null;
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `name`= '".$data['name']."', `nic_no` = '".$data['nic_no']."', `address` = '".$data['address']."' , `gurdian_name` = '".$data['gurdian_name']."', `gurdian_contact_number`= '".$data['gurdian_contact_number']."'  WHERE `id` = ".$id ;
            $resp = $this->db->exec($sql);
            $respId = $resp ? $id : null;
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (name,nic_no,address,gurdian_name,gurdian_contact_number,created_by,created_at,modified_by,status) VALUES (:name, :nic_no, :address, :gurdian_name, :gurdian_contact_number, :created_by, :created_at, :modified_by, :status)") ;
            $resp =  $stm->execute(array(
                ':name' => $data['name'], 
                ':nic_no' => $data['nic_no'],
                ':address' => $data['address'], 
                ':gurdian_name' => $data['gurdian_name'],
                ':gurdian_contact_number' => $data['gurdian_contact_number'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
            $respId = $resp ? $this->db->lastInsertId() : null;
        }
        if($respId > 0) {
            return $this->assignClassess($respId, $data['class_id']);
        }
    }

    function assignClassess($id=NULL, $class_ids=null) {
        $sql = "DELETE FROM student_classes WHERE student_id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();

        $sql = "INSERT INTO student_classes (student_id,class_id) VALUES ";
        $n = 0;
        $query = array();
        $iData = array();

        foreach($class_ids as $index=>$class) {
            $query = '(:student_id' . $n . ', :class_id' . $n.')';

            $iData[$index]['student_id' . $n] = $id;
            $iData[$index]['class_id' . $n] = $class;

            $stmt = $this->db->prepare($sql." ".$query);
            $itemRows[$n] =  $stmt->execute($iData[$index]);
            $n += 1;
        }
        return $class_ids ? $n : true;
    }

    

    function getClassStudents($class_id=null) {
        $sql = "SELECT s.id,s.name from ".$this->table." s ";
        $sql .=" inner join student_classes sc on sc.student_id = s.id";
        
        $sql .=" where s.status = 1 and sc.class_id = ".$class_id;

        $sql .=" order by s.name desc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }


    function createOrUpdateFeeRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        $data['year_month_id'] = $data['year_id'].$data['month_id'];
        $respId = null;
        if($id > 0) {
            $sql = "UPDATE `class_payments` SET `student_id`='".$data['student_id']."', `modified_at`= '".$date."', `modified_by`='".$user_id."', `year_month_id`= '".$data['year_month_id']."' , `class_id` = '".$data['class_id']."' , `paid_amount` = '".$data['paid_amount']."', `notes`= '".$data['notes']."'  WHERE `id` = ".$id ;
            $resp = $this->db->exec($sql);
            $respId = $resp ? $id : null;
        } else {
            $stm = $this->db->prepare("INSERT INTO class_payments (student_id,class_id,year_month_id,paid_amount,notes,created_by,created_at,modified_by,status) VALUES (:student_id,:class_id, :year_month_id, :paid_amount, :notes, :created_by, :created_at, :modified_by, :status)") ;
            $resp =  $stm->execute(array(
                ':student_id' => $data['student_id'],
                ':class_id' => $data['class_id'], 
                ':year_month_id' => $data['year_month_id'], 
                ':paid_amount' => $data['paid_amount'],
                ':notes' => $data['notes'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
            $respId = $resp ? $this->db->lastInsertId() : null;
        }
        return $respId;
    }

    function isMonthlyPaymentSettled($year, $month, $class_id, $student_id) {
        $monthId = $year.$month;
        $query = $this->db->prepare("SELECT * from `class_payments` where student_id=".$student_id." and class_id = ".$class_id." and year_month_id = ".$monthId);
        $query->execute(); 
        return $query->fetch();
    }


    function createOrUpdateAttendanceRecord($data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        $data['year_month_date'] = date("Y-m-d", strtotime($data['year'].'-'.$data['month'].'-'.$data['date']));
        $respId = null;
        $row = $this->getAttendanceByDate($data['year_month_date'], $data['student_id'], $data['class_id']);
        if($row) {
            $sql = "UPDATE `attendance` SET `student_id`='".$data['student_id']."', `modified_at`= '".$date."', `modified_by`='".$user_id."', `att_date`= '".$data['year_month_date']."', `att_status`='".$data['att_status']."', `class_id` = '".$data['class_id']."' WHERE `id` = ".$row['id'] ;
            $resp = $this->db->exec($sql);
            $respId = $resp ? $row['id'] : null;
        } else {
            // echo "A"; exit;
            $stm = $this->db->prepare("INSERT INTO attendance (student_id,class_id,att_date, att_status, created_by,created_at,modified_by,status) VALUES (:student_id,:class_id, :att_date, :att_status, :created_by, :created_at, :modified_by, :status)") ;
            $resp =  $stm->execute(array(
                ':student_id' => $data['student_id'],
                ':class_id' => $data['class_id'], 
                ':att_date' => $data['year_month_date'], 
                ':att_status' => $data['att_status'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
            $respId = $resp ? $this->db->lastInsertId() : null;
        }
        return $respId;
    }

    function getAttendanceByDate($date, $student_id, $class_id) {
        $query = $this->db->prepare("SELECT * from `attendance` where student_id=".$student_id." and class_id = ".$class_id." and att_date = '".$date."'");
        $query->execute(); 
        return $query->fetch();
    }

    function getMonthlyAttendance($year, $month, $class_id) {
        $date1 = date("Y-m-01",strtotime($year.'-'.$month.'-01'));
        $date2 = date("Y-m-31",strtotime($year.'-'.$month.'-31'));
        $query = $this->db->prepare("SELECT student_id, att_date from `attendance` where class_id = ".$class_id." and att_date between '".$date1."' and '".$date2."' and att_status = 1");
        $query->execute(); 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getMonthlyAttendanceReport($year, $month, $class_id) {
        $date1 = date("Y-m-01",strtotime($year.'-'.$month.'-01'));
        $date2 = date("Y-m-31",strtotime($year.'-'.$month.'-31'));

        $sql = "SELECT s.name, a.att_date from `attendance` a ";
        $sql .="inner join students s on s.id = a.student_id ";
        
        $sql .="where a.att_date between '".$date1."' and '".$date2."' and a.att_status = 1";
        
        if($class_id > 0 ) {
            $sql .=" and a.class_id = ".$class_id;
        }
        $query = $this->db->prepare($sql);
        $query->execute(); 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}