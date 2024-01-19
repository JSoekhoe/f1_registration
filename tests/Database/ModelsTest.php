<?php

namespace Tests\Database;

use Tests\TestCase;
use App\Models\User;

class ModelsTest extends TestCase
{
public function testUserModel()
{
$user = User::factory()->create();

$this->assertInstanceOf(User::class, $user);
// Add more assertions for testing relationships and model methods
}
}
