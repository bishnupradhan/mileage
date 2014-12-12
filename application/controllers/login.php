<?php

class login extends CI_Controller {

    function index() {
        if( $this->session->userdata('isLoggedIn') ) {
            redirect('/main/show_main');
        } else {
            $this->show_login(false);
        }
    }

    function login_user() {
        //print "<pre>";print_r($_REQUEST);print "</pre>";exit;
        //print "<pre>"; print_r($this->input); print "</pre>"; exit;
        // Create an instance of the user model
        $this->load->model('user_m');

        // Grab the email and password from the form POST
        $email = $this->input->post('email');
        $pass  = $this->input->post('password');

        //Ensure values exist for email and pass, and validate the user's credentials
        if( $email && $pass && $this->user_m->validate_user($email,$pass)) {
            // If the user is valid, redirect to the main view
            redirect('/main/show_main');
        } else {
            // Otherwise show the login screen with an error message.
            $this->show_login(true);
        }
    }

    function show_login( $show_error = false ) {
        $data['error'] = $show_error;

        $this->load->helper('form');
        $this->load->view('login',$data);
    }

    function logout_user() {
      $this->session->sess_destroy();
      $this->index();
    }

    function new_user($show_error=null){
        $data['error'] = $show_error;

        $this->load->helper('form');
        $this->load->view('register',$data); // For showing the form with error data
    }
    
    function register() {
        $userInfo = $_POST;
        if($userInfo["password"]!=$userInfo["cpassword"])
            exit("Password and confirm password has mismatched");
        else{
            unset($userInfo["cpassword"]);
            $userInfo["password"] = sha1($userInfo["password"]);// For password encrypting
        }
        $userInfo["add_date"]=  date("Y-m-d h:i:s");
        $userInfo["ip"]=$_SERVER["HTTP_HOST"];

        if( count($userInfo) ) {
            $this->load->model('user_m');
            $saved = $this->user_m->create_new_user($userInfo);
        }

        if ( isset($saved) && $saved ) {
            redirect("login"); // after successing
        }        
        
    }

    function user_listing(){
        /*if(!$this->session->userdata('isAdmin'))
            exit("Admin Authorisation Required");*/
        $userlists = $this->CI_pagination->pagination("user");
        pr($userlists);
    }
}
