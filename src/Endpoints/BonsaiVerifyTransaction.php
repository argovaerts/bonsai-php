<?php

namespace Bonsai\Api\Endpoint;

use Bonsai\Api\BonsaiApiClient;

/**
 * undocumented class
 */
class BonsaiVerifyTransaction implements BonsaiEndpointInterface
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct(BonsaiApiClient $api_client, $transaction_id) {
        $this->method = BonsaiApiClient::HTTP_POST;
        $this->endpoint = '/verify/' . $transaction_id;
        $this->expected_status_code = 200;
        $this->api_client = $api_client;
    }
}