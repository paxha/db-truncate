<?php

namespace DBTruncate\Tests;

use DBTruncate\Tests\Models\Post;
use DBTruncate\Tests\Models\User;
use Illuminate\Support\Facades\DB;
use DBTruncate\DBTruncateServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->withFactories(__DIR__ . '/database/factories');

        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $this->assertContainsEquals('users', $tables, 'users table must be exists');
        $this->assertContainsEquals('posts', $tables, 'posts table must be exists');

        $this->seeds();
    }

    protected function getPackageProviders($app)
    {
        return [
            DBTruncateServiceProvider::class,
        ];
    }

    protected function seeds()
    {
        factory(User::class, 10)->create();
        factory(Post::class, 10)->create();

        $this->assertNotEmpty(User::all(), 'Users data not be empty');
        $this->assertNotEmpty(Post::all(), 'Posts data not be empty');
    }
}
