<?php

namespace Tests\Database;

use Tests\TestCase;

class MigrationsTest extends TestCase
{

    public function testDatabaseMigrations()
    {
        $this->artisan('migrate:refresh');
    }
}
