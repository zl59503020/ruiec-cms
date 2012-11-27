<?php
defined('IN_RUIEC') or exit('Access Denied');
class image {
	
	// ReSize
	static function ResizeImage($im,$maxw,$maxh,$name,$db=true){
		$width = imagesx($im);
		$height = imagesy($im);
		if(($width > $maxw) || ($height > $maxh)){
			if($db){
				$widthratio = $maxw/$width;
				$heightratio = $maxh/$height;
				if($widthratio < $heightratio){
					$ratio = $widthratio;
				}else{
					$ratio = $heightratio;
				}
				$newwidth = $width * $ratio;
				$newheight = $height * $ratio;
			}else{
				$newwidth = $maxw;
				$newheight = $maxh;
			}
			if(function_exists("imagecopyresampled")){
				$newim = imagecreatetruecolor($newwidth, $newheight);
				imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			}else{
				$newim = imagecreate($newwidth, $newheight);
				imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			}
			ImageJpeg($newim,$name);
			ImageDestroy($newim);
		}else{
			ImageJpeg($im,$name);
		}
	}
}

?>