<?php
use PHPUnit\Framework\TestCase;
use Daylight\Invitation\Invitation;
use Illuminate\Support\MessageBag;

require_once 'vendor/autoload.php';

class InvitationTest extends TestCase
{

    private $regulator;

	use DatabaseTransactions;

	public function setUp()
	{
		parent::setUp();

	}

	public function tearDown()
	{
		parent::tearDown();
	}

}
