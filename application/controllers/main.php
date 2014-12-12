<?php

class main extends CI_Controller {

    function index() {
        redirect($this->CI_Config->baseurl."/main/listing");
    }
    
    function show_main(){
        if(!$this->session->userdata('isLoggedIn'))
            redirect('login');
    }
}
