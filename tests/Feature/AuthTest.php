<?php

namespace Test\Feature;

use App\Model\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase 
{
    public function test_login()
    {
        $user = new User();
        $user = $user->find(1);
    }
}