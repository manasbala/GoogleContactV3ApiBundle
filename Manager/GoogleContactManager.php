<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/29/16
 * Time: 15:37
 */

namespace MB\GoogleContactV3ApiBundle\Manager;


use MB\GoogleContactV3ApiBundle\API\GoogleClient;
use MB\GoogleContactV3ApiBundle\Model\Contact;

class GoogleContactManager
{
    private $gc;

    public function __construct(GoogleClient $googleClient)
    {
        $this->gc = $googleClient->getClient();
    }

    public function getAllContacts()
    {
        $req = new \Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full?max-results=10000&updated-min=2007-03-16T00:00:00');

        /** @var \Google_Http_Request $val */
        $val = $this->gc->getAuth()->authenticatedRequest($req);
        $response = $val->getResponseBody();
        $code = $val->getResponseHttpCode();

        if ($code != 200) {
            exit($response);
        }

        $xmlContacts = simplexml_load_string($response);
        $xmlContacts->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
        $contactsArray = array();
        foreach ($xmlContacts->entry as $xmlContactsEntry) {
            $contactDetails = array();
            $contactDetails['id'] = (string) $xmlContactsEntry->id;
            $contactDetails['name'] = (string) $xmlContactsEntry->title;
            foreach ($xmlContactsEntry->children() as $key => $value) {
                $attributes = $value->attributes();
                if ($key == 'link') {
                    if ($attributes['rel'] == 'edit') {
                        $contactDetails['editURL'] = (string) $attributes['href'];
                    } elseif ($attributes['rel'] == 'self') {
                        $contactDetails['selfURL'] = (string) $attributes['href'];
                    }
                }
            }
            $contactGDNodes = $xmlContactsEntry->children('http://schemas.google.com/g/2005');
            foreach ($contactGDNodes as $key => $value) {
                switch ($key) {
                    case 'organization':
                        $contactDetails[$key]['orgName'] = (string) $value->orgName;
                        $contactDetails[$key]['orgTitle'] = (string) $value->orgTitle;
                        break;
                    case 'email':
                        $attributes = $value->attributes();
                        $emailadress = (string) $attributes['address'];
                        $emailtype = substr(strstr($attributes['rel'], '#'), 1);
                        $contactDetails[$key][$emailtype] = $emailadress;
                        break;
                    case 'phoneNumber':
                        $attributes = $value->attributes();
                        $uri = (string) $attributes['uri'];
                        $type = substr(strstr($attributes['rel'], '#'), 1);
                        $e164 = substr(strstr($uri, ':'), 1);
                        $contactDetails[$key][$type] = $e164;
                        break;
                    default:
                        $contactDetails[$key] = (string) $value;
                        break;
                }
            }
            $contactsArray[] = $contactDetails;
        }

        dump($contactsArray); exit;

        return $contactsArray;
    }

    /**
     * @param array $details
     * @return bool|Contact
     */
    public static function createContactObj(array $details)
    {
        if (!is_array($details) || empty($details)) {
            return false;
        }

        $c = new Contact();
        $c->setName($details['name']);

        if (isset($details['email'])) {
            if (isset($details['email']['work'])) {
                $c->setWorkEmail($details['email']['work']);
            }

            if (isset($details['email']['home'])) {
                $c->setHomeEmail($details['email']['home']);
            }

            if (isset($details['email']['other'])) {
                $c->setOtherEmail($details['email']['other']);
            }
        }

        if (isset($details['phoneNumber'])) {
            if (isset($details['phoneNumber']['work'])) {
                $c->setWorkPhone($details['phoneNumber']['work']);
            }

            if (isset($details['phoneNumber']['home'])) {
                $c->setHomePhone($details['phoneNumber']['home']);
            }

            if (isset($details['phoneNumber']['other'])) {
                $c->setOtherPhone($details['phoneNumber']['other']);
            }
        }

        if (isset($details['organization'])) {
            if (isset($details['organization']['orgName'])) {
                $c->setCompany($details['organization']['orgName']);
            }
        }

        if (isset($details['postalAddress'])) {
            $c->setAddress($details['postalAddress']);
        }

        return $c;
    }

    public function createContact(Contact $contact)
    {
        $doc = new \DOMDocument();
        $doc->formatOutput = true;
        $entry = $doc->createElement('atom:entry');
        $entry->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:atom', 'http://www.w3.org/2005/Atom');
        $entry->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:gd', 'http://schemas.google.com/g/2005');
        $entry->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:gd', 'http://schemas.google.com/g/2005');
        $doc->appendChild($entry);

        $title = $doc->createElement('title', $contact->getName());
        $entry->appendChild($title);

        $workEmail = $contact->getWorkEmail();
        if (!empty($workEmail)) {
            $email = $doc->createElement('gd:email');
            $email->setAttribute('rel', 'http://schemas.google.com/g/2005#work');
            $email->setAttribute('address', $workEmail);
            $entry->appendChild($email);
        }

        $homeEmail = $contact->getHomeEmail();
        if (!empty($homeEmail)) {
            $email = $doc->createElement('gd:email');
            $email->setAttribute('rel', 'http://schemas.google.com/g/2005#home');
            $email->setAttribute('address', $homeEmail);
            $entry->appendChild($email);
        }

        $otherEmail = $contact->getOtherEmail();
        if (!empty($otherEmail)) {
            $email = $doc->createElement('gd:email');
            $email->setAttribute('rel', 'http://schemas.google.com/g/2005#other');
            $email->setAttribute('address', $otherEmail);
            $entry->appendChild($email);
        }

        $workPhone = $contact->getWorkPhone();
        if (!empty($workHome)) {
            $phone = $doc->createElement('gd:phoneNumber', $workPhone);
            $phone->setAttribute('rel', 'http://schemas.google.com/g/2005#work');
            $entry->appendChild($phone);
        }

        $homePhone = $contact->getHomePhone();
        if (!empty($homePhone)) {
            $phone = $doc->createElement('gd:phoneNumber', $homePhone);
            $phone->setAttribute('rel', 'http://schemas.google.com/g/2005#home');
            $entry->appendChild($phone);
        }

        $otherPhone = $contact->getOtherPhone();
        if (!empty($otherPhone)) {
            $phone = $doc->createElement('gd:phoneNumber', $otherPhone);
            $phone->setAttribute('rel', 'http://schemas.google.com/g/2005#other');
            $entry->appendChild($phone);
        }

        $address = $contact->getAddress();
        if (!empty($address)) {
            $address = $doc->createElement('gd:postalAddress', $address);
            $address->setAttribute('rel', 'http://schemas.google.com/g/2005#other');
            $entry->appendChild($address);
        }

        $company = $contact->getCompany();
        if (!empty($company)) {
            $org = $doc->createElement('gd:organization', $company);
            $org->setAttribute('rel', 'http://schemas.google.com/g/2005#work');
            $orgName = $doc->createElement('gd:orgName', $company);
            $org->appendChild($orgName);
            $entry->appendChild($org);
        }

        $xmlToSend = $doc->saveXML();
        $req = new \Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full');
        $req->setRequestHeaders(array('content-type' => 'application/atom+xml; charset=UTF-8; type=feed'));
        $req->setRequestMethod('POST');
        $req->setPostBody($xmlToSend);

        /** @var \Google_Http_Request $val */
        $val = $this->gc->getAuth()->authenticatedRequest($req);

        if ($val->getResponseHttpCode() == 201) {
            return $contact;
        }

        //echo $val->getResponseHttpCode();
        //$response = $val->getResponseBody();
        //dump($response);

        return false;
    }
}