<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/db.php';

echo "\033[0;36m --------------makeTable-----------------\033[0m\n";
echo "\033[0;36m --------------start-----------------\033[0m\n";

fwrite(STDOUT, "if you want to set by yourself?( {tableName}/* )");
$tablname = trim(fgets(STDIN));
fwrite(STDOUT, "which table type do you set?(up/down)");
$method = trim(fgets(STDIN));

$callClass= new \database\CallDatabaseClass();
$callClass->setRunWhich('tables');
echo "\033[0;36m --------------this is run message-----------------\033[0m\n";
if($tablname !='*' AND !empty($tablname) ){
	echo $callClass->runOne($tablname,$method);
}else{
	echo $callClass->run($method);
}
echo "\033[0;36m--------------this is end message-----------------\033[0m\n";
echo 'finish......';
?>

