<?php

namespace Lararole\Tests\Feature;

use DBTruncate\Tests\Models\Post;
use DBTruncate\Tests\Models\User;
use DBTruncate\Tests\TestCase;

class CommandTest extends TestCase
{
    /**
     * @environment-setup useMySqlConnection
     */
    public function testDBTruncateCommand()
    {
        $this->artisan('db:truncate');

        $this->assertEmpty(User::all(), 'Users data should be empty after truncate command.');
        $this->assertEmpty(Post::all(), 'Posts data should be empty after truncate command.');
    }
}
