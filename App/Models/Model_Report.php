<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Report extends Model {

    function totalTeachers() {
        $query = $this->db->prepare('select * from lecturers');
        $query->execute();
        return $query->rowCount();
    }

    function totalStudents() {
        $roleId = get_session('role_id');
        $refId = get_session('ref_id');

        $sql = "select s.id from students s";
        if($roleId === 6) {
            $sql .=" inner join student_classes sc on sc.student_id = s.id inner join classess c on c.id = sc.class_id where c.lecturer_id = $refId";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }

    function totalClassess() {
        $roleId = get_session('role_id');
        $refId = get_session('ref_id');

        $sql = 'select * from classess';

        if($roleId === 6) {
            $sql .=" where lecturer_id = $refId";
        }
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }

    function totalSubjects() {
        $roleId = get_session('role_id');
        $refId = get_session('ref_id');
        $sql = 'select s.id from subjects s';

        if($roleId === 6) {
            $sql .=" inner join classess c on c.subject_id = s.id where c.lecturer_id = $refId";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }

    function getIncome($date1=null, $date2=null) {
        //cafe income
        $sql ="select sum(amount) as total_amount from cafeteria_transactions where transaction_type = 2 and status = 1";
        $sql .=" and created_at between '".$date1." 00:00:01' and '".$date2." 23:59:59'"; 
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetch();
        $cafeInc = $data['total_amount'];

        //student income
        $sql2 ="select sum(paid_amount) as total_amount from class_payments where status = 1 ";
        $sql2 .=" and created_at between '".$date1." 00:00:01' and '".$date2." 23:59:59'"; 
        $query = $this->db->prepare($sql2);
        $query->execute();
        $data2 = $query->fetch();
        $stuInc = $data2['total_amount'];

        return ($cafeInc + $stuInc);

    }


    function getAttendance($date1=null, $date2=null) {
        $roleId = get_session('role_id');
        $refId = get_session('ref_id');
        
        $sql ="select count(att_date) as total from attendance where status = 1 ";
        $sql .=" and att_date between '".$date1."' and '".$date2."'"; 
        
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetch();
        $stuInc = $data['total'];

        return ($cafeInc + $stuInc);

    }    
}