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

	class emailVerifierCommand extends Command
	{
		public function __construct(){
			parent::__construct();
		}

		protected function configure(){
			$this
				->setName('email:verifier')
				->setDescription('Creates a new user.')
				->setHelp('This command allows you to create a user...')
				->addArgument('fileName',InputArgument::REQUIRED,"nameFile");
		}

		protected function execute(InputInterface $input, OutputInterface $output){
			$csv=new CSVfile();
			$email_verifier=new EmailVerifier();
			$fileName=$input->getArgument("fileName");
			$emails=$csv->read_CSV_As_Array($fileName);
			$emails=$email_verifier->check_group_emails($emails);
			$csv->save_Array_As_CSV("incorrect_emails".".csv",$emails["incorrect_emails"]);
			$csv->save_Array_As_CSV("correct_emails".".csv",$emails["correct_emails"]);
			
			$summary=fopen("./var/"."summary.txt","w");
			fwrite($summary, "All Emails ".(count($emails, COUNT_RECURSIVE)-2)."\n");
			fwrite($summary, "Correct Emails ".count($emails["correct_emails"])."\n");
			fwrite($summary, "Incorrect Emails ".count($emails["incorrect_emails"])."\n");
			fclose($summary);

		}
	}