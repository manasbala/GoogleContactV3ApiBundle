<?php

namespace MB\GoogleContactV3ApiBundle\Controller;

use MB\GoogleContactV3ApiBundle\API\GoogleClient;
use MB\GoogleContactV3ApiBundle\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthController extends Controller
{
    public function indexAction()
    {
        $client = $this->get('mb_google_contact_v3api.api.google_client');
        $gClient = $client->getClient();

        $authUrl = GoogleClient::getAuthUrl($gClient);

        return $this->render('MBGoogleContactV3ApiBundle:Auth:index.html.twig', array('auth_url' => $authUrl));
    }

    public function authAction()
    {
        $request = $this->get('request_stack');
        $code = $request->getMasterRequest()->query->get('code', false);
        if (!$code) {
            die('No code URL paramete present.');
        }

        $client = $this->get('mb_google_contact_v3api.api.google_client')->getClient();

        GoogleClient::authenticate($client, $code);

        $accessToken = GoogleClient::getAccessToken($client);
        dump($accessToken);

        $configManager = $this->get('mb_google_contact_v3api.api.google_api_config_manager');
        $configManager->update('access_token', $accessToken->access_token);
        $configManager->update('refresh_token', $accessToken->refresh_token);

        exit('Tokens are saved. Thanks');
    }

    public function testAction()
    {

        $gcm = $this->get('mb_google_contact_v3api.api.google_contact_manager');

        $contact = new Contact();
        $contact->setName('Test Name')
            ->setWorkEmail('test1@gmail.com')
            ->setHomeEmail('test2@gmail.com')
            ->setOtherEmail('test3@gmail.com')
            ->setWorkPhone('01711111111')
            ->setHomePhone('01722222222')
            ->setOtherPhone('01733333333')
            ->setCompany('offBeat')
            ->setAddress('583, anamica concord, mirpur, dhaka');

        $r = $gcm->createContact($contact);

        dump($r);
        exit();

        /*$gcm = $this->get('mb_google_contact_v3api.api.google_contact_manager');

        $contacts = $gcm->getAllContacts();

        dump($contacts);
        exit();*/
    }
}
