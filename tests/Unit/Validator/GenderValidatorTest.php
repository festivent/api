<?php

namespace Tests\Unit\Validator;

use Tests\TestCase;
use Validator;

class GenderValidatorTest extends TestCase
{
    /** @test */
    public function testPassMaleGender()
    {
        $this->assertTrue($this->validate(MALE));
    }

    /** @test */
    public function testPassFemaleGender()
    {
        $this->assertTrue($this->validate(FEMALE));
    }

    /** @test */
    public function testNotPassInvalidGender()
    {
        $this->assertFalse($this->validate(str_random()));
    }

    /**
     * Validate
     *
     * @param $data
     * @return bool
     */
    protected function validate($data)
    {
        return Validator::make([
            'data' => $data
        ], [
            'data' => 'gender'
        ])->passes();
    }
}
