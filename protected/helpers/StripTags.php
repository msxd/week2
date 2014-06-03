<?php

class StripTags implements FInterface {
	protected $_allowedHtml = false;
	protected $_allowedPhp = false;
	
	public function __construct($options = null) {
		if (is_array($options))
		{
			if (isset($options['html'], $options['php']))
			{
				$this->setAllovedHtml((bool) $options['html']);
				$this->setAllovedPhp((bool) $options['php']);
			}
		} 
		if (is_string($options))
		{
			$options == 'html' ? $this->setAllovedHtml(true) : '';
			$options == 'php' ? $this->setAllovedPhp(true) : '';
		}
		return $this;
	}
	public function getAllovedHtml()
	{
		return $this->_allowedHtml;
	}
	public function getAllovedPhp()
	{
		return $this->_allowedPhp;
	}
	public function setAllovedHtml($value)
	{
		$this->_allowedHtml = $value;
		return $this;
	}
	public function setAllovedPhp($value)
	{
		$this->_allowedPhp = $value;
		return $this;
	}

	public function filter($value) 
	{
		$value = (string) $value;
		$value = $this->_filterHtml($value);
		if ($this->_allowedPhp === false)
		{
			$value = $this->_filterPhp($value);
		}
		
		return $value;
		
	}
	private function _filterHtml($value)
	{
		preg_match_all('~(\<head\>).+?(\<\/head\>)~', $value, $match);
		if ($match) $value = preg_replace ('~(\<head\>).+?(\<\/head\>)~is', '', $value);
		preg_match_all('~((\<body\>)|(\<body\s.+?\>))|(\<\/body\>)~is', $value, $match);
		if ($match) $value = preg_replace ('~((\<body\>)|(\<body\s.+?\>))|(\<\/body\>)~is', '', $value);
		preg_match_all('~(\<\!--([^\[])).+?(--\>)~is', $value, $match);
		if ($match) $value = preg_replace ('~(\<\!--([^\[])).+?(--\>)~is', '', $value);
		if ($this->_allowedHtml === false)
		{
			preg_match_all('~((\<\w+\s.+?\>)|(\<\w+\>))|(\<\/\w+\>)~', $value, $match);
			if ($match) $value = preg_replace ('~((\<\w+\s.+?\>)|(\<\w+\>))|(\<\/\w+\>)|(\<!--.+?\>)|(\<!.+?\>)~is', '', $value);
			
		}
		
		return $value;
	}
	public function _filterPhp($value)
	{
		preg_match_all('~(((\<\?\s)|(\<\?php)|(\<\?\=))(.+?))(\?\>)~', $value, $match);
		if ($match) $value = preg_replace ('~(((\<\?\s)|(\<\?php)|(\<\?\=))(.+?))(\?\>)~is', '', $value);
		return $value;
	}
} 

