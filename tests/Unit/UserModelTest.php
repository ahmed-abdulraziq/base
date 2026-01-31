<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_be_created_with_fillable_attributes(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
        ]);
        $this->assertInstanceOf(User::class, $user);
        $this->assertNotNull($user->password);
    }

    #[Test]
    public function password_is_hashed_on_set(): void
    {
        $user = User::factory()->create(['password' => 'plaintext']);
        $this->assertNotSame('plaintext', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('plaintext', $user->password));
    }

    #[Test]
    public function email_verified_at_is_cast_to_datetime(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
    }

    #[Test]
    public function user_has_expected_fillable_attributes(): void
    {
        $user = new User();
        $fillable = ['name', 'email', 'password', 'google_id', 'avatar'];
        $this->assertSame($fillable, $user->getFillable());
    }

    #[Test]
    public function user_hides_password_and_remember_token(): void
    {
        $user = User::factory()->create();
        $array = $user->toArray();
        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }
}
