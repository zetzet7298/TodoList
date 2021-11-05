<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use TodoList\Models\Validation;

class ValidationTest extends TestCase

{
    public function testCheckNull()
    {
        $validator = new Validation();

        $result = $validator->checkNull('');
        $this->assertFalse($result);

        $result = $validator->checkNull('foo');
        $this->assertEquals('foo', $result);
    }

    public function testCheckMaxLength()
    {
        $validator = new Validation();
        $length = 128;

        $str = str_repeat('a', $length + 1);
        $result = $validator->checkMaxLength($str, $length);
        $this->assertFalse($result);

        $str = str_repeat('a', $length);
        $result = $validator->checkMaxLength($str, $length);
        $this->assertEquals(str_repeat('a', $length), $result);
    }

    public function testCheckDateFromAndDateTo()
    {
        $validator = new Validation();

        $startingDate = time();
        $endingDate = time() - 3600;
        $result = $validator->checkDateFromAndDateTo($startingDate, $endingDate);
        $this->assertFalse($result);

        $endingDate = time();
        $result = $validator->checkDateFromAndDateTo($startingDate, $endingDate);
        $this->assertFalse($result);

        $endingDate = time() + 3600;
        $result = $validator->checkDateFromAndDateTo($startingDate, $endingDate);
        $this->assertEquals(time() + 3600, $result);
    }
}