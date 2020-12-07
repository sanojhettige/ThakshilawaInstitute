<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Classess extends Controller {

    public function index($param=null) {
        $this->data['title'] = "Classes";
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/datatables.min.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/datatables.min.js',
                BASE_URL.'/assets/js/datatables.js'
            )
        );
        $this->view->render("classess/index", "template", $this->data);
        clear_messages();
    }

    public function get_classess() {
        $data = array();
        $classess = array();
        $offset = get_post('start');
        $limit = get_post('length');
        $search = get_post('search')['value'];
        $class_model = $this->model->load('class');

        $res = $class_model->getClassess($limit,$offset, $search);
        $data["draw"] = get_post("draw");
        $data["recordsTotal"] = $res["count"];
        $data["recordsFiltered"] = $res["count"];
        
        $editable = is_permitted('classess-edit');
        $deletable = is_permitted('classess-delete');

        foreach($res["data"] as $index=>$item) {
            $classess[$index]['id'] = $item['id'];
            $classess[$index]['lecturer_name'] = $item['lecturer_name'];
            $classess[$index]['subject_name'] = $item['subject_name'];
            $classess[$index]['class_code'] = $item['class_code'];
            $classess[$index]['class_name'] = $item['class_name'];
            $classess[$index]['start_time'] = $item['start_time'];
            $classess[$index]['modified_at'] = $item['modified_at'];
            $classess[$index]['delete'] = $deletable;
            $classess[$index]['edit'] = $editable;
        }
        $data["data"] = $classess;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function add() {
        $this->data['record'] = array();
        $this->data['title'] = "Add class";
        $class_model = $this->model->load('class');
        $lecturer_model = $this->model->load('lecturer');
        $subject_model = $this->model->load('subject');

        $this->data['lecturers'] = $lecturer_model->getLecturers()['data'];
        $this->data['subjects'] = $subject_model->getSubjects()['data'];
        if(get_post('submit')) {
            $this->createOrUpdateClass($class_model);
        }
        $this->view->render("classess/class_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update class";
        $class_model = $this->model->load('class');
        if($id > 0) {
            $this->data['record'] = $class_model->getClassById($id);
        }
        if(get_post('submit')) {
            $this->createOrUpdateClass($class_model);
        }

        $lecturer_model = $this->model->load('lecturer');
        $subject_model = $this->model->load('subject');

        $this->data['lecturers'] = $lecturer_model->getLecturers()['data'];
        $this->data['subjects'] = $subject_model->getSubjects()['data'];

        $this->view->render("classess/class_form", "template", $this->data);
    }

    private function createOrUpdateClass($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("class_code"))) {
                $this->data['errors']["class_code"] = "Class Code is required";
            } elseif(empty(get_post("class_name"))) {
                $this->data['errors']["class_name"] = "Class Name is required";
            } elseif(empty(get_post("lecturer_id"))) {
                $this->data['errors']["lecturer_id"] = "Lecturer is required";
            } elseif(empty(get_post("subject_id"))) {
                $this->data['errors']["subject_id"] = "Subject Name is required";
            } elseif(empty(get_post("start_time"))) {
                $this->data['errors']["start_time"] = "Class Start Time is required";
            } elseif(empty(get_post("end_time"))) {
                $this->data['errors']["end_time"] = "Class End Time is required";
            } else {
                $res = $model->createOrUpdateRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Class Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    header("Location: ".BASE_URL."/classess");
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }


    public function delete($id=NULL) {
        $this->data['title'] = "Delete class";
        $class_model = $this->model->load('Classe');
        if($id > 0) {
            $this->data['record'] = $class_model->getClassById($id);
        }
        if(get_post('submit') && $this->data['record']) {
            $this->doDelete($class_model, $id);
        }
        $this->data['canDelete'] = true;
        $this->view->render("classess/view_class", "template", $this->data);
    }

    private function doDelete($model=null, $id=NULL) {
        try {
            $res = $model->deleteClassById($id);
            if($res) {
                $message = "Class successfully deleted.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                header("Location: ".BASE_URL."/classess");
            } else {
                $this->data['error_message'] = "Unable to delete Classe, please try again.";
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}