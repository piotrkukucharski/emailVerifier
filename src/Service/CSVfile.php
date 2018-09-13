<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 15:15
	 */

	namespace App\Service;


	class CSVfile
	{
		public function __construct(){
			$this->defaultPath="./var/";
		}

		public function read_CSV_As_Array($fileName){
			return file($this->defaultPath.$fileName);
		}
		public function save_Array_As_CSV($fileName,$contentToSave){
			$file=fopen($this->defaultPath.$fileName,'w');
			fputcsv($file, $contentToSave,"\n");
			fclose($file);
		}
	}