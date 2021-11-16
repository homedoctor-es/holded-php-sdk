<?php

namespace Holded\Tests\Auth;

use Holded\Tests\HoldedTestCase;
use HomedoctorEs\Holded\Exception\UnauthorizedException;
use HomedoctorEs\Holded\Holded;

class AuthTest extends HoldedTestCase
{

    public function testAuthSuccess()
    {
        $contacts = $this->holded->contact()->list();
        $this->assertIsArray($contacts);
    }

    public function testAuthError()
    {
        $this->expectException(UnauthorizedException::class);
        $holded = new Holded('asdasd');
        $holded->contact()->list();
    }

}