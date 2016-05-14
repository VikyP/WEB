<?php
class LoadImage
{ 
		private $FileImage;
		private $images_dir_big="images_big/";
		function downloadImage()
		{
			try
			{
				//----Проверка на наличие в массиве $FILES
				$this->FileImage=(isset($_FILES['photofile']))?$_FILES['photofile']:false;
			
			if($this->FileImage===false  || $this->FileImage['error']!=0 ||	$this->validationFile()===false)
				return;		
			
			if (move_uploaded_file($this->FileImage['tmp_name'],"./".$this->images_dir_big.$this->FileImage['name'])==false)
				throw new Exception ("Error move uploaded file");
			//---Файл добавлен в каталог 
			$this->createSmallImage();			
			}
			catch(Exception $e)
			{
				echo $e->getMessage()."1 <br />"; 
				return ;
			}
		}
		
		
		function createSmallImage()
		{			
			$images_dir_small="images_small/";
			$imgSize=150;
			$fileName=$this->images_dir_big.$this->FileImage['name'];
			$fileNameSmall=$images_dir_small.$this->FileImage['name'];
			
			$a = getimagesize($fileName);
			$sx=$a[0];
			$sy=$a[1];

			switch($a[2])
			{
				case IMAGETYPE_JPEG:
					$imgSrc=imagecreatefromjpeg($fileName);		
					break;
				case IMAGETYPE_PNG:
					$imgSrc=imagecreatefrompng($fileName);
					break;
				case IMAGETYPE_GIF:
					$imgSrc=imagecreatefromgif($fileName);
					break;
				default:
					die("Unknown image type");
					break;
			}
			
			//-Создание второго изображения

			 $x_new=(($sx)>($sy))? $imgSize:floor(($imgSize/$sy)*$sx);
			 $y_new=(($sx)<($sy))? $imgSize:floor(($imgSize/$sx)*$sy);
			 

			$imgDst=imagecreatetruecolor($x_new, $y_new);

			imagecopyresized($imgDst, $imgSrc,0,0,0,0,$x_new,$y_new,$sx,$sy);


			switch($a[2])
			{
				case IMAGETYPE_JPEG:
					//header ("Content-Type: image/jpeg");
					imagepng($imgDst,$fileNameSmall);
					break;
				case IMAGETYPE_PNG:
					//header ("Content-Type: image/png");
					imagejpeg($imgDst,$fileNameSmall);
					break;
				case IMAGETYPE_GIF:
					//header ("Content-Type: image/gif");
					imagegif($imgDst,$fileNameSmall);
					break;
				default:
					die("Unknown image type");
					break;
			}

			imagedestroy($imgSrc);
			imagedestroy($imgDst);
			
		}
		
		function validationFile()
		{
			try
			{				
				//----Проверка, что $_FILES[error]=1
				if($this->FileImage['error']!=0)	
					throw new Exception ("Error unloaded file : {$this->FileImage['error']}");
				//----Проверка, на допустимый MIME-тип
				$arrMime	=	array("image/png", "image/jpg","image/gif","image/jpeg");
				if(!in_array($this->FileImage['type'],$arrMime))
					throw new Exception ("Error Forbidden MIME-type {$this->FileImage['type']} ");				
				
				$arrExt	=	array(".png",".gif",".jpg",".jpeg");
				$ext=substr($this->FileImage['name'],strrpos($this->FileImage['name'],"."));
				if(!in_array($ext,$arrExt))
					throw new Exception ("Error Forbidden : $ext ");
				
				return true;
			}				
			catch(Exception $e)
			{
				echo $e->getMessage()." <br />";
				return false;
			}

			
			
		}


}
