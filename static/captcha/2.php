<?php
if(!defined('ABSPATH'))
	exit('Access Denied');
class CCheckCodeFile{
	private $mCheckCodeNum=4;
	private $mCheckCode='';
	private $mCheckImage='';
	private $mDisturbColor='';
	private $mCheckImageWidth='80';
	private $mCheckImageHeight='26';
	private function OutFileHeader(){
		header("Content-type: image/png");
	}
	private function CreateCheckCode(){
		$str='abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
		$randnum='';
		for($i=0;$i<$this->mCheckCodeNum;$i++){
			$start=rand(1,strlen($str)-1);
			$randnum.=substr($str,$start,1);
		}
		
		$this->mCheckCode=$randnum;
		return $this->mCheckCode;
	}
	private function CreateImage(){
		$this->mCheckImage=@imagecreate($this->mCheckImageWidth,$this->mCheckImageHeight);
		imagecolorallocate($this->mCheckImage,200,200,200);
		return $this->mCheckImage;
	}
	private function SetDisturbColor(){
		for($i=0;$i<=128;$i++){
			$this->mDisturbColor=imagecolorallocate($this->mCheckImage,rand(0,255),rand(0,255),rand(0,255));
			imagesetpixel($this->mCheckImage,rand(2,128),rand(2,38),$this->mDisturbColor);
		}
	}
	public function SetCheckImageWH($width,$height){
		if($width==''||$height=='')
			return false;
		$this->mCheckImageWidth=$width;
		$this->mCheckImageHeight=$height;
		return true;
	}
	private function WriteCheckCodeToImage(){
		for($i=0;$i<$this->mCheckCodeNum;$i++){
			$bg_color=imagecolorallocate($this->mCheckImage,rand(0,255),rand(0,128),rand(0,255));
			$x=floor($this->mCheckImageWidth/$this->mCheckCodeNum)*$i;
			$y=rand(0,$this->mCheckImageHeight-15);
			imagechar($this->mCheckImage,5,$x,$y,$this->mCheckCode[$i],$bg_color);
		}
	}
	public function OutCheckImage(){
		$this->OutFileHeader();
		$this->CreateCheckCode();
		$_SESSION['code']=strtolower($this->mCheckCode);
		$this->CreateImage();
		$this->SetDisturbColor();
		$this->WriteCheckCodeToImage();
		imagepng($this->mCheckImage);
		imagedestroy($this->mCheckImage);
	}
}
Session_start();
$c_check_code_image=new CCheckCodeFile();
$c_check_code_image->OutCheckImage();

?>