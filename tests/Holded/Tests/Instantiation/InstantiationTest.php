<?php

namespace Holded\Tests\Auth;

use Holded\Tests\HoldedTestCase;
use HomedoctorEs\Holded\Resources\Contact;

class InstantiationTest extends HoldedTestCase
{
    
    public function testContactInstance()
    {
        $this->assertInstanceOf(Contact::class, $this->holded->contact());
    }

}