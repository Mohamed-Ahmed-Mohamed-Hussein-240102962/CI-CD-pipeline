<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\DemoUsersSeeder;

class DemoUsersSeederTest extends TestCase
{
    use RefreshDatabase; // بيعمل Reset لقاعدة البيانات بعد كل تيست عشان يفضل نضيف

    public function test_demo_users_seeder_creates_users_successfully(): void
    {
        $this->seed(DemoUsersSeeder::class);

        $this->assertDatabaseCount('users', 3); // غير الرقم حسب عدد المستخدمين جوه ملف السيدر بتاعك

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com', 
        ]);
    }
}
