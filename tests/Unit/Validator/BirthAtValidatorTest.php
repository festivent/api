<?php

namespace Tests\Unit\Validator;

use Carbon\Carbon;
use Tests\TestCase;
use Validator;

class BirthAtValidatorTest extends TestCase
{
    /** @test */
    public function testPassMoreThan13Age()
    {
        $birthAt = Carbon::now()->addYears(-14)->toDateString();

        $this->assertTrue($this->validate($birthAt));
    }

    /** @test */
    public function testPassLessThan100Age()
    {
        $birthAt = Carbon::now()->addYears(-99)->toDateString();

        $this->assertTrue($this->validate($birthAt));
    }

    /** @test */
    public function testPass13Age()
    {
        $birthAt = Carbon::now()->addYears(-13)->toDateString();

        $this->assertTrue($this->validate($birthAt));
    }

    /** @test */
    public function testPass100Age()
    {
        $birthAt = Carbon::now()->addYears(-100)->toDateString();

        $this->assertTrue($this->validate($birthAt));
    }

    /** @test */
    public function testNotPassLessThan13Age()
    {
        $birthAt = Carbon::now()->addYears(-12)->toDateString();

        $this->assertFalse($this->validate($birthAt));
    }

    /** @test */
    public function testNotPassMoreThan100Age()
    {
        $birthAt = Carbon::now()->addYears(-101)->toDateString();

        $this->assertFalse($this->validate($birthAt));
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
            'data' => 'birth_at'
        ])->passes();
    }
}
