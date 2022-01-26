<?php

namespace Holded\Tests\Instantiation;

use Holded\Tests\HoldedTestCase;
use HomedoctorEs\Holded\Exception\DocumentNotAllowedException;
use HomedoctorEs\Holded\Exception\ResourceNotFoundException;
use HomedoctorEs\Holded\Resources\Contact;
use HomedoctorEs\Holded\Resources\Document;

class InstantiationTest extends HoldedTestCase
{
    
    public function testNotFoundClassError()
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->holded->badClass();
    }
    
    public function testContactInstance()
    {
        $this->assertInstanceOf(Contact::class, $this->holded->contact());
    }
    
    public function testDocumentInstance()
    {
        $documentInstance = $this->holded->document();
        $this->assertInstanceOf(Document::class, $documentInstance);
        $this->assertEquals(Document::INVOICE, $documentInstance->getDocType());
    }
    
    public function testDocumentInstancePassingDocType()
    {
        $documentInstance = $this->holded->document(Document::CREDIT_NOTE); 
        $this->assertInstanceOf(Document::class, $documentInstance);
        $this->assertEquals(Document::CREDIT_NOTE, $documentInstance->getDocType());
    }
    
    public function testErrorDocumentInstancePassingBadDocType()
    {
        $this->expectException(DocumentNotAllowedException::class);
        $this->assertInstanceOf(Document::class, $this->holded->document("badType"));
    }

}