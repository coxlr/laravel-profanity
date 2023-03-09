<?php

namespace Coxlr\Profanity\Tests;

use Coxlr\Profanity\Profanity;

class ProfanityServiceProviderTest extends TestCase
{
    /** @test */
    public function it_resolves_from_the_service_container(): void
    {
        $profanity = app('profanity');

        $this->assertInstanceOf(Profanity::class, $profanity);

        $this->assertEquals('****', $profanity->replacement());
        $this->assertEquals(['en','es'], $profanity->replacementLanguages());
    }
}
