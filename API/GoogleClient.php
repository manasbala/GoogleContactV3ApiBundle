<?php
/**
 * Created by PhpStorm.
 * User: manasbala
 * Date: 10/26/16
 * Time: 16:45
 */

namespace MB\GoogleContactV3ApiBundle\API;


class GoogleClient
{
    private $clientId;
    private $clientSecret;
    private $redirectUrl;
    private $developerKey;

    public function __construct($clientId, $clientSecret, $redirectUrl, $developerKey)
    {
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
        /*if (isset($config->refreshToken) && $config->refreshToken) {
            $client->refreshToken($config->refreshToken);
        }*/

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