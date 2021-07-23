<?php

namespace Bonsai\Api\Endpoint;

interface BonsaiEndpointInterface
{
    public function getMethod();
    public function getMessage();
    public function getEndpoint();
    public function getExpectedStatusCode();
    public function getExpectedErrorCode();
    public function perform();
}