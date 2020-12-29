<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Dashboard extends Controller {
    
    public function index($param=null) {
        $today = date("Y-m-d");
        $month_start = date("Y-m-01");
        $month_end = date("Y-m-31");
        $year_start = date("Y-01-01");
        $year_end = date("Y-12-31");

        $report_model = $this->model->load('report');
        $this->data['totalTeachers'] = $report_model->totalTeachers();
        $this->data['totalStudents'] = $report_model->totalStudents();
        $this->data['totalClassess'] = $report_model->totalClassess();
        $this->data['totalSubjects'] = $report_model->totalSubjects();
        $this->data['todayIncome'] = $report_model->getIncome($today, $today);
        $this->data['monthIncome'] = $report_model->getIncome($month_start, $month_end);
        $this->data['yearIncome'] = $report_model->getIncome($year_start, $year_end);
        $this->data['todayAttendance'] = $report_model->getAttendance($today, $today);
        $this->data['monthAttendance'] = $report_model->getAttendance($month_start, $month_end);
        $this->data['yearAttendance'] = $report_model->getAttendance($year_start, $year_end);
        $this->view->render("index", "template", $this->data);
    }
}