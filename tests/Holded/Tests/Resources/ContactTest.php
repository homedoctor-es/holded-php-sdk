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
        foreach ($contact as $key => $field) {
            $this->assertContains($key, $this->fields());
        }
    }
    
    public function testContactCreateAndDelete()
    {
        $contact = [
            'name' => 'Test Jsm test',
            'email' => 'test@test.es',
            'phone' => '+34666555444'
        ];
        $response = $this->holded->contact()->create($contact);

        $this->assertEquals(1, $response['status']);
        $this->assertEquals('Created', $response['info']);
        $id = $response['id'];
        $response = $this->holded->contact()->delete($id);

        $this->assertEquals(1, $response['status']);
        $this->assertEquals('Deleted ok', $response['info']);
        $this->assertEquals($response['id'], $id);
    }
    
    public function testContactUpdate()
    {
        $contact = [
            'name' => 'Test Jsm test',
            'email' => 'test@test.es',
            'phone' => '+34666555444'
        ];
        $response = $this->holded->contact()->create($contact);

        $id = $response['id'];
        $name = 'Test Updated';
        $response = $this->holded->contact()->update($id, ['name' => $name]);

        $this->assertEquals(1, $response['status']);
        $this->assertEquals('Updated', $response['info']);
        $this->assertEquals($response['id'], $id);
        
        $contact = $this->holded->contact()->get($id);
        $this->assertEquals($contact['name'], $name);

        $this->holded->contact()->delete($id);
    }

}