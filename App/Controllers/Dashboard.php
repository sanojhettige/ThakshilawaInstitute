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
        $this->view->render("index", "template", $this->data);
    }
}