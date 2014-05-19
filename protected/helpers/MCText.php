<?php

class MCText {

	public static function shorten($body)
	{
		$res = substr(
			strip_tags($body),
			0,
			strrpos(
				substr(
					strip_tags($body),
					0,
					500),
				' '
			)
		);
		if (strlen(strip_tags($res)) < 500)
			return strip_tags($body);
		else
			return $res;
	}
} 