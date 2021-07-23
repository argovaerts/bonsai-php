<?php

use Bonsai\Api\BonsaiApiClient;
use PHPUnit\Framework\TestCase;

final class CreateTransactionTest extends TestCase
{
    const API_KEY = 'f975cc5a-ddbe-4fc0-8246-09a35fdb3c09';
    const PROFILE_ID = '09452bea-8bce-41c4-80a1-240f22d8f054';

    protected $client = null;

    /**
     * @before
     */
    public function setupClient(): void
    {
        $this->client = new BonsaiApiClient(self::API_KEY, self::PROFILE_ID, true);
    }

    public function testCreateTransaction(): void
    {
        $output = $this->client->create_transaction->perform([
            'amount'            => '0.01',
            'clientReference'   => 'php test',
        ]);
        $output = json_decode(json_encode($output), true);

        $this->assertArrayHasKey('meta', $output);
        $this->assertEquals($output['meta']['status'], 201);
        $this->assertArrayHasKey('paymentURL', $output);
    }


}