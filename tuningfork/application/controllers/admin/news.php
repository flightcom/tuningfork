<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Admin_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
    	parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('News_model');

		$this->menu = $this->load->view('admin/news/menu', NULL, TRUE);
    }

	public function index($news_id = null, $action = null)
	{
		if(is_null($news_id))
		{
			$this->lister_news();
		} 
		else
		{
			$this->get_news($news_id);
		}
	}

	public function add()
	{
		/* Check if admin */
		$data = array(
			'title' => 'Nouvel article',
		);

		$this->form_validation->set_rules('titre', 'Titre', 'required');
		$this->form_validation->set_rules('texte', 'Texte', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$content = $this->load->view('admin/news/add', $data, TRUE);
			$this->load->view('admin/master', array('title' => $data['title'], 'content' => $content));		
		}
		else
		{
			$titre = $this->input->post('titre');
			$texte = $this->input->post('texte');
			$tags = $this->input->post('tag');
			$res = $this->News_model->insert($titre, $texte, $tags);
			if ($res) redirect('/admin/news');
		}

	}

	public function lister_news()
	{
		$data = array(
			'articles' => $this->News_model->get_all_entries(),
			'title' => 'Liste des articles',
			);
		$content = $this->load->view('admin/news/liste', $data, TRUE);
		$this->load->view('admin/master', array('title' => 'Liste des news', 'content' => $content));
	}

	public function get_news($news_id)
	{
		$data = array(
			'article' => $this->News_model->get_entry($news_id)
			);
		$content = $this->load->view('admin/news/news', $data, TRUE);
		$this->load->view('admin/master', array('title' => 'Liste des news', 'content' => $content));

	}

}