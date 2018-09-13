<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 23:21
	 */

	namespace App\Tests\Service;

	use App\Service\GeneratorOfSummary;
	use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


	class GeneratorOfSummaryTest extends TestCase
	{

		public function testGenerateSummary()
		{
			$fileName="summary.txt";
			$defaultPath="./tests/var/";

			$summary=new GeneratorOfSummary();
			$summary->setDefaultPath($defaultPath);
			$summary->setFileName($fileName);
			$summary->setNumberAllEmails(100);
			$summary->setNumberAllCorrectEmails(50);
			$summary->setNumberAllIncorrectEmails(50);
			$summary->generateSummary();
			$this->assertFileExists($defaultPath.$fileName);
			$this->assertFileIsReadable($defaultPath.$fileName);
			$this->assertFileIsWritable($defaultPath.$fileName);
			unlink($defaultPath.$fileName);


		}
	}
