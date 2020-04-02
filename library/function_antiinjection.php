<?php
function antiinjeksi($text){
	global $mysql;
	$safetext = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($text,ENT_QUOTES))));
	return $safetext;
}


?>
