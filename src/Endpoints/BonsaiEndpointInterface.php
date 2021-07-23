<?php

namespace Bonsai\Api\Endpoint;

interface BonsaiEndpointInterface
{
    public function getMethod();
    public function getMessage();
    public function getEndpoint();
    public function getExpectedStatusCode();
    public function perform(array $message);
}