<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 14/09/2018
	 * Time: 00:48
	 */

	namespace App\Tests\Command;

	use App\Command\EmailVerifierCommand;

	use Symfony\Bundle\FrameworkBundle\Console\Application;
	use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
	use Symfony\Component\Console\Tester\CommandTester;



	class EmailVerifierCommandTest extends KernelTestCase
	{
		public function testExecute()
		{
			$defaultPath="./tests/var/";
			$fileName="summary.txt";

			$kernel = static::createKernel();
			$kernel->boot();

			$application = new Application($kernel);

			$command = $application->find('email:verifier');
			$commandTester = new CommandTester($command);
			$commandTester->execute(array(
				'command'  => $command->getName(),
				'fileName' => 'data.csv',
				'defaultPath' => $defaultPath,
			));

			$output = $commandTester->getDisplay();
			$this->assertFileExists($defaultPath.$fileName);
			$this->assertFileIsReadable($defaultPath.$fileName);
			$this->assertFileIsWritable($defaultPath.$fileName);
			$this->assertContains("Done", $output);
			unlink($defaultPath."summary.txt");
			unlink($defaultPath."correct_emails.csv");
			unlink($defaultPath."incorrect_emails.csv");


		}

	}