<?php

namespace Bonsai\Api\Endpoint;

use Bonsai\Api\BonsaiApiClient;

/**
 * undocumented class
 */
class BonsaiCreateTransaction extends AbstractBonsaiEndpoint
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
    public function __construct(BonsaiApiClient $api_client) {
        $this->method = BonsaiApiClient::HTTP_POST;
        $this->endpoint = '';
        $this->expected_status_code = 201;
        $this->api_client = $api_client;
    }
}
