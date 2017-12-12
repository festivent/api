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

// Price Types...
define('TURKISH_LIRA', 'tl');
define('DOLLAR', 'dollar');

if (!function_exists('priceTypes')) {
    /**
     * Get current price types.
     *
     * @return \Illuminate\Support\Collection
     */
    function priceTypes() {
        return collect([
            TURKISH_LIRA,
            DOLLAR
        ]);
    }
}

if (!function_exists('storage_public_url')) {
    /**
     * Get storage public url.
     *
     * @param $path
     * @return string
     */
    function storage_public_url($path) {
        return Storage::disk('public')->url($path);
    }
}