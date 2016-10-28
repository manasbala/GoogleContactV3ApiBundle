<?php

namespace MB\GoogleContactV3ApiBundle\Controller;

use MB\GoogleContactV3ApiBundle\API\GoogleClient;
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

        $em = $this->getDoctrine()->getManager();
        $em->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->update('accessToken', $accessToken->access_token);
        $em->getRepository('MBGoogleContactV3ApiBundle:GoogleApiConfig')->update('accessToken', $accessToken->refresh_token);

        exit('Tokens are saved. Thanks');
    }
}
