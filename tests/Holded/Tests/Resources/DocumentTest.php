<?php

namespace Holded\Tests\Auth;

use Holded\Tests\HoldedTestCase;

class DocumentTest extends HoldedTestCase
{

    /**
     * @return string[]
     */
    protected function fields(): array
    {
        return [
            'id',
            'contact',
            'contactName',
            'desc',
            'date',
            'dueDate',
            'notes',
            'products',
            'tax',
            'subtotal',
            'discount',
            'total',
            'language',
            'status',
            'customFields',
            'docNumber',
            'currency',
            'currencyChange',
            'paymentsTotal',
            'paymentsPending',
            'paymentsRefunds',
            'from',
        ];
    }

    public function testDocumentList()
    {
        $documents = $this->holded->document()->list();
        $this->assertIsArray($documents);
        $document = $documents[0];
        foreach ($this->fields() as $field) {
            $this->assertArrayHasKey($field, $document);
        }
    }

    public function testDocumentDetail()
    {
        $documents = $this->holded->document()->list();
        $this->assertIsArray($documents);
        $document = $this->holded->document()->get($documents[0]['id']);
        foreach ($this->fields() as $field) {
            $this->assertArrayHasKey($field, $document);
        }
    }

    public function testDocumentInvoiceCreateAndDelete()
    {
        $document = $this->getDocumentData();
        $response = $this->holded->document()->create($document);

        $this->assertEquals(1, $response['status']);
        $id = $response['id'];
        $contactId = $response['contactId'];
        $response = $this->holded->document()->delete($id);
        $this->holded->contact()->delete($contactId);

        $this->assertEquals(1, $response['status']);
        $this->assertEquals('Sucessfully deleted', $response['info']);
    }

    public function testDocumentUpdate()
    {
        $document = $this->getDocumentData();
        $response = $this->holded->document()->create($document);

        $this->assertEquals(1, $response['status']);
        $id = $response['id'];
        $contactId = $response['contactId'];
        $updated = 'Test Updated';
        $response = $this->holded->document()->update($id, ['desc' => $updated]);

        $this->assertEquals(1, $response['status']);
        $this->assertEquals('Updated', $response['info']);

        $document = $this->holded->document()->get($id);
        $this->assertEquals($document['desc'], $updated);

        $this->holded->document()->delete($id);
        $this->holded->contact()->delete($contactId);
    }

    /**
     * @return array
     */
    protected function getDocumentData(): array
    {
        return [
            'contactName' => 'Test Jsm test',
            'contactEmail' => 'test@test.es',
            'date' => time(),
            'items' => [
                [
                    'name' => 'test',
                    'units' => 1,
                    'subtotal' => 10
                ]
            ]
        ];
    }

}