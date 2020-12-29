<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Reports extends Controller {
    
    public function index($param=null) {
        $this->view->render("reports/index", "template", $this->data);
    }

    public function attendance($type='student') {
        $this->data['title'] = "Attendance";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        $pdf = $this->library->load('tcpdf');
        $settings_model = $this->model->load('settings');
        $this->data['app_data'] = $settings_model->getAppData();

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


        if($_GET['print']) {
            $_POST['submit'] = true;
            $_POST['year_id'] = $_GET['year'];
            $_POST['month_id'] = $_GET['month'];
            $_POST['class_id'] = $_GET['class'];
            if($_GET['class'] > 0) {
                $class = $class_model->getClassById($_GET['class']);
                // print_r($class); exit;
                $_POST['class_name'] = $class ? $class['class_name'] : "";
            }
            
        }

        if(get_post('submit')) {
            $this->data['show_att'] = true;
            $attendance = $student_model->getMonthlyAttendanceReport(get_post('year_id'), get_post('month_id'), get_post('class_id'));
            $att_arr = array();

            foreach($attendance as $index=>$att) {
                $att_arr[$att['name']][$att['att_date']] = true;
            }
            
            $this->data['attendance'] = $att_arr;
        }

        if(get_post('year_id') && get_post('month_id')) {
            $this->data['end_date'] = date('t', strtotime(get_post('year_id').'-'.get_post('month_id')));
        }

        if($type === 'employee')
            {
                if($_GET['print'] == '1')
                    $this->view->render("reports/print_emp_attendance", "print_template", $this->data);
                else
                $this->view->render("reports/emp_attendance", "template", $this->data);
            }
        else
            {
                if($_GET['print'] == '1')
                    $this->view->render("reports/print_attendance", "print_template", $this->data);
                else
                $this->view->render("reports/attendance", "template", $this->data);
            }
    }


    public function class_schedule($print=false,$class_id=null) {
        $this->data['title'] = "Class Schedule";
        $student_model = $this->model->load('student');
        $class_model = $this->model->load('class');
        $pdf = $this->library->load('tcpdf');
        $settings_model = $this->model->load('settings');
        $this->data['app_data'] = $settings_model->getAppData();
        $this->data['schedules'] = array();
        $r = 0;
        
        $res = $class_model->getClassess(100,0, '');
        $this->data['classess'] = $res['data'];
        $this->data['show_report'] = false;
        $this->data['days'] = days();

        if($print) {
            $_POST['submit'] = true;
            $_POST['class_id'] = (int)$class_id;
            if($class_id) {
                $class = $class_model->getClassById($class_id);
                $_POST['class_name'] = $class ? $class['class_name'] : "";
            }
            
        }

        if(get_post('submit')) {
            $this->data['show_report'] = true;
            $schedules = $class_model->getClassSchedule(get_post('class_id'));

            $cls_arr = array();

            foreach($schedules as $index=>$row) {
                $cls_arr[$row['class_name']][$row['day_id']] = true;
                $cls_arr[$row['class_name']]['data'] = $row;
            }

            $this->data['schedules'] = $cls_arr;
        }

        if(get_post('year_id') && get_post('month_id')) {
            $this->data['end_date'] = date('t', strtotime(get_post('year_id').'-'.get_post('month_id')));
        }

        if($print)
            $this->view->render("reports/print_class_schedule", "print_template", $this->data);
        else
            $this->view->render("reports/class_schedule", "template", $this->data);
    }


    public function income($print=false,$year=null, $month=null) {
        $this->data['title'] = "Income/Expence";
        $cafeteria_model = $this->model->load('cafeteria');
        $pdf = $this->library->load('tcpdf');
        $settings_model = $this->model->load('settings');
        $this->data['app_data'] = $settings_model->getAppData();
        $this->data['transactions'] = array();
        $this->data['months'] = months();
        $this->data['years'] = array();

        for($i=2019; $i<=date('Y'); $i++) {
            $this->data['years'][$r]['id'] = $i;
            $this->data['years'][$r]['title'] = $i;
            $r++;
        }
        $r = 0;
        
        $this->data['show_report'] = false;

        if($print) {
            $_POST['submit'] = true;
            $_POST['year_id'] = (int)$year;
            $_POST['month_id'] = (int)$month;            
        }

        if(get_post('submit')) {
            $this->data['show_report'] = true;
            $transactions = $cafeteria_model->getTransactionReport(get_post('year_id'), get_post('month_id'));
            $this->data['transactions'] = $transactions;
        }
        

        if(get_post('year_id') && get_post('month_id')) {
            $this->data['end_date'] = date('t', strtotime(get_post('year_id').'-'.get_post('month_id')));
        }

        if($print)
            $this->view->render("reports/print_income", "print_template", $this->data);
        else
            $this->view->render("reports/income", "template", $this->data);
    }


}