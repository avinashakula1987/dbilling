<?php
$string=exec('getmac');
$mac=substr($string, 0, 17); 
$fopen = fopen("instructions.bat", 'r');
$newone = fgets($fopen);
if( $mac == $newone ){
	echo true;
}else{
	echo false;
}
?>