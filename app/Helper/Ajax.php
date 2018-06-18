<?php
namespace App\Helper;

class Ajax{
	
	protected $path;

	function __construct($path)
	{
		$this->path = $path;
	}

	public function dataTemplate($data = ''){

		$template = file_get_contents($this->path);

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				if (strpos($template, $key)) {
					$template = str_replace("{{$key}}", $value, $template);
				}
			}
		}

		return $template;
	}
}
