<?php

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