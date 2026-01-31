<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_uses_admins_table(): void
    {
        $admin = new Admin();
        $this->assertSame('admins', $admin->getTable());
    }

    #[Test]
    public function admin_can_be_created_with_fillable_attributes(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $this->assertDatabaseHas('admins', [
            'email' => 'admin@example.com',
            'name' => 'Admin User',
        ]);
        $this->assertInstanceOf(Admin::class, $admin);
    }

    #[Test]
    public function admin_role_attribute_returns_admin_when_no_roles(): void
    {
        $admin = Admin::factory()->create();
        $this->assertSame('admin', $admin->role);
    }

    #[Test]
    public function admin_password_is_hashed(): void
    {
        $admin = Admin::factory()->create(['password' => 'secret']);
        $this->assertNotSame('secret', $admin->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('secret', $admin->password));
    }
}
