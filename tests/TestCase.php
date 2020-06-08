<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function actingAsSanctumUser()
    {
      return  Sanctum::actingAs(factory(User::class)->create());
    }

    public function require_message($field)
    {

      return "The {$field} field is required.";
    }
}
