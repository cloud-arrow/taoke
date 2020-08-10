<?php

namespace CloudArrow\Taoke\Tests\Pinduoduo;

use CloudArrow\Taoke\Pinduoduo\Pinduoduo;
use PHPUnit\Framework\TestCase;

class PinduoduoTest extends TestCase
{
    public function testGetPidList()
    {
        $clientId = '0735c766d6514680b5695638791a7ed7';
        $clientSecret = '78abb57ec256be98bc90fe6e3b1439bae9ba03a2';
        $service = new Pinduoduo($clientId, $clientSecret);
        $rs = $service->getPidList();
        $this->assertArrayHasKey('p_id_query_response', $rs);
    }
}
