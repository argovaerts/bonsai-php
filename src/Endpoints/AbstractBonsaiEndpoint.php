<?php

namespace Bonsai\Api\Endpoint;

abstract class AbstractBonsaiEndpoint
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
    protected $api_client = null;

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
    public function perform(array $message)
    {
        $this->message = $message;
        return $this->api_client->perform($this);
    }
}