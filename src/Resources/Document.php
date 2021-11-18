<?php

namespace HomedoctorEs\Holded\Resources;

use HomedoctorEs\Holded\ConfigInterface;
use HomedoctorEs\Holded\Exception\DocumentNotAllowedException;
use HomedoctorEs\Holded\Resources\Abstracts\Invoicing;


/**
 * Crud class to manage documents
 *
 * @see https://developers.holded.com/reference#documents
 * @author Juan Solá <juan.sola@homedoctor.es>
 */
class Document extends Invoicing
{

    const CREDIT_NOTE = 'creditnote';
    const ESTIMATE = 'estimate';
    const INVOICE = 'invoice';
    const PROFORM = 'proform';
    const PURCHASE = 'purchase';
    const PURCHASE_ORDER = 'purchaseorder';
    const PURCHASE_REFUND = 'purchaserefund';
    const SALES_ORDER = 'salesorder';
    const SALES_RECEIPT = 'salesreceipt';
    const WAYBILL = 'waybill';

    protected $docType = self::INVOICE; 
    
    protected $docTypes = [
        self::CREDIT_NOTE,
        self::ESTIMATE,
        self::INVOICE,
        self::PROFORM,
        self::PURCHASE,
        self::PURCHASE_ORDER,
        self::PURCHASE_REFUND,
        self::SALES_ORDER,
        self::SALES_RECEIPT,
        self::WAYBILL
    ];

    /**
     * @throws DocumentNotAllowedException
     */
    public function __construct(ConfigInterface $config, $docType = null)
    {
        if ($docType !== null) {
            $this->setDocType($docType);
        }
        parent::__construct($config);
    }

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return parent::baseUri() . 'documents/' . $this->docType;
    }

    /**
     * @return string
     */
    public function getDocType(): string
    {
        return $this->docType;
    }

    /**
     * @param $type
     * @return Document
     * @throws DocumentNotAllowedException
     */
    public function setDocType($type): Document
    {
        if (!in_array($type, $this->docTypes, true)) {
             throw new DocumentNotAllowedException(); 
        }
        $this->docType = $type;
        return $this;
    }


    /**
     * Returns a pdf in base64 format
     * 
     * @param $id
     * @return array
     */
    public function pdf($id): array
    {
        return $this->_get($id . '/pdf');    
    }

}