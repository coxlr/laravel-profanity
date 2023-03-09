<?php

namespace Coxlr\Profanity\Tests;

use Coxlr\Profanity\ProfanityServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ProfanityServiceProvider::class,
        ];
    }
}
