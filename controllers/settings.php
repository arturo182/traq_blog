<?php
namespace blog\controllers;

use blog\models\Post;
use avalon\http\Request;
use avalon\output\View;
use traq\controllers\ProjectSettings\AppController;

class Settings extends AppController
{
	public function __construct() 
	{
		parent::__construct();
		
		$this->_render['view'] = 'blog/' . $this->_render['view'];
	}
	
	public function action_index()
	{
		$posts = Post::select()->where('project_id', $this->project->id)->order_by('created_at', 'DESC')->exec()->fetch_all();;
		View::set('posts', $posts);
	}
	
	public function action_new()
    {
        $this->title(l('new'));

        $post = new Post();

        if(Request::method() == 'post') {
            $post->set(array(
				'project_id' => $this->project->id,
				'user_id' =>  $this->user->id,
                'title' => Request::$post['title'],
                'body' => Request::$post['body']
            ));

            if($post->is_valid()) {
                $post->save();
                Request::redirectTo("{$this->project->slug}/settings/blog");
            }
        }

        View::set('post', $post);
    }
	
	public function action_edit($id)
    {
        $this->title(l('edit'));
        
        $post = Post::find($id);
        
        if(Request::method() == 'post') {
            $post->set(array(
                'title' => Request::$post['title'],
                'body' => Request::$post['body']
            ));

            if($post->is_valid()) {
                $post->save();
                
                Request::redirectTo("{$this->project->slug}/settings/blog");
            }
        }

        View::set('post', $post);
    }
	
    public function action_delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        Request::redirectTo($this->project->href("settings/blog"));
    }
}
?>