<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author nayosx
 */
class MY_Controller extends CI_Controller{
    //put your code here
    const STATUS = "status";
    const MSG = "msg";
    const ERROR = "error";
    protected $response = array();
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set("America/El_Salvador");
        $this->response = array(self::STATUS => FALSE, self::MSG => "", self::ERROR => FALSE);
        if (!$this->session->valid) {
         redirect();
       }
    }
}