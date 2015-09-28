<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/db.php';

echo "\033[0;36m --------------makeTable-----------------\033[0m\n";
echo "\033[0;36m --------------start-----------------\033[0m\n";
fwrite(STDOUT, "if you want to set by yourself?( {seedName}/* )");
$seedName = trim(fgets(STDIN));
fwrite(STDOUT, "which seed type do you set?(run/truncate)");
$method = trim(fgets(STDIN));

$callClass= new \database\CallDatabaseClass;
$callClass->setRunWhich('seeds');
echo "\033[0;36m --------------this is run message-----------------\033[0m\n";
if($seedName !='*' AND !empty($seedName) ){
	echo $callClass->runOne($seedName,$method);
}else{
	echo $callClass->run($method);
}
echo "\033[0;36m--------------this is end message-----------------\033[0m\n";
echo 'finish......';

?>