<?php

namespace Coxlr\Profanity;

class Profanity
{
    public mixed $dictionary;
    public string $replacementCharacter;
    public int $replacementLength;
    public string $replacementLanguages;
    public bool $isStrict = false;

    public function __construct()
    {
        $this->replacementCharacter = config('profanity.replacement_character');
        $this->replacementLength = config('profanity.replacement_length');
        $this->replacementLanguages = config('profanity.replacement_languages');
        $this->setDictionary();
    }

    public function setIsStrict(bool $isStrict): self
    {
        $this->isStrict = $isStrict;

        return $this;
    }

    public function replacementLanguages(): array
    {
        return explode(',', $this->replacementLanguages);
    }

    public function replacement(?int $length = null): string
    {
        return str_repeat($this->replacementCharacter, $length ?? $this->replacementLength);
    }

    public function isStrict(): bool
    {
        return $this->isStrict;
    }

    private function setDictionary(): void
    {
        $this->dictionary = json_decode(file_get_contents(__DIR__.'/Dictionary/Profanity.json'), true);
    }

    public function setLanguages(string $languages): self
    {
        $this->replacementLanguages = $languages;

        return $this;
    }
    public function isClean(string $text = ''): bool
    {
        return count($this->flaggedWords($text)) === 0;
    }

    private function flaggedWords(string $text): array
    {
        return collect($this->dictionary)
            ->filter(fn ($value) => in_array($value['language'], $this->replacementLanguages(), true))
            ->filter(function ($value) use ($text) {
                $matches = [];
                if ($this->isStrict()) {
                    return (bool)preg_match('/'.$value['word'].'/iu', $text, $matches, PREG_UNMATCHED_AS_NULL);
                }
                $pattern = "/\b{$value['word']}\b/iu";

                return (bool)preg_match($pattern, $text, $matches, PREG_UNMATCHED_AS_NULL);
            })
            ->map(fn ($value) => [
                'language' => $value['language'],
                'word' => $value['word'],
            ])
            ->toArray();
    }

    public function clean(string $text = ''): string
    {
        $flaggedWords = collect($this->flaggedWords($text))->pluck('word')->toArray();

        foreach ($flaggedWords as $word) {
            if ($this->isStrict()) {
                $text = preg_replace('/'.$word.'/iu', $this->replacement(strlen($word)), $text);
            } else {
                $text = preg_replace("/\b".$word."\b/iu", $this->replacement(), $text);
            }
        }

        return $text;
    }
}
