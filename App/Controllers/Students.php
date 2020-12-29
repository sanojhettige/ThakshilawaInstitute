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
        $payment = is_permitted('students-payment');

        foreach($res["data"] as $index=>$item) {
            $students[$index]['id'] = $item['id'];
            $students[$index]['name'] = $item['name'];
            $students[$index]['nic_no'] = $item['nic_no'];
            $students[$index]['gurdian_name'] = $item['gurdian_name'];
            $students[$index]['modified_at'] = $item['modified_at'];
            $students[$index]['delete'] = $deletable;
            $students[$index]['edit'] = $editable;
            $students[$index]['payment'] = $payment;
        }
        $data["data"] = $students;

        $data['search'] = $search;
        echo json_encode($data);
    }

    public function add() {
        $this->data['record'] = array();
        $this->data['title'] = "Add student";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        if(get_post('submit')) {
            $this->createOrUpdateStudent($student_model);
        }

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
        
        $this->view->render("students/student_form", "template", $this->data);
    }

    public function edit($id=null) {
        $this->data['title'] = "Update student";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        
        if($id > 0) {
            $classess = $student_model->getStudentClassess($id);
            $this->data['record'] = $student_model->getStudentById($id);
            $this->data['record']['class_id'] = $classess;
        }
        if(get_post('submit')) {
            $this->createOrUpdateStudent($student_model);
        }

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

        $this->view->render("students/student_form", "template", $this->data);
    }

    private function createOrUpdateStudent($model=null) {
        $class_model = $this->model->load('class');
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
            } elseif($class = $class_model->isClassOpened(get_post("class_id"))) {
                $this->data['errors']["class_id"] = "Class '$class' is closed for new registrations.";
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


    public function attendance() {
        $this->data['title'] = "Student Attendance";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        $this->data['students'] = array();
        $this->data['start_date'] = 1;
        $this->data['end_date'] = 0;
        $this->data['show_att'] = false;
        $this->data['today'] = date('d');
        $r = 0;
        $this->data['months'] = months();

        $this->data['years'] = array();

        for($i=2019; $i<=date('Y'); $i++) {
            $this->data['years'][$r]['id'] = $i;
            $this->data['years'][$r]['title'] = $i;
            $r++;
        }
        

        $res = $class_model->getClassess(100,0, '');

        $this->data['classess'] = $res['data'];

        if(get_post('submit')) {
            $this->data['students'] = $this->getClassStudents($student_model, get_post('class_id'));
            $this->data['show_att'] = true;
            $attendance = $student_model->getMonthlyAttendance(get_post('year_id'), get_post('month_id'), get_post('class_id'));
            $att_arr = array();
            foreach($attendance as $index=>$row) {
                $att_arr[$row['student_id']][$row['att_date']] = true;
            }
            $this->data['attendance'] = $att_arr;
        }

        if(get_post('mark_attendance')) {
            $this->updateAttendance($student_model);
        }
        

        if(get_post('year_id') && get_post('month_id')) {
            $this->data['end_date'] = date('t', strtotime(get_post('year_id').'-'.get_post('month_id')));
        }

        $this->view->render("students/mark_attendance", "template", $this->data);
    }

    private function getClassStudents($model=null, $class_id=null) {
        return $model->getClassStudents($class_id);
    }


    public function payment($id=null) {
        $this->data['title'] = "Add Payment";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        $this->data['student'] = array();
        $this->data['record'] = array();
        
        if($id > 0) {
            $classess = $student_model->getStudentClassess($id);
            $this->data['student'] = $student_model->getStudentById($id);
            $this->data['student']['class_id'] = $classess;
        }
        if(get_post('submit')) {
            $this->createOrUpdateClassFee($student_model);
        }

        if(get_post('submit2')) {
            $isPaid = $student_model->isMonthlyPaymentSettled(get_post("year_id"), get_post("month_id"), get_post("class_id"), get_post("student_id"));
            if($isPaid) {
                $message = "Alreday Paid.";
                $this->data['success_message'] = $message;
                $_SESSION['success_message'] = $message;
                $this->data['error_message'] = null;
                $_SESSION['error_message'] = null;
            } else {
                $message = "Payment is Pending.";
                $this->data['error_message'] = $message;
                $_SESSION['error_message'] = $message;
                $this->data['success_message'] = null;
                $_SESSION['success_message'] = null;
            }
        }

        $r = 0;
        $this->data['months'] = months();

        $this->data['years'] = array();

        for($i=2019; $i<=date('Y'); $i++) {
            $this->data['years'][$r]['id'] = $i;
            $this->data['years'][$r]['title'] = $i;
            $r++;
        }
        

        $res = $class_model->getClassess(100,0, '');
        $this->data['classess'] = $res['data'];
        $this->view->render("students/payment_form", "template", $this->data);
    }


    private function createOrUpdateClassFee($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("year_id"))) {
                $this->data['errors']["year_id"] = "Year is required";
            } elseif(empty(get_post("month_id"))) {
                $this->data['errors']["month_id"] = "Month is required";
            } elseif(empty(get_post("class_id"))) {
                $this->data['errors']["class_id"] = "Class is required";
            } elseif(empty(get_post("paid_amount"))) {
                $this->data['errors']["paid_amount"] = "Amount is required";
            } else {
                $res = $model->createOrUpdateFeeRecord(get_post("_id"), $_POST);
                if($res) {
                    $message = "Payment Successfully saved.";
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


    private function updateAttendance($model=null) {
        $this->data['errors'] = array();
        $resp = array();
        try {
            if(empty(get_post("student_id"))) {
                $this->data['errors']["student_id"] = "Student is required";
            } elseif(empty(get_post("class_id"))) {
                $this->data['errors']["class_id"] = "Class is required";
            } elseif(empty(get_post("date"))) {
                $this->data['errors']["date"] = "Date is required";
            } else {
                $res = $model->createOrUpdateAttendanceRecord($_POST);
                if($res) {
                    $message = "Attendance Successfully saved.";
                    $this->data['success_message'] = $message;
                    $_SESSION['success_message'] = $message;
                    $resp = array('message'=> $message, 'success' => 1);
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $resp = array('message' => $e, 'error'=>1);
        }

        echo json_encode($resp); exit;
    }

}