<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 22:56
	 */

	namespace App\Service;


	class GeneratorOfSummary
	{
		private $defaultPath;
		private $fileName;
		private $numberAllEmails;
		private $numberAllCorrectEmails;
		private $numberAllIncorrectEmails;


		public function setDefaultPath($defaultPath){
			$this->defaultPath=$defaultPath;
		}

		public function setFileName($fileName){
			$this->fileName=$fileName;
		}

		public function setNumberAllEmails($number){
			$this->numberAllEmails=$number;
		}

		public function setNumberAllCorrectEmails($number){
			$this->numberAllCorrectEmails=$number;
		}

		public function setNumberAllIncorrectEmails($number){
			$this->numberAllIncorrectEmails=$number;
		}

		public function generateSummary(){
			$summary=fopen($this->defaultPath.$this->fileName,"w");
			fwrite($summary, "All Emails ".$this->numberAllEmails."\n");
			fwrite($summary, "Correct Emails ".$this->numberAllCorrectEmails."\n");
			fwrite($summary, "Incorrect Emails ".$this->numberAllIncorrectEmails);
			fclose($summary);

		}

	}