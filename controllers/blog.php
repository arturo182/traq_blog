<?php
namespace blog\controllers;

use blog\models\Post;
use avalon\output\View;
use traq\controllers\AppController;
use traq\models\Project;

class Blog extends AppController
{
	public function __construct() 
	{
		parent::__construct();
		
		$this->_render['view'] = 'blog/' . $this->_render['view'];
	}
	
	public function action_index($slug)
	{
		$project = Project::find('slug', $slug);
		if(!$project) {
			$this->show_404();
			return;
		}
		
		$posts = Post::select()->where('project_id', $project->id)->order_by('created_at', 'DESC')->exec()->fetch_all();
		View::set('posts', $posts);
	}
}
?>