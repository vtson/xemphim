<?php
namespace App\Helper;
class Upload{
	
	protected $file;

	function __construct($file)
	{
		$this->file = $file;
	}

	function type(){
		$type = explode('/', $this->file['type']);
		return $type;
	}

	function file(){
		$type = $this->type();
		$target_dir = "storage/uploads/thumbnail";
		$target_file = $target_dir . '/' . time() . '-' . basename($this->file['name']);
		$move = move_uploaded_file($this->file['tmp_name'], $target_file);
		if ($move)
			return $target_file;
		return false;
	}
}
