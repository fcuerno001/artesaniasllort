<?php 
if(!defined('BASEPATH')) exit('No Direct script access allowed');

require_once('PHPExcel/IOFactory.php');

class IOFactory extends PHPExcel_IOFactory
{
	public function __construct()
	{
	 parent::__construct();

	} //Fin Constructor


}


