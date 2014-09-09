<?php

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$account = $this->load->view('account/button', NULL, TRUE);
		$sidebar2 = $this->load->view('sidebar2', NULL, TRUE);
        $this->session->set_userdata('account', $account);
        $this->session->set_userdata('sidebar2', $sidebar2);
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
			    // Write the output.
			    // echo $this->output->get_output();  

			    redirect('/connexion');

			    // Stop the execution of the script.
			    exit();
	        }
        }

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
        $this->menu = '';
    }
}

?>