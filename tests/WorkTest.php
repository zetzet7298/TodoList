<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use TodoList\Models\WorkModel;

class WorkTest extends TestCase

{
    private $model;

    public function testInit()
    {
        $workModel = new WorkModel();
        $value = true;
        $this->assertTrue($value);
    }
}