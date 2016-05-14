<?php

class Film
{
	private $name, $director, $genre, $posterPath;
	function __construct($n, $d, $g, $path)
	{
		$this->name=$n;
		$this->director=$d;
		$this->genre=$g;
		if($path=="")
			$this->posterPath="images_small/defaultPoster.jpg";
		else
			$this->posterPath="images_small/".$path;
	}
	
	function getName()
	{
		return $this->name;
	}

	function Poster()
	{
		$S="<img src='".$this->posterPath."'>";
		$S.="<table style='text-align:left; padding:5px;'>";
		$S.="<tr><td>";
		$S.="Режиссер</td><td style='width:100px;'><h4>$this->director</h4></td></tr>";
		$S.="<tr><td>";
		$S.="Жанр</td><td style='width:100px;' ><h4>$this->genre</h4></td></tr></table>";
		
		return $S;
	}
	
}