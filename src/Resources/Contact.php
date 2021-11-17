<?php

namespace HomedoctorEs\Holded\Resources;

use HomedoctorEs\Holded\Resources\Abstracts\Invoicing;
use HomedoctorEs\Holded\Values\Contact as ContactValue;


/**
 * Crud class to manage contacts
 *
 * @see https://developers.holded.com/reference#contacts
 * @author Juan Solá <juan.sola@homedoctor.es>
 */
class Contact extends Invoicing
{

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return parent::baseUri() . 'contacts';
    }

}