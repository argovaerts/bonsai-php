<?php

namespace Bonsai\Api\Endpoint;

use Bonsai\Api\BonsaiApiClient;

/**
 * undocumented class
 */
class BonsaiCancelAll implements BonsaiEndpointInterface
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
        $this->method = BonsaiApiClient::HTTP_DELETE;
        $this->endpoint = '/cancelall';
        $this->expected_status_code = 204;
        $this->api_client = $api_client;
    }
}