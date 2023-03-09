<?php

return [
    'replacement_character'    => function_exists('env') ? env('PROFANITY_REPLACEMENT_CHARACTER', '*') : '*',
    'replacement_length'    => function_exists('env') ? env('PROFANITY_REPLACEMENT_LENGTH', 4) : 4,
    'replacement_languages'    => function_exists('env') ? env('PROFANITY_REPLACEMENT_LANGUAGES', 'en') : 'en',
];
