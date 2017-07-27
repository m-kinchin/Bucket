<?php
	header("Content-type: image/png");
	$height = 40;
	$width = 120;
	$count = 5;
	$shift = ceil($width/$count);
	$font_size = 20;
	$font = './lucon.ttf';
    $img = imagecreate($width, $height);
	$red   = imagecolorallocate($img, 255, 0, 0);
	$yellow   = imagecolorallocate($img, 255, 255, 50);
    $black = imagecolorallocate($img, 0,0,0);
	$background = imagecolorallocate($img, 200, 250, 150);
	imagefilledrectangle($img, 0, 0, ($width-1), ($height-1), $background);
	$word = array();
	$code = '';
	NoiseImg($img, 10, 20);
	for($i = 0; $i < $count; $i++)
	{
		$min = $shift*($i+1)-$font_size;
		$max = $shift*$i+$font_size/2;
		$position_x = $min < $max ? mt_rand($min, $max):mt_rand($max, $min);
		$position_y = mt_rand($font_size,$height-$font_size/2);
		$word[$i] = GetChar();
		$code .= $word[$i]['value'];
		$angle = mt_rand(-45,45);
		imagettftext($img, $font_size, $angle, ($position_x+1), ($position_y+1), $black, $font, $word[$i]['char']);
		imagettftext($img, $font_size, $angle, ($position_x), $position_y, $red, $font, $word[$i]['char']);
	}
	session_start();
	//session_register('captcha');
	$_SESSION['code'] = $code;
    imagepng($img);
	
	function GetChar()
	{
		$type = mt_rand(1,3);
		$return = array();
		switch ($type) {
			case 1:$return['char'] = chr(mt_rand(48,57));$return['value'] = $return['char'];break;
			case 2:$return['char'] = chr(mt_rand(65,90));$return['value'] = strtolower($return['char']);break;
			case 3:$return['char'] = chr(mt_rand(97,122));$return['value'] = $return['char'];break;}
		return $return;
	}
	function NoiseImg($img, $per_dot, $counts_line = 0)
	{
		global $width,$height,$black;
		$counts_dot = round($width*$height*$per_dot/100);
		for ($i = 0; $i < $counts_dot; $i++) imagesetpixel($img, mt_rand(0,$width), mt_rand(0,$height), $black);
		for ($i = 0; $i < $counts_line; $i++) imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $black);
	}
	?>