<?php
if ( ! defined('APP_PATH')) exit("Access denied");

Class Settings extends Controller {
    
    public function index($param=null) {
        $settings_model = $this->model->load('settings');
        $this->data['record'] = $settings_model->getAppData();

        if(isset($_POST['submit'])) {
            $this->saveSettings($settings_model);
        }
        $this->view->render("settings/index", "template", $this->data);
        clear_messages();
    }

    private function saveSettings($model=null) {
        $this->data['errors'] = array();
        try {
            if(empty(get_post("app_name"))) {
                $this->data['errors']["app_name"] = "App name is required";
            } elseif(empty(get_post("address"))) {
                $this->data['errors']["address"] = "Address is required";
            } elseif(empty(get_post("phone_number"))) {
                $this->data['errors']["phone_number"] = "Phone number(s) is required";
            } elseif(empty(get_post("email_address"))) {
                $this->data['errors']["email_address"] = "Email address is required";
            } elseif(empty(get_post("active_season_id"))) {
                $this->data['errors']["active_season_id"] = "Active Season is required";
            } else {
                $res = $model->updateAppData($_POST);
                if($res) {
                    $this->data['success_message'] = "App data Successfully saved.";
                } else {
                    $this->data['error_message'] = "Unable to save data, please try again.";
                }
            }
        } catch(Exception $e) {
            $this->data['error_message'] = $e;
        }
    }
}