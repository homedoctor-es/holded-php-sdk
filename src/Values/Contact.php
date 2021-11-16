<?php

namespace HomedoctorEs\Holded\Values;

use HomedoctorEs\Holded\Values\Abstracts\Value;

/**
 * Class Contact
 *
 * @author Juan Solá <juan.sola@homedoctor.es>
 *
 * @property null|string CustomId
 * @property string name
 * @property string code
 * @property string email
 * @property string mobile
 * @property string phone
 * @property string type Options: supplier, debtor, creditor, client, lead
 * @property bool isperson When true the contact is created as a Contact Person instead of as a Company
 * @property string iban
 * @property string swift
 * @property string sepaRef
 * @property string groupId
 * @property string taxOperation options for Spain (general, intra, impexp, nosujeto, receq, exento)
 * @property float sepaDate
 * @property int clientRecord
 * @property int supplierRecord
 * @property array billAddress see https://developers.holded.com/reference#create-contact-1 for fields
 * @property array numberingSeries see https://developers.holded.com/reference#create-contact-1 for fields
 * @property array shippingAddresses see https://developers.holded.com/reference#create-contact-1 for fields
 * @property array defaults
 * @property string[] tags
 * @property string note
 * @property array contactPersons ContactContact object array
 */
class Contact extends Value
{

}