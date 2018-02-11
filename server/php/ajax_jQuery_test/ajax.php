<?php
if(isset($_GET["test1"])){
	echo test(5);
}
if(isset($_GET["test2"])){
	print test(5);
}

function test($lol){
	$mdr=$lol+6;
	return "rep : ".$mdr;
}
?>
