<?php

namespace Bonsai\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Message;
use Composer\CaBundle\CaBundle;
use GuzzleHttp\Exception\GuzzleException;
use Bonsai\Api\Endpoint\BonsaiCancelTransaction;
use Bonsai\Api\Endpoint\BonsaiCreateTransaction;
use Bonsai\Api\Endpoint\BonsaiEndpointInterface;
use Bonsai\Api\Endpoint\BonsaiVerifyTransaction;

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
    public $create_transaction = null;

    /** @var Type $var description */
    public $verify_transaction = null;

    /** @var Type $var description */
    public $cancel_transaction = null;

    /** @var Type $var description */
    public $cancal_all = null;

    /** @var Type $var description */
    protected $guzzle_client = null;

    /** @var Type $var description */
    protected $api_key = null;

    /** @var Type $var description */
    protected $profile_id = null;

    /** @var Type $var description */
    protected $is_test = false;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct($api_key, $profile_id, $transaction_id = null, $is_test = false) {
        $this->api_key              = $api_key;
        $this->profile_id           = $profile_id;
        $this->is_test              = $is_test;

        $this->create_transaction   = new BonsaiCreateTransaction($this);
        $this->verify_transaction   = new BonsaiVerifyTransaction($this, $transaction_id);
        $this->cancel_transaction   = new BonsaiCancelTransaction($this, $transaction_id);
        $this->cancel_all           = new BonsaiCancelAll($this);

        $this->guzzle_client = new Client([
            'base_uri'  => ($is_test ? self::TEST_API_ENDPOINT : self::API_ENDPOINT),
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

        try {
            $response = $this->guzzle_client->request(
                $endpoint->getMethod(),
                $endpoint->getEndpoint(),
                [
                    'json' => $message,
                ]
            );

            $status_code = $response->getStatusCode();
            if($status_code == $endpoint->getExpectedStatusCode()) {
                $body = $response->getBody();
                $res = json_decode((string) $body);

                if(isset($res->paymentURL)) {
                    $res->paymentURL = $res->paymentURL . ($this->is_test ? '?env=pre' : '');
                }

                return $res;
            } else {
                return [
                    'meta' => [
                        'error'         => true,
                        'code'          => $status_code, 
                        'error_type'    => $response->getReasonPhrase(),
                    ],
                ];
            }
        } catch (GuzzleException $e) {
            return [
                'meta' => [
                    'error'         => true,
                    'request'       => Message::toString($e->getRequest()),
                    'response'      => $e->hasResponse() ? Message::toString($e->getResponse()) : null,
                ],
            ];
        }
    }
}
