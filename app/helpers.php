<?php

// Genders...
define('MALE', 'male');
define('FEMALE', 'female');

if (!function_exists('genders')) {
    /**
     * Get current genders.
     *
     * @return \Illuminate\Support\Collection
     */
    function genders() {
        return collect([
            MALE,
            FEMALE
        ]);
    }
}

// Telephone regex..
define('MASKED_TELEPHONE_REGEX', '/^\(([0-9]{3})\) ([0-9]{3})-([0-9]{4})$/');
define('TELEPHONE_REGEX', '/^\+([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})$/');