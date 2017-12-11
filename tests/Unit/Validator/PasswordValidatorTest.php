<?php

namespace Tests\Unit\Validator;

use Tests\TestCase;
use Validator;

class PasswordValidatorTest extends TestCase
{
    /** @test */
    public function testPassValidPassword()
    {
        $this->assertTrue($this->validate('SomeSecret10'));
    }

    /** @test */
    public function testNotPassLowercasePassword()
    {
        $this->assertFalse($this->validate('lowercase'));
    }

    /** @test */
    public function testNotPassLowercaseAndNumberPassword()
    {
        $this->assertFalse($this->validate('lowercase10'));
    }

    /** @test */
    public function testNotPassLowercaseAndUppercasePassword()
    {
        $this->assertFalse($this->validate('lowercaseUp'));
    }

    /** @test */
    public function testNotPassNumberPassword()
    {
        $this->assertFalse($this->validate('123456'));
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
            'data' => 'password'
        ])->passes();
    }
}
