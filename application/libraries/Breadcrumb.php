<?php

class Breadcrumb {
	
	private $tab = [];

	function __construct()
	{

	}

	public function add($title, $path)
	{
		$this->tab[] = [
			'title' => $title,
			'path' => end($this->tab)['path'] . $path
		];
	}

	private function get($n)
	{
		return '<li>'
			// . ($n == 0 ? '' : '</li><li><a> > </a></li><li>') . '<a href="'.$this->tab[$n]['path'].'">'
			. '<a href="'.$this->tab[$n]['path'].'">'
			. ($n == count($this->tab) -1 ? '<b>':'')
			. $this->tab[$n]['title']
			. ($n == count($this->tab) -1 ? '</b>':'')
			. '</a></li>';
	}

	public function toHTML()
	{
		$tab = $this->tab;
		$output = implode('', array_map(function($key) use ($tab) {
			return $this->get($key);
		}, array_keys($this->tab)));
		return $output;
	}

	public function getNgController()
	{
		// $tab = $this->tab;
		// return implode('', array_map(function($item){
		// 	return ucfirst(str_replace('/', '', $item['path']));
		// }, $tab));

		return implode('', array_map(function($item){
			return is_numeric($item) ? 'Edit' : ucfirst($item);
		}, explode('/', $this->tab[count($this->tab)-1]['path']))) . 'Ctrl';
	}

}

?>