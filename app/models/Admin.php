<?php 

namespace app\models;

use app\core\Model;
use Imagick;

class Admin extends Model
{
	public $error;

	public function loginValidate($post)
	{
		$config = require 'app/config/admin.php';
		if($config['login'] != $post['login'] || $config['password'] != $post['password'])
		{
			$this->error = "Login or password is not correct";
			return false;
		}
		return true;
	}

	public function postValidate($post, $type)
	{
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		if($nameLen < 3 || $nameLen > 100)
		{
			$this->error = "Name has been 3-100 characters";
			return false;
		}
		elseif($descriptionLen < 3 || $descriptionLen > 100)
		{
			$this->error = "Description has been 3-100 characters";
			return false;
		}
		elseif($textLen < 10 || $textLen > 5000)
		{
			$this->error = "Text has been 10-5000 characters";
			return false;
		}
		if(empty($_FILES['img']['tmp_name']) && $type == 'add')
		{
			$this->error = "Image don't set";
			return false;
		}
		return true;
	}

	public function postAdd($post)
	{
		$params = [
				'id' => '',
				'name' => $post['name'],
				'description' => $post['description'],
				'text' => $post['text'],
				];
		$this->db->query("INSERT INTO posts VALUES (:id, :name, :description, :text)", $params);
		return $this->db->lastInsertId();
	}

	public function postEdit($post, $id)
	{
		$params = [
				'id' => $id,
				'name' => $post['name'],
				'description' => $post['description'],
				'text' => $post['text'],
			];
		$this->db->query("UPDATE posts SET name = :name, description = : dexcription, text = :text WHERE id = :id", $params);
	}

	public function postUploadImage($path, $id)
	{
		$img = new Imagick($path);
		$img->cropThumbnailImage(1080, 600);
		$img->setImageCompressionQuality(80);
		$img->writeImage('public/materials/'.$id.'.jpg');
	}

	public function isPostsExists($id)
	{
		$params = ['id' => $id];
		return $this->db->column("SELECT id FROM posts WHERE id = :id", $params);
	}

	public function postDelete($id)
	{
		$params = ['id' => $id];
		$this->db->query('DELETE FROM posts WHERE id = :id', $params);
		unlink('public/materials/'.$id.'.jpg');
	}

	public function postData($id)
	{
		$params = ['id' => $id];
		return $this->db->row("SELECT * FROM posts WHERE id = :id", $params);
	}
}