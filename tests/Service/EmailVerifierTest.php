<?php
	/**
	 * Created by PhpStorm.
	 * User: Dell
	 * Date: 13/09/2018
	 * Time: 17:49
	 */

	namespace App\Tests\Service;

	use App\Service\EmailVerifier;
	use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


	class EmailVerifierTest extends TestCase
	{
		public function testCheck_group_emails(){
			$emailVerifier=new EmailVerifier();
			$correct_emails=array("miczab8@wp.pl","biuro@swiatla-poznan.pl","barteksquall@poczta.onet.pl");
			$incorrect_emails=array("daron@.wp.pl","firma@paumil.com","rdombski@lodz2.p.lodz.pl","em36@.interia.pl","t.o.m.h.el.h.u.t.w.alt.e.r.t.o.m.@googlemail.com",'samochód66@o2.pl');
			$correct_results=array(
				"correct_emails"=>$correct_emails,
				"incorrect_emails"=>$incorrect_emails
			);

			$results=$emailVerifier->check_group_emails(array_merge($correct_emails,$incorrect_emails));
			$this->assertArraySubset($correct_results,$results);
		}
	}