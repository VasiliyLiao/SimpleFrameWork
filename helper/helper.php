<?php
function view($viewName,$data=[]){
	$viewName=str_replace('.', '/', $viewName);
	extract ($data);
	ob_start();
	   include ( __DIR__ . '/../template/views/'.$viewName.'.tpl.php' );
       $viewFile = ob_get_contents();
    ob_end_clean();
    return $viewFile;
}

function asset($name){
	return  Server_Document.'/asset/'.$name;
}

function route($name,$data=[]){
	$routeName=App\Kernel\Route::$routeName[$name];
	foreach ($data as $key => $value) {
		$routeName=str_replace(":$key", $value, $routeName);
	}
	return $routeName;
}
function toFilter($str){
	return htmlspecialchars($str, ENT_QUOTES);
}
function redirect($uri){
	header('Location:'.$uri);
}
// function getToken(){
// 	if(!isset($_SESSION['_token'])){
// 		$_SESSION['_token']=md5(uniqid(rand()));
// 	}

// 	return $_SESSION['_token'];
// }
// function checkToken($paramsToken){
// 	$tmpToken=$_SESSION['_token'];
// 	$_SESSION['_token']=md5(uniqid(rand()));

// 	return ($paramsToken==$tmpToken)?true:false;
// }