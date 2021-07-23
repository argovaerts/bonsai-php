<?php

namespace Bonsai\Api\Endpoint;

use Bonsai\Api\BonsaiApiClient;

/**
 * undocumented class
 */
class BonsaiCreateTransaction implements BonsaiEndpointInterface
{
    /** @var Type $var description */
    protected $method = null;

    /** @var Type $var description */
    protected $message = null;

    /** @var Type $var description */
    protected $endpoint = null;

    /** @var Type $var description */
    protected $expected_status_code = null;

    /** @var Type $var description */
    protected $error_status_code = null;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct() {
        $this->method = BonsaiApiClient::HTTP_POST;
        $this->endpoint = '';
        $this->expected_status_code = 201;
        $this->error_status_code = 400;
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
    public function build($message)
    {
        $this->message = $message;
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
    public function getMethod()
    {
        return $this->method;
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
    public function getMessage()
    {
        return $this->message;
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
    public function getEndpoint()
    {
        return $this->endpoint;
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
    public function getExpectedStatusCode()
    {
        return $this->expected_status_code;
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
    public function getExpectedErrorCode()
    {
        return $this->error_status_code;
    }
}
