<?php

namespace HomedoctorEs\Holded\Resources;


/**
 * Descriptive class to be used as invoice docType Document
 *
 * @see https://developers.holded.com/reference#documents
 * @author Juan Solá <juan.sola@homedoctor.es>
 */
class Invoice extends Document
{

    protected $docType = self::INVOICE;

}