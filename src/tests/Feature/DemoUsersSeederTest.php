<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\DemoUsersSeeder;
use Spatie\Permission\Models\Role; // استدعاء موديل الـ Role الخاص بمكتبة Spatie

class DemoUsersSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_users_seeder_creates_users_successfully(): void
    {
        // 1. إنشاء الدور الأول عشان مكتبة Spatie تلاقيه قدامها وما تضربش إيرور
        Role::create(['name' => 'Admin']);

        // 2. تشغيل السيدر
        $this->seed(DemoUsersSeeder::class);

        // 3. التحقق من البيانات
        $this->assertDatabaseCount('users', 3); 

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',  
        ]);
    }
}
