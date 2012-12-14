<?php
namespace traq\plugins;

use avalon\http\Router;
use avalon\Autoloader;
use avalon\Database;
use FishHook;
use HTML;
use Form;

class Blog extends \traq\libraries\Plugin
{
	public static function info()
	{
		return array(
			'name' => 'Blog',
			'version' => '0.1',
			'author' => 'arturo182'
		);
	}
	
	public static function init()
	{
		Autoloader::registerNamespace('blog', __DIR__);
	
		Router::add('/' . RTR_PROJSLUG . '/blog', 'blog::controllers::Blog.index/$1');
		Router::add('/' . RTR_PROJSLUG . '/settings/blog', 'blog::controllers::Settings.index');
		Router::add('/' . RTR_PROJSLUG . '/settings/blog/new', 'blog::controllers::Settings.new');
		Router::add('/' . RTR_PROJSLUG . '/settings/blog/([0-9]+)/(edit|delete)', 'blog::controllers::Settings.$3/$2');
		
		FishHook::add('template:project_settings/_nav', function($project)
		{
			if(!$project->enable_blog)
				return;
				
			echo '<li' . iif(active_nav('/:slug/settings/blog'), ' class="active"') . '>' . HTML::link('Blog', "{$project->slug}/settings/blog") . '</li>';
		});
		
		FishHook::add('template:layouts/default/main_nav', function($project)
		{
			if(!$project)
				return;
			
			echo '<li'. iif(active_nav('/:slug/blog(.*)'), ' class="active"') .'>'. HTML::link(l('blog.blog'), $project->href("blog")) .'</li>'.PHP_EOL;
		});
	}
	
	public static function __install()
	{
		global $db;

		Database::connection()->query("CREATE TABLE IF NOT EXISTS `{$db['prefix']}blog_posts` (".
								" `id` bigint(20) NOT NULL AUTO_INCREMENT, ".
								" `project_id` bigint(20) NOT NULL, ".
								" `user_id` bigint(20) NOT NULL, ".
								" `title` varchar(255) NOT NULL, ".
								" `created_at` datetime NOT NULL, ".
								" `body` text COLLATE utf8_unicode_ci NOT NULL, ".
								" PRIMARY KEY (`id`) ".
								") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	}
	
	public static function __uninstall()
	{
		global $db;
		
		Database::connection()->query("DROP TABLE `{$db['prefix']}blog_posts`;");
	}
}
?>