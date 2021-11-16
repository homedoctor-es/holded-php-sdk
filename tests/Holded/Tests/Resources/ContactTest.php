<?php

namespace Holded\Tests\Auth;

use Holded\Tests\HoldedTestCase;

class ContactTest extends HoldedTestCase
{

    /**
     * @return string[]
     */
    protected function fields(): array
    {
        return [
            'id',
            'customId',
            'name',
            'code',
            'tradeName',
            'email',
            'mobile',
            'phone',
            'type',
            'iban',
            'swift',
            'groupId',
            'clientRecord',
            'supplierRecord',
            'billAddress',
            'customFields',
            'defaults',
            'socialNetworks',
            'tags',
            'notes',
            'contactPersons',
            'shippingAddresses',
            'isperson'
        ];
    }

    public function testContactList()
    {
        $contacts = $this->holded->contact()->list();
        $this->assertIsArray($contacts);
        $contact = $contacts[0];
        foreach ($this->fields() as $field) {
            $this->assertArrayHasKey($field, $contact);
        }
    }
    
    public function testContactDetail()
    {
        $contacts = $this->holded->contact()->list();
        $contact = $this->holded->contact()->get($contacts[0]['id']);

        foreach ($this->fields() as $field) {
            $this->assertArrayHasKey($field, $contact);
        }
    }

}