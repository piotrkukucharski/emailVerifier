<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 16:41
	 */

	namespace App\Service;

	use Egulias\EmailValidator\EmailValidator;
	use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
	use Egulias\EmailValidator\Validation\DNSCheckValidation;
	use Egulias\EmailValidator\Validation\RFCValidation;
	use Egulias\EmailValidator\Validation\NoRFCWarningsValidation;
	use Egulias\EmailValidator\Validation\SpoofCheckValidation;



	class EmailVerifier
	{
		public function check_group_emails($emails){
			$correct_emails=[];
			$incorrect_emails=[];
			foreach ($emails as $email){
				$trimmed_email=trim($email);
				if($this->check_one_email_by_regex($trimmed_email)){
					if($this->check_one_email_by_Egulias(($trimmed_email))){
						$correct_emails[]=$trimmed_email;
					}else{
						$incorrect_emails[]=$trimmed_email;
					}
				}else{
					$incorrect_emails[]=$trimmed_email;
				}
			}
			return array("correct_emails"=>$correct_emails,"incorrect_emails"=>$incorrect_emails);
		}

		private function check_one_email_by_regex($email){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				return true;
			}else{
				return false;
			}
		}

		private function check_one_email_by_Egulias($email){
			$validator = new EmailValidator();
			$multipleValidations = new MultipleValidationWithAnd([
				new RFCValidation(),
				new DNSCheckValidation(),
				new NoRFCWarningsValidation(),
				new SpoofCheckValidation(),

			]);
			return $validator->isValid($email, $multipleValidations);
		}
	}