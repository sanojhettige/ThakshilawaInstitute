<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Lecturers extends Controller {

    public function index($param=null) {
        $this->data['title'] = "Lecturers";
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/datatables.min.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/datatables.min.js',
                BASE_URL.'/assets/js/datatables.js'
            )
        );
        $this->view->render("lecturers/index", "template", $this->data);
        clear_messages();
    }

    public function get_lecturers() {
        $data = array();
        $lecturers = array();
        $offset = get_post('start');
        $limit = get_post('length');
        $search = get_post('search')['value'];
        $lecturer_model = $this->model->load('lecturer');

        $res = $lecturer_model->getLecturers($limit,$offset, $search);
        $data["draw"] = get_post("draw");
        $data["recordsTotal"] = $res["count"];
        $data["recordsFiltered"] = $res["count"];
        
        $editable = is_permitted('lecturers-edit');
        $deletable = is_permitted('lecturers-delete');

        foreach($res["data"] as $index=>$item) {
            $lecturers[$index]['id'] = $item['id'];
            $lecturers[$index]['name'] = $item['name'];
            $lecturers[$index]['phone_number'] = $item['phone_number'];
            $lecturers[$index]['nic_no'] = $item['nic_no'];
            $lecturers[$index]['email_address'] = $item['email_address'];
            $lecturers[$index]['modified_at'] = $item['modified_at'];
            $lecturers[$index]['delete'] = $deletable;
            $lecturers[$index]['edit'] = $editable;
        }
        $data["data"] = $lecturers;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function add() {
        $this->data['record'] = array();
        $this->data['title'] = "Add lecturer";
        $lecturer_model = $this->model->load('lecturer');
        $class_model = $this->model->load('class');

        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/bootstrap-multiselect.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/bootstrap-multiselect.js'
            )
        );

        $res = $class_model->getClassess(100,0, '');
        $this->data['classess'] = $res['data'];

        if(get_post('submit')) {
            $this->createOrUpdateLecturer($lecturer_model);
        }
        $this->view->render("lecturers/lecturer_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update lecturer";
        $lecturer_model = $this->model->load('lecturer');
        $class_model = $this->model->load('class');
        $res = $class_model->getClassess(100,0, '');
        $this->data['classess'] = $res['data'];
        
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/bootstrap-multiselect.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/bootstrap-multiselect.js'
            )
        );
        if($id > 0) {
            $classess = $lecturer_model->getLectureClassess($id);
            $this->data['record'] = $lecturer_model->getLecturerById($id);
            $this->data['record']['class_id'] = $classess;
        }
        if(get_post('submit')) {
            $this->createOrUpdateLecturer($lecturer_model);
        }
        $this->view->render("lecturers/lecturer_form", "template", $this->data);
    }

    private function createOrUpdateLecturer($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("name"))) {
                $this->data['errors']["name"] = "Name is required";
            } elseif(empty(get_post("nic_no"))) {
                $this->data['errors']["nic_no"] = "Nic No is required";
            } elseif(empty(get_post("address"))) {
                $this->data['errors']["address"] = "Address is required";
            } elseif(empty(get_post("email_address"))) {
                $this->data['errors']["email_address"] = "Email address is required";
            } elseif(empty(get_post("phone"))) {
                $this->data['errors']["phone"] = "Phone Number is required";
            } elseif(!preg_match("/^[0]{1}[7]{1}[0-9]{8}$/", get_post("phone"))) {
                $this->data['errors']["phone"] = "Invalid phone number format (Ex: 07xxxxxxxx)";
            } else {
                $res = $model->createOrUpdateRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Lecturer Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    header("Location: ".BASE_URL."/lecturers");
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }


    public function delete($id=NULL) {
        $this->data['title'] = "Delete lecturer";
        $lecturer_model = $this->model->load('lecturer');
        if($id > 0) {
            $this->data['record'] = $lecturer_model->getLecturerById($id);
        }
        if(get_post('submit') && $this->data['record']) {
            $this->doDelete($lecturer_model, $id);
        }
        $this->data['canDelete'] = true;
        $this->view->render("lecturers/view_lecturer", "template", $this->data);
    }

    private function doDelete($model=null, $id=NULL) {
        try {
            $res = $model->deleteLecturerById($id);
            if($res) {
                $message = "Lecturer successfully deleted.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                header("Location: ".BASE_URL."/lecturers");
            } else {
                $this->data['error_message'] = "Unable to delete lecturer, please try again.";
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}