<?php
if(!defined('ABSPATH'))
	exit('Access Denied');
session_start();

class Authnum{
	private $im;
	private $im_width;
	private $im_height;
	private $len;
	private $y;
	public $randnum;
	private $randcolor;
	public $red=238;
	public $green=238;
	public $blue=238;
	public $ext_num_type='';
	public $ext_pixel=false; //干扰点
	public $ext_line=false; //干扰线
	public $ext_rand_y=true; //Y轴随机
	

	function __construct(){
		$this->len=4;
		$this->im_width=80;
		$this->im_height=26;
		$this->im=imagecreate($this->im_width,$this->im_height);
	}
	
	function set_bgcolor(){
		imagecolorallocate($this->im,$this->red,$this->green,$this->blue);
	}
	
	function get_randnum(){
		$an1='abcdefghijkmnpqrstuvwxyz';
		$an2='ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$an3='23456789';
		if($this->ext_num_type=='')
			$str=$an1.$an2.$an3;
		if($this->ext_num_type==1)
			$str=$an1;
		if($this->ext_num_type==2)
			$str=$an2;
		if($this->ext_num_type==3)
			$str=$an3;
		$randnum='';
		for($i=0;$i<$this->len;$i++){
			$start=rand(1,strlen($str)-1);
			$randnum.=substr($str,$start,1);
		}
		$this->randnum=$randnum;
	}
	
	function get_y(){
		if($this->ext_rand_y)
			$this->y=rand(5,$this->im_height/5);
		else
			$this->y=$this->im_height/4;
	}
	
	function get_randcolor(){
		$this->randcolor=imagecolorallocate($this->im,rand(0,100),rand(0,150),rand(0,200));
	}
	
	function set_ext_pixel(){
		if($this->ext_pixel){
			for($i=0;$i<100;$i++){
				$this->get_randcolor();
				imagesetpixel($this->im,rand()%100,rand()%100,$this->randcolor);
			}
		}
	}
	
	function set_ext_line(){
		if($this->ext_line){
			for($j=0;$j<2;$j++){
				$rand_x=rand(2,$this->im_width);
				$rand_y=rand(2,$this->im_height);
				$rand_x2=rand(2,$this->im_width);
				$rand_y2=rand(2,$this->im_height);
				$this->get_randcolor();
				imageline($this->im,$rand_x,$rand_y,$rand_x2,$rand_y2,$this->randcolor);
			}
		}
	}
	
	function create(){
		$this->set_bgcolor();
		$this->get_randnum();
		for($i=0;$i<$this->len;$i++){
			$font=5;
			$x=$i/$this->len*$this->im_width+rand(1,$this->len);
			$this->get_y();
			$this->get_randcolor();
			imagestring($this->im,$font,$x,$this->y,substr($this->randnum,$i,1),$this->randcolor);
		}
		$this->set_ext_line();
		$this->set_ext_pixel();
		header("content-type:image/png");
		imagepng($this->im);
		imagedestroy($this->im);
	}
}
$an=new Authnum();
$an->ext_num_type='';
$an->ext_pixel=true; //干扰点
$an->ext_line=true; //干扰线
$an->ext_rand_y=true; //Y轴随机
$an->green=238;
$an->create();
$_SESSION['code']=strtolower($an->randnum);
?>