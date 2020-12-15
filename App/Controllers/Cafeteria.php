<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Cafeteria extends Controller {

    public function index($param=null) {
        $this->data['title'] = "Cafeteria";
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/datatables.min.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/datatables.min.js',
                BASE_URL.'/assets/js/datatables.js'
            )
        );
        $this->view->render("cafeteria/index", "template", $this->data);
        clear_messages();
    }

    public function get_transactions() {
        $data = array();
        $transactions = array();
        $offset = get_post('start');
        $limit = get_post('length');
        $search = get_post('search')['value'];
        $cafeteria_model = $this->model->load('cafeteria');

        $res = $cafeteria_model->getTransactions($limit,$offset, $search);
        $data["draw"] = get_post("draw");
        $data["recordsTotal"] = $res["count"];
        $data["recordsFiltered"] = $res["count"];
        
        $editable = is_permitted('lecturers-edit');
        $deletable = is_permitted('lecturers-delete');

        foreach($res["data"] as $index=>$item) {
            $transactions[$index]['id'] = $item['id'];
            $transactions[$index]['title'] = $item['title'];
            $transactions[$index]['type'] = $item['transaction_type'] == 1 ? 'Expense' : "Income";
            $transactions[$index]['amount'] = $item['amount'];
            $transactions[$index]['modified_at'] = $item['modified_at'];
            $transactions[$index]['delete'] = $deletable;
            $transactions[$index]['edit'] = $editable;
        }
        $data["data"] = $transactions;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function expense() {
        $this->data['record'] = array();
        $this->data['title'] = "Add Transaction";
        $cafeteria_model = $this->model->load('cafeteria');
        if(get_post('submit')) {
            $this->createOrUpdateTransaction($cafeteria_model, 1);
        }
        $this->view->render("cafeteria/transaction_form", "template", $this->data);
    }

    public function income() {
        $this->data['record'] = array();
        $this->data['title'] = "Add Transaction";
        $cafeteria_model = $this->model->load('cafeteria');
        if(get_post('submit')) {
            $this->createOrUpdateTransaction($cafeteria_model, 2);
        }
        $this->view->render("cafeteria/transaction_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update Transaction";
        $cafeteria_model = $this->model->load('cafeteria');
        if($id > 0) {
            $this->data['record'] = $cafeteria_model->getTransactionById($id);
        }
        if(get_post('submit')) {
            $this->createOrUpdateTransaction($cafeteria_model, $this->data['record']['transaction_type']);
        }
        $this->view->render("cafeteria/transaction_form", "template", $this->data);
    }

    private function createOrUpdateTransaction($model=null, $type=1) {
        $this->data['errors'] = array();
        $_POST['transaction_type'] = $type;
        try {
            if(empty(get_post("title"))) {
                $this->data['errors']["title"] = "title is required";
            } elseif(empty(get_post("amount"))) {
                $this->data['errors']["amount"] = "Amount is required";
            } else {
                $res = $model->createOrUpdateRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Transaction Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    header("Location: ".BASE_URL."/cafeteria");
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }


    public function delete($id=NULL) {
        $this->data['title'] = "Delete cafeteria";
        $cafeteria_model = $this->model->load('cafeteria');
        if($id > 0) {
            $this->data['record'] = $cafeteria_model->getTransactionById($id);
        }
        if(get_post('submit') && $this->data['record']) {
            $this->doDelete($cafeteria_model, $id);
        }
        $this->data['canDelete'] = true;
        $this->view->render("cafeteria/view_transaction", "template", $this->data);
    }

    private function doDelete($model=null, $id=NULL) {
        try {
            $res = $model->deleteTransactionById($id);
            if($res) {
                $message = "Transaction successfully deleted.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                header("Location: ".BASE_URL."/cafeteria");
            } else {
                $this->data['error_message'] = "Unable to delete lecturer, please try again.";
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}