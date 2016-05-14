<?php
class TableFilms 
{
	private	 $rowValues, $recordIndex, $Page;
	function __construct($recordIndex, $pageIndex, $report  )
	{
		$this->Page=$pageIndex;
		$this->rowValues=array();
		$this->rowValues=$report;
	}
	
	public function __toString()
	{
		
		$id_str="id_".$this->Page;
		$name_str="name_".$this->Page;
		
		$Str=	"<table class='table' id='$this->Page'>";
		$Str.=	"<tr class='line' >";
		$Str.=	"<td  style='text-align: left;'>";
		$Str.=	"<img class='buttonT' src='./Site_Images/add.png' title='Добавить'onclick='AddRecordFilm(); return false;'/>";
		$Str.=	"</td>";
		$Str.=	"</tr>";
		$i=0;
		foreach($this->rowValues as $a)
		{
						
			$Str.=	 "<tr class='line' id='film_".$a['id_film']."' >";
			$Str.=	 "<td>".($i+1)."</td>";			//[0]
			$Str.=	 "<td>".$a['name_film']."</td>";		//[1]
			$Str.=	 "<td>".$a['name_director']."</td>";			//[2]
			$Str.=	 "<td>".$a['name_genre']."</td>";			//[3]
			$Str.=	 "<td><img class='image' src='images_small/".$a['img_path']."' alt='Image' /></td>";		//[4]	
			
			$Str.=	 "<td style='display:none;'>".$a['id_director']."</td>";//id director		[5]
			$Str.=	 "<td style='display:none;'>".$a['id_genre']."</td>";//id genre		[6]
			$Str.=	 "<td style='display:none;'>".$a['img_path']."</td>";//image path		[7]
			
			$Str.=	 "<td style='text-align: center;'>";
			$Str.=	 "<img class='buttonT' src='./Site_Images/write_48.png' title='Редактировать' onclick='EditRecordFilms(\"".$a['id_film']."\"); return false;' />";
			$Str.=	 "</td>";			
			$Str.=	 "<td>";	
							
			$Str.=	 "<img class='buttonT' src='./Site_Images/remove.png' title='Удалить'";						
			$Str.=	 "onclick='DeleteRecordFilm(\"".$a['id_film']."\",\"".addslashes($a['name_film'])."\",\"".addslashes($a['name_director'])."\",\"".addslashes($a['name_genre'])."\",\"".$a['img_path']."\"); return false;'/>"; 
			$Str.=	 "</td>";			
			$Str.=	 "</tr>";
			$i++;
		}		
		$Str.=	 "</table>"	;
		return $Str;
	}
	
	
}
