<?php

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->helper('form');
        $this->load->library('breadcrumb');

		$account = $this->load->view('membres/button', NULL, TRUE);
        $this->session->set_userdata('account', $account);
		// $this->session->set_userdata('referer', $_SERVER['HTTP_REFERER']);
        $this->breadcrumb = new Breadcrumb();
    }
}

class Auth_Controller extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
	        // Allow some methods?
	        $allowed = array(
	            // 'connexion',
	            // 'instruments'
	        );
	        if ( ! in_array($this->router->method, $allowed) )
	        {
	        	// echo $this->router->method;
				$content = $this->load->view('index', NULL, TRUE);
				$this->load->view('master', array('title' => 'Accueil', 'content' => $content));

			    redirect('/connexion');
			    // Stop the execution of the script.
			    exit();
	        }
        }

    }
}

class Membre_Controller extends Auth_Controller {

    function __construct()
    {
        parent::__construct();
        // Traitements
    }

}

class Admin_Controller extends Auth_Controller {

    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('user_isAdmin'))
        { 
			$content = $this->load->view('access_forbidden', NULL, TRUE);
			$this->load->view('master', array('title' => 'Accès non autorisé', 'content' => $content));
		    // Write the output.
		    echo $this->output->get_output();  

		    // Stop the execution of the script.
		    exit();
        }

        $this->dashboard = $this->load->view('admin/dashboard', NULL, TRUE);
        $this->breadcrumb->add('Admin', '/admin');
        $this->menu = '';
    }
}

?>