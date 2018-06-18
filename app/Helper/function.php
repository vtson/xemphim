<?php
use App\Models\YearModel as YearModel;
use App\Models\CountryModel as CountryModel;
use App\Models\GenreModel as GenreModel;
use App\Models\FilmsModel as FilmsModel;
use App\Models\participantsModel as participantsModel;
use App\Helper\Request as Request;
use App\Helper\Validator as Validator;
use App\Helper\Crawl as Crawl;
use App\Helper\Visit as Visit;
use App\Helper\Ajax as Ajax;

function dd($dd){
  echo "<pre>" . var_dump($dd) . "</pre>";
  die;
}

if(!function_exists('view')){
  function view($viewName, $viewData = []){
    $viewName = str_replace('.', '/', $viewName);
    $viewName = 'views/' . $viewName . '.php';
    if(file_exists($viewName)){
      foreach ($viewData as $var => $val) {
        $$var = $val;
      }
      $uri = $_SERVER['REQUEST_URI'];
      if(strpos($uri, 'admin')){
        require_once 'views/admin/layout/master.php';
      }
      else{
        require_once 'views/layout/master.php';
      }
    }else{
      die('View ' . $viewName . 'not found!');
    }
    return true;
  }
}


if(!function_exists('loader')){
  function loader(){
    $uri = $_SERVER['REQUEST_URI'];

    $uri = explode('?', $uri);

    $uri = $uri[0];
    $uri = trim($uri, '/');
    $tmp = !empty($uri) ? explode('/', $uri) : [];
    $parameters = [];

    $listFilms = ["phim-le", "phim-bo", "the-loai", "quoc-gia", "nam-phat-hanh", "loc-phim", "tim-kiem", "xem"];
    $namespace = 'App\\Controller\\';
    if(sizeof($tmp) == 0){
      $className = 'HomeController';
      $functionName = 'index';
      $parameters = [];
    }else if($tmp[0] == "admin" && empty($tmp[1])){
      $namespace = 'App\\Controller\\Admin\\';
      $className = 'DashboardController';
      $functionName = 'index';
      $parameters = [];
    }else if($tmp[0] == "admin"){
      $namespace = 'App\\Controller\\Admin\\';
      $className = ucfirst(strtolower($tmp[1])) . 'Controller';
      $functionName = isset($tmp[2]) ? $tmp[2] : 'index';
      if (sizeof($tmp) > 2) {
        unset($tmp[1], $tmp[2]);
        $parameters = array_values($tmp);
      }
    }
    else if(in_array($tmp[0], $listFilms)){
      $className = 'FilmsController';
      $functionName = 'index';
      if($tmp[0] == 'loc-phim')
        $functionName = 'filter';
      if($tmp[0] == 'tim-kiem')
        $functionName = 'search';
      $parameters = array_values($tmp);
    }
    else{
      $className = ucfirst(strtolower($tmp[0])) . 'Controller';
      $functionName = isset($tmp[1]) ? $tmp[1] : 'index';
      if (sizeof($tmp) > 2) {
        unset($tmp[0], $tmp[1]);
        $parameters = array_values($tmp);
      }
    }

    $class = $namespace.$className;

    if (!method_exists($class, $functionName)) {
      die('Method ' . $functionName . ' not found in class ' . $className . ' !');
    }

    $class = new $class();

    $class->$functionName($parameters);

    return true;
  }
}

if(!function_exists('route')){
  function route($className, $method){
    if ($className == 'home' && $method == 'index') {
      $className = '/';
      $method = '';
    }

    if ($className == 'films') {
      $className = '';
      $method = $method;
    }

    if ($className == 'home') {
      $tmp = explode('/', $method);
      if (sizeof($tmp) > 1) {
        list($method, $param) = $tmp;
        $className = $param.'/';
        $method = '';
      }
    }
    if(!empty($className))
      $className = $className . '/';
    return trim(ROOT_URL . '/' .$className . $method, '//');
  }
}

if (!function_exists('request')) {
  $globalRequest = null;
  function request()
  {
    global $globalRequest;
    if (!is_object($globalRequest)) {
      $globalRequest = new Request();
    }
    return $globalRequest;
  }
}

if (!function_exists('validator')) {
  function validator($validator){
    $validator = new Validator($validator);
    return $validator;
  }
}

if (!function_exists('crawl')) {
  function crawl(){
    $crawl = new Crawl();
    return $crawl;
  }
}

if (!function_exists('visit')) {
  function visit(){
    $visit = new Visit();
    return $visit;
  }
}

if (!function_exists('upload')){
  function upload($file){
    $file = new Upload($file);
    return $file;
  }
}

if (!function_exists('ajaxTemplate')){
  function ajaxTemplate($path){
    $path = new Ajax($path);
    return $path;
  }
}

if (!function_exists('__')){
  function __($key){
    return array_key_exists($key, LANGUAGE) ? LANGUAGE[$key] : $key;
  }
}

if (!function_exists('redirect')) {
  function redirect($url, $session = []){
    $_SESSION['redirect'] = $session;
    header('Location: ' . $url);
  }
}

if (!function_exists('getFlash')) {
  function getFlash(){
    $flash = array_key_exists('redirect', $_SESSION) ? $_SESSION['redirect'] : [];
    $_SESSION['redirect'] = [];
    return $flash;
  }
}

function convert_vi_to_en($str) {

  $vis = array(
 
    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
     
    'd'=>'đ',
     
    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
     
    'i'=>'í|ì|ỉ|ĩ|ị',
     
    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
     
    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
     
    'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     
    'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     
    'D'=>'Đ',
     
    'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
     
    'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     
    'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     
    'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     
    'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
     
  );

  foreach($vis as $en => $vi){
    $str = preg_replace("/($vi)/i", $en, $str);
  }

  return $str;
  }

  function slug($str){
    $str = str_replace(' ', '_', $str);
    $slug = $str;
    return $slug;
  }


 if (!function_exists('genres')) {
  function genres()
  {
    $genreModel = new GenreModel();
    $genres = $genreModel->select('*')
      ->getMany();

    return $genres;
  }
}

if (!function_exists('years')) {
  function years()
  {
    $yearModel = new YearModel();
    $years = $yearModel->select('*')
      ->getMany();

    return $years;
  }
}

if (!function_exists('countries')) {
  function countries()
  {
    $countryModel = new CountryModel();
    $countries = $countryModel->select('*')
      ->getMany();

    return $countries;
  }
}

if (!function_exists('participants')) {
  function participants($job)
  {
    $participantsModel = new ParticipantsModel();
    $participants = $participantsModel->where('job %','%'.$job.'%')
      ->select('*')
      ->getMany();
    return $participants;
  }
}

// embed File And Url 



if (!function_exists('asset')) {
  function asset($absLink)
  {
    return ROOT_URL . '/' . $absLink;
  }
}


function fileUploadType($fileUpload)
{
  $type = explode('/', $fileUpload);
  return $type;
}

function getUrlMedia($content)
{
  preg_match("/(|http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]+(?:jpg|jpeg|png|gif|webp|mp4|webm))/i", $content, $match);
  return $match;
}

function getUrl($content)
{
  preg_match("/(|http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", $content, $match);
  return $match;
}

function getUrlYtb($content)
{
  preg_match("/(http|https|ftp|ftps)\s*[a-zA-Z\/\/:\.]*youtube.com\/embed\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", $content, $match);
  return $match;
}

function videoNImageTypeAllows()
{
  return [
    'video' => ['mp4', 'webm'],
    'image' => ['jpeg', 'jpg', 'png', 'gif', 'webp']
  ];
}

function classifyUrl($url)
{
  $videoNImageTypes = videoNImageTypeAllows();
  $url = getUrl($url);
  $extension = strtolower(trim(@end(explode(".", $url[0]))));
  foreach ($videoNImageTypes as $type => $format) {
    if (in_array($extension, $format)) {
      return $type;
    }
  }
  return 'youtube';
}

function embedImage($item, $link, $content)
{
  $img = str_replace($item, '<figure><img src="' . $link . '"></figure>', $content);
  return $img;
}

function embedVideo($item, $link, $content)
{
  $video = str_replace($item, '<video src="' . $link . '" >' . $link . '</video>', $content);
  return $video;
}

function embedLink($item, $link, $content)
{
  $link = str_replace($item, '<a rel="nofollow" target="_blank" href="' . $link . '">' . $link . '</a>', $content);
  return $link;
}

function embedYoutube($item)
{
  $ytb = str_replace($item, '<iframe src="'. $item . '" ></iframe>', $item);
  return $ytb;
}

// End File and Url

// Repair text input

function repairTextInput($input){

    if(is_array($input)){
      $texts = $input;
    }else{
      $texts = explode(',', $input);
    }
 
    $output = array();

    foreach ($texts as $text){

      $text = trim($text);

      $replace = preg_replace('/[\:\?\-]/', ' ', $text);

      preg_match('/^(\p{L}|\p{N})[(\p{L}|\p{N}) ]+$/u',$replace, $match);

      if(empty($match))
        return false;

      $output[] = mb_convert_case(strtolower($match[0]), MB_CASE_TITLE, 'UTF-8');

      unset($match);
  }

  $output = implode(',', $output);
  return $output;
}

$GLOBALS['jobs'] = ['Actor', 'Director'];
$GLOBALS['marriages'] = ['Unkown', 'Married', 'Single'];
// End repair

function mostViewInWeek(){
    $filmsModel = new FilmsModel();
    $films = $filmsModel->select('*',10)
      ->getMany();

    return $films;
}