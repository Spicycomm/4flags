<?php
function toLower($str) {
    return strtolower($str);
}

function isReplace($str) {
	$tags = array(".", "?", "!", "/", "%", "*", ",", " ", "  ", "#", "´", "`", "'", "=", "%", "$");

	return str_replace($tags, "-", toLower($str));
}

function lastLetter($str) {
    $newStr = "";
    
	if(substr(isReplace($str), -1) == "-") {
		$newStr = substr($str, 0, -1); 
    } else {
        $newStr = isReplace($str);
    }

	return $newStr;
}

function noRepeatHifen($str) {
    return str_replace("--", "-", lastLetter($str));
}

?>
