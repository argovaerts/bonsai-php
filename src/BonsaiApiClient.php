<?php

namespace Bonsai\Api;

use Composer\CaBundle\CaBundle;

class BonsaiApiClient
{
    /**
     * Version of our client.
     */ 
    const CLIENT_VERSION = '0.0.1';

    /**
     * Endpoint of the remote API
     */
    const API_ENDPOINT = 'https://api.paybonsai.com/api/internetpayments/';

    /**
     * Test endpoint of the remote API
     */
    const TEST_API_ENDPOINT = 'https://api-pp.paybonsai.com/api/internetpayments/';

    /**
     * HTTP Methods
     */
    const HTTP_POST = 'POST';
    const HTTP_DELETE = 'DELETE';

    /** @var Type $var description */
    protected $create_transaction = null;

    /** @var Type $var description */
    protected $verify_transaction = null;

    /** @var Type $var description */
    protected $cancel_transaction = null;

    /** @var Type $var description */
    protected $cancal_all = null;

    /** @var Type $var description */
    protected $guzzle_client = null;

    /** @var Type $var description */
    protected $api_key = null;

    /** @var Type $var description */
    protected $profile_id = null;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct($api_key, $profile_id, $isTest = false) {
        $this->api_key = $api_key;
        $this->profile_id = $profile_id;

        $this->create_transaction = new BonsaiCreateTransaction();

        $this->guzzle_client = new Client([
            'base_uri'  => ($isTest ? self::TEST_API_ENDPOINT : self::API_ENDPOINT);,
            'timeout'   => 2,
            'verify'    => CaBundle::getSystemCaRootBundlePath(),
            'headers'   => [
                'Content-Type'  => 'aplication/json',
                'Accept'        => 'application/json',
            ],
        ]);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function perform(BonsaiEndpointInterface $endpoint)
    {
        $message = $endpoint->getMessage();
        $message['apiKey'] = $this->api_key;
        $message['profileID'] = $this->profile_id;

        $response = $this->guzzle_client->request(
            $endpoint->getMethod(),
            $endpoint->getEndpoint(),
            [
                'json' =>$message,
            ]
        );

        $status_code = $response->getStatusCode()
        if($status_code == $endpoint->getExpectedStatusCode()) {
            $body = $response->getBody();
            return json_decode((string) $body);
        } elseif ($status_code == $endpoint->getExpectedErrorCode()) {
            $body = $response->getBody();
            return json_decode((string) $body);
        } else {
            return [
                'meta' => [
                    'code'          => $status_code, 
                    'error_type'    => $response->getReasonPhrase(),
                ],
            ];
        }
    }
}