<?php
namespace blog\models;

use avalon\database\Model;

class Post extends Model
{
	protected static $_name = 'blog_posts';
	protected static $_properties = array(
		'id',
		'project_id',
		'user_id',
		'title',
		'created_at',
		'body'
	);
	
	protected static $_belongs_to = array(
		'project' => array('model' => 'traq\models\Project'),
		'user' => array('model' => 'traq\models\User')
	);
	
	protected static $_escape = array(
        'title',
        'body'
    );

	public function is_valid() 
	{
	    $errors = array();

        if(empty($this->_data['title'])) {
            $errors['title'] = l('errors.title_blank');
        }
        
        if(empty($this->_data['body'])) {
            $errors['body'] = l('errors.body_blank');
        }

        $this->errors = $errors;
        return !count($errors) > 0;
       }
}
?>