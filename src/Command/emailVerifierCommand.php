<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 15:09
	 */

	namespace App\Command;


	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Output\OutputInterface;

	use App\Service\CSVfile;
	use App\Service\EmailVerifier;
	use App\Service\GeneratorOfSummary;

	class emailVerifierCommand extends Command
	{
		public function __construct(){
			$this->defaultPath="./var/";
			parent::__construct();
		}

		protected function configure(){
			$this
				->setName('email:verifier')
				->addArgument('fileName',InputArgument::REQUIRED);
		}

		protected function execute(InputInterface $input, OutputInterface $output){
			$csv=new CSVfile($this->defaultPath);
			$email_verifier=new EmailVerifier();
			$fileName=$input->getArgument("fileName");
			$emails=$csv->read_CSV_As_Array($fileName);
			$emails=$email_verifier->check_group_emails($emails);
			$csv->save_Array_As_CSV("incorrect_emails".".csv",$emails["incorrect_emails"]);
			$csv->save_Array_As_CSV("correct_emails".".csv",$emails["correct_emails"]);

			$summary=new GeneratorOfSummary();
			$summary->setDefaultPath($this->defaultPath);
			$summary->setFileName("summary.txt");
			$summary->setNumberAllEmails(count($emails, COUNT_RECURSIVE)-2);
			$summary->setNumberAllCorrectEmails(count($emails["correct_emails"]));
			$summary->setNumberAllIncorrectEmails(count($emails["incorrect_emails"]));
			$summary->generateSummary();
		}
	}