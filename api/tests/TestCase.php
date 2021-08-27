<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\MigrateSeedOnce;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
