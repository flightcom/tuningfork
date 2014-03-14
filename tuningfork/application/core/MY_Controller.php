<?php

class Auth_Controller extends CI_Controller {

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
	            redirect('/connexion');
			    // Write the output.
			    echo $this->output->get_output();  

			    // Stop the execution of the script.
			    exit();
	        }
        }

		$account = $this->load->view('account', NULL, TRUE);
        $this->session->set_userdata('account', $account);

		// $this->load->view('master_admin', array('title' => 'Connexion', 'content' => $content));
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
    }
}

?>