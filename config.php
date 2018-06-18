<?php

if (!isset($_SESSION['lang'])) {
	$_SESSION['lang'] = 'vi';
}else if(isset($_GET['lang']) && !empty($_GET['lang'])){
	if ($_GET['lang'] == 'en') {
		$_SESSION['lang'] = 'en';
	}
	else{
		$_SESSION['lang'] = 'vi';
	}
}

define("DB_HOST", "localhost");
define("DB_USER", "xemphim");
define("DB_PASSWORD", "xemphim");
define("DB_NAME", "xemphim");

define("ROOT_URL", "http://xem-phims.com");
define("DEFAULT_THUMBNAIL", "storage/uploads/thumbnail/default-thumbnail.jpg");
define("PROXY_CRAWN", "71.13.112.152:3128");