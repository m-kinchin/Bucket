<?php
	function PregMatchInt($string, $default, $maxlegth = 3)
	{
		return (preg_match('/^\d{1,'.$maxlegth.'}$/',$string)?$string:0);
	}
?>