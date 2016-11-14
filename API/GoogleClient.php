<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/26/16
 * Time: 16:45
 */

namespace MB\GoogleContactV3ApiBundle\API;


use MB\GoogleContactV3ApiBundle\Manager\GoogleApiConfigManager;

class GoogleClient
{
    private $acm;
    private $clientId;
    private $clientSecret;
    private $redirectUrl;
    private $developerKey;

    public function __construct(GoogleApiConfigManager $acm, $clientId, $clientSecret, $redirectUrl, $developerKey)
    {
        $this->acm = $acm;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;
        $this->developerKey = $developerKey;
    }

    /**
     * @return \Google_Client
     */
    public function getClient()
    {
        $client = new \Google_Client();
        $client->setApplicationName('Google Contacts API');
        $client->setScopes(array('https://www.google.com/m8/feeds/'));
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUrl);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setDeveloperKey($this->developerKey);

        $refreshToken = $this->acm->get('refresh_token');
        if (!empty($refreshToken)) {
            $client->refreshToken($refreshToken);
        }

        return $client;
    }

    /**
     * @param \Google_Client $client
     * @return string
     */
    public static function getAuthUrl(\Google_Client $client)
    {
        return $client->createAuthUrl();
    }

    /**
     * @param \Google_Client $client
     * @param $code
     */
    public static function authenticate(\Google_Client $client, $code)
    {
        $client->authenticate($code);
    }

    /**
     * @param \Google_Client $client
     * @return mixed
     */
    public static function getAccessToken(\Google_Client $client)
    {
        return json_decode($client->getAccessToken());
    }
}