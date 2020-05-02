<?php 

namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;
use app\models\Admin;

class MainController extends Controller
{
	public function indexAction()
	{
		$pagination = new Pagination($this->route, $this->model->postsCount());
		$vars = [
				'pagination' => $pagination->get(),
				'list' => $this->model->postsList($this->route),
			];
		$this->view->render('Main Page', $vars);
	}

	public function aboutAction()
	{
		$this->view->render('About us');
	}

	public function contactAction()
	{
		$adminModel = new Admin;
		if(!$adminModel->isPostsExists($this->route['id']))
		{
			$this->view->errorCode(404);
		}
		$vars = [
				'data' => $adminModel->postData($this->route['id'])[0],
			];
		$this->view->render('Post', $vars);
	}
}