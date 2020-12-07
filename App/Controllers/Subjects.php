<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Subjects extends Controller {

    public function index($param=null) {
        $this->data['title'] = "Subjects";
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/datatables.min.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/datatables.min.js',
                BASE_URL.'/assets/js/datatables.js'
            )
        );
        $this->view->render("subjects/index", "template", $this->data);
        clear_messages();
    }

    public function get_subjects() {
        $data = array();
        $subjects = array();
        $offset = get_post('start');
        $limit = get_post('length');
        $search = get_post('search')['value'];
        $subject_model = $this->model->load('subject');

        $res = $subject_model->getSubjects($limit,$offset, $search);
        $data["draw"] = get_post("draw");
        $data["recordsTotal"] = $res["count"];
        $data["recordsFiltered"] = $res["count"];
        
        $editable = is_permitted('subjects-edit');
        $deletable = is_permitted('subjects-delete');

        foreach($res["data"] as $index=>$item) {
            $subjects[$index]['id'] = $item['id'];
            $subjects[$index]['name'] = $item['subject_name'];
            $subjects[$index]['code'] = $item['subject_code'];
            $subjects[$index]['modified_at'] = $item['modified_at'];
            $subjects[$index]['delete'] = $deletable;
            $subjects[$index]['edit'] = $editable;
        }
        $data["data"] = $subjects;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function add() {
        $this->data['record'] = array();
        $this->data['title'] = "Add subject";
        $subject_model = $this->model->load('subject');
        if(get_post('submit')) {
            $this->createOrUpdateSubject($subject_model);
        }
        $this->view->render("subjects/subject_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update subject";
        $subject_model = $this->model->load('subject');
        if($id > 0) {
            $this->data['record'] = $subject_model->getSubjectById($id);
        }
        if(get_post('submit')) {
            $this->createOrUpdateSubject($subject_model);
        }
        $this->view->render("subjects/subject_form", "template", $this->data);
    }

    private function createOrUpdateSubject($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("name"))) {
                $this->data['errors']["name"] = "Name is required";
            } elseif(empty(get_post("code"))) {
                $this->data['errors']["code"] = "Code is required";
            } else {
                $res = $model->createOrUpdateRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Subject Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    header("Location: ".BASE_URL."/subjects");
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }


    public function delete($id=NULL) {
        $this->data['title'] = "Delete subject";
        $subject_model = $this->model->load('subject');
        if($id > 0) {
            $this->data['record'] = $subject_model->getSubjectById($id);
        }
        if(get_post('submit') && $this->data['record']) {
            $this->doDelete($subject_model, $id);
        }
        $this->data['canDelete'] = true;
        $this->view->render("subjects/view_subject", "template", $this->data);
    }

    private function doDelete($model=null, $id=NULL) {
        try {
            $res = $model->deleteSubjectById($id);
            if($res) {
                $message = "Subject successfully deleted.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                header("Location: ".BASE_URL."/subjects");
            } else {
                $this->data['error_message'] = "Unable to delete subject, please try again.";
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}