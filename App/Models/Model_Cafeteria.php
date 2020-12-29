<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Model_Cafeteria extends Model {
    private $table = "cafeteria_transactions";

    function getTransactions($limit=20, $offset=0, $search=null) {
        $sql = "SELECT id,title,amount,description,modified_at, transaction_type from ".$this->table." where status = 1";

        if($search) {
            $sql .=" and title like '%".$search."%' or amount like '%".$search."%' or description like '%".$search."%'";
        }

        $sql .=" order by modified_at desc";

        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->rowCount();
        $query->execute(array(":limit" => $limit));
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return array("count"=>$count, "data"=>$records);
    }

    function getTransactionById($id=null) {
        $query = $this->db->prepare("SELECT * from ".$this->table." where id='".$id."'");
        $query->execute(); 
        return $query->fetch();
    }

    function deleteTransactionById($id=NULL) {
        $date = date("Y-m-d h:i:s");
        $sql = "UPDATE `".$this->table."` SET `status`='4', `modified_at`= '".$date."'  WHERE `id` = ".$id ;
        return $this->db->exec($sql);
    } 

    function createOrUpdateRecord($id=NULL, $data=[]) {
        $date = date("Y-m-d h:i:s");
        $user_id  = get_session('user_id');
        if($id > 0) {
            $sql = "UPDATE `".$this->table."` SET `modified_at`= '".$date."', `modified_by`='".$user_id."', `title`= '".$data['title']."' , `amount` = '".$data['amount']."' , `description` = '".$data['description']."', `transaction_type` = '".$data['transaction_type']."'  WHERE `id` = ".$id ;
            return $this->db->exec($sql);
        } else {
            $stm = $this->db->prepare("INSERT INTO ".$this->table." (title,amount,description,transaction_type,created_by,created_at,modified_by,status) VALUES (:title, :amount, :description, :transaction_type, :created_by, :created_at, :modified_by, :status)") ;
            return $stm->execute(array(
                ':title' => $data['title'], 
                ':amount' => $data['amount'], 
                ':description' => $data['description'], 
                ':transaction_type' => $data['transaction_type'],
                ':created_by' => $user_id,
                ':created_at' => $date,
                ':modified_by' => $user_id,
                ':status' => 1
            ));
        }
    }

    function getTransactionReport($year=null, $month=null) {
        $year = $year ? $year : date("Y");
        $month = $month ? $month : date("m");
        $date1 = date("Y-m-01 00:00:01",strtotime($year.'-'.$month.'-01'));
        $date2 = date("Y-m-t 23:59:59",strtotime($year.'-'.$month.'-30'));
        
        $sql = "SELECT created_at,id,title,amount,description,modified_at, transaction_type from ".$this->table." where status = 1";

        $sql .=" and created_at  between '".$date1."' and '".$date2."'";
        $sql .=" order by created_at asc";
// echo $month; exit;
        $query = $this->db->prepare($sql);
        $query->execute();
        $records = $query->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }
    
}