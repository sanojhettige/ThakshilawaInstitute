<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Students extends Controller {

    public function index($param=null) {
        $this->data['title'] = "Students";
        $this->data['assets'] = array(
            'css'=>array(
                BASE_URL.'/assets/css/datatables.min.css'
            ),
            'js'=>array(
                BASE_URL.'/assets/js/datatables.min.js',
                BASE_URL.'/assets/js/datatables.js'
            )
        );
        $this->view->render("students/index", "template", $this->data);
        clear_messages();
    }

    public function get_students() {
        $data = array();
        $students = array();
        $offset = get_post('start');
        $limit = get_post('length');
        $search = get_post('search')['value'];
        $student_model = $this->model->load('student');

        $res = $student_model->getStudents($limit,$offset, $search);
        $data["draw"] = get_post("draw");
        $data["recordsTotal"] = $res["count"];
        $data["recordsFiltered"] = $res["count"];
        
        $editable = is_permitted('students-edit');
        $deletable = is_permitted('students-delete');

        foreach($res["data"] as $index=>$item) {
            $students[$index]['id'] = $item['id'];
            $students[$index]['name'] = $item['name'];
            $students[$index]['gurdian_name'] = $item['gurdian_name'];
            $students[$index]['modified_at'] = $item['modified_at'];
            $students[$index]['delete'] = $deletable;
            $students[$index]['edit'] = $editable;
        }
        $data["data"] = $students;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function add() {
        $this->data['record'] = array();
        $this->data['title'] = "Add student";
        $student_model = $this->model->load('student');
        if(get_post('submit')) {
            $this->createOrUpdateStudent($student_model);
        }
        $this->view->render("students/student_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update student";
        $student_model = $this->model->load('student');
        if($id > 0) {
            $this->data['record'] = $student_model->getStudentById($id);
        }
        if(get_post('submit')) {
            $this->createOrUpdateStudent($studentmodel);
        }
        $this->view->render("students/students_form", "template", $this->data);
    }

    private function createOrUpdateStudent($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("name"))) {
                $this->data['errors']["name"] = "Name is required";
            } elseif(empty(get_post("gurdian_name"))) {
                $this->data['errors']["gurdian_name"] = "Gurdian Name is required";
            } elseif(empty(get_post("address"))) {
                $this->data['errors']["address"] = "Address is required";
            } elseif(empty(get_post("gurdian_contact_number"))) {
                $this->data['errors']["gurdian_contact_number"] = "Phone Number is required";
            } elseif(!preg_match("/^[0]{1}[7]{1}[0-9]{8}$/", get_post("gurdian_contact_number"))) {
                $this->data['errors']["gurdian_contact_number"] = "Invalid phone number format (Ex: 07xxxxxxxx)";
            } else {
                $res = $model->createOrUpdateRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Student Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    header("Location: ".BASE_URL."/students");
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }


    public function delete($id=NULL) {
        $this->data['title'] = "Delete student";
        $student_model = $this->model->load('student');
        if($id > 0) {
            $this->data['record'] = $student_model->getStudentById($id);
        }
        if(get_post('submit') && $this->data['record']) {
            $this->doDelete($student_model, $id);
        }
        $this->data['canDelete'] = true;
        $this->view->render("students/view_student", "template", $this->data);
    }

    private function doDelete($model=null, $id=NULL) {
        try {
            $res = $model->deleteStudentById($id);
            if($res) {
                $message = "Student successfully deleted.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                header("Location: ".BASE_URL."/student");
            } else {
                $this->data['error_message'] = "Unable to delete subject, please try again.";
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}