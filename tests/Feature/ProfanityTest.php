<?php

namespace Coxlr\Profanity\Tests\Feature;

use Coxlr\Profanity\Profanity;
use Coxlr\Profanity\Tests\TestCase;

class ProfanityTest extends TestCase
{
    protected Profanity $profanity;

    public function setUp() : void
    {
        parent::setUp();

        $this->profanity = new Profanity();
    }

    /** @test */
    public function it_return_the_replacement_value(): void
    {
        $this->assertEquals('****', $this->profanity->replacement());
    }

    /** @test */
    public function it_returns_the_strict_value(): void
    {
        $this->assertEquals(false, $this->profanity->isStrict());
    }

    /** @test */
    public function it_replaces_profanity_with_the_replacement(): void
    {
        $result = $this->profanity->clean('String with profanity shit.');

        $this->assertEquals('String with profanity ****.', $result);
    }

    /** @test */
    public function it_replaces_multiple_profanity_items_in_a_sting_with_the_replacement(): void
    {
        $result = $this->profanity->clean('String with profanity shit multiple times fuck.');

        $this->assertEquals('String with profanity **** multiple times ****.', $result);
    }

    /** @test */
    public function it_returns_if_a_string_is_clean_or_not(): void
    {
        $this->assertEquals(true, $this->profanity->isClean('String without profanity.'));
        $this->assertEquals(false, $this->profanity->isClean('String with profanity shit.'));
        $this->assertEquals(false, $this->profanity->isClean('String with multiple bitch profanity items shit.'));
    }

    /** @test */
    public function it_sets_the_strict_setting(): void
    {
        $this->assertEquals(false, $this->profanity->isStrict());

        $this->profanity->setIsStrict(true);

        $this->assertEquals(true, $this->profanity->isStrict());
    }

    /** @test */
    public function it_sets_the_languages_to_replace(): void
    {
        $this->assertEquals(['en','es'], $this->profanity->replacementLanguages());

        $this->profanity->setLanguages('en,es,fr');

        $this->assertEquals(['en','es','fr'], $this->profanity->replacementLanguages());
    }

    /** @test */
    public function it_replaces_profanity_within_a_word_with_the_replacement_for_profanity_length_in_stict_mode(): void
    {
        $result = $this->profanity->setIsStrict(true)->clean('String with profanity scunthorpe.');

        $this->assertEquals('String with profanity s****horpe.', $result);
    }

    /** @test */
    public function it_replaces_multiple_profanity_items_in_a_sting_within_a_word_with_the_replacement_for_profanity_length_in_stict_mode(): void
    {
        $result = $this->profanity->setIsStrict(true)->clean('String with profanity scunthorpe multiple times scunthorpe.');

        $this->assertEquals('String with profanity s****horpe multiple times s****horpe.', $result);
    }

    /** @test */
    public function it_does_not_replace_profanity_within_a_word_if_stict_mode_is_off(): void
    {
        $this->assertEquals(false, $this->profanity->isStrict());

        $result = $this->profanity->clean('String with profanity scunthorpe.');

        $this->assertEquals('String with profanity scunthorpe.', $result);
    }

    /** @test */
    public function it_does_not_replace_profanity_within_multiple_words_if_stict_mode_is_off(): void
    {
        $this->assertEquals(false, $this->profanity->isStrict());

        $result = $this->profanity->clean('String with profanity scunthorpe multiple times scunthorpe.');

        $this->assertEquals('String with profanity scunthorpe multiple times scunthorpe.', $result);
    }

    /** @test */
    public function it_replaces_profanity_with_the_replacement_for_given_languages(): void
    {
        $result = $this->profanity->setLanguages('en,es,fr,sv')->clean('String with profanity fan.');

        $this->assertEquals('String with profanity ****.', $result);
    }

    /** @test */
    public function it_replaces_multiple_profanity_items_in_a_sting_with_the_replacement_for_given_languages(): void
    {
        $result = $this->profanity->setLanguages('en,es,fr,sv')->clean('String with profanity fan multiple times fuck.');

        $this->assertEquals('String with profanity **** multiple times ****.', $result);
    }

    /** @test */
    public function it_replaces_profanity_items_in_a_sting_within_a_word_with_the_replacement_for_profanity_length_in_stict_mode_for_given_languages(): void
    {
        $result = $this->profanity->setIsStrict(true)->setLanguages('en,es,fr,sv')->clean('String with profanity.');

        $this->assertEquals('String with pro***ity.', $result);
    }

    /** @test */
    public function it_replaces_multiple_profanity_items_in_a_sting_within_a_word_with_the_replacement_for_profanity_length_in_stict_mode_for_given_languages(): void
    {
        $result = $this->profanity->setIsStrict(true)->setLanguages('en,es,fr,sv')->clean('String with profanity multiple times scunthorpe.');

        $this->assertEquals('String with pro***ity multiple times s****horpe.', $result);
    }
}
