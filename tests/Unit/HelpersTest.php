<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    #[Test]
    public function generate_uuid_returns_valid_uuid_string(): void
    {
        $uuid = generate_uuid();
        $this->assertIsString($uuid);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $uuid
        );
    }

    #[Test]
    public function success_message_returns_correct_structure(): void
    {
        $result = success_message('Done');
        $this->assertTrue($result['status']);
        $this->assertSame('Done', $result['message']);
    }

    #[Test]
    public function error_message_returns_correct_structure(): void
    {
        $result = error_message('Failed');
        $this->assertFalse($result['status']);
        $this->assertSame('Failed', $result['message']);
    }

    #[Test]
    public function is_valid_email_accepts_valid_emails(): void
    {
        $this->assertTrue(is_valid_email('user@example.com'));
        $this->assertTrue(is_valid_email('test+tag@domain.co'));
    }

    #[Test]
    public function is_valid_email_rejects_invalid_emails(): void
    {
        $this->assertFalse(is_valid_email('invalid'));
        $this->assertFalse(is_valid_email('@nodomain.com'));
        $this->assertFalse(is_valid_email('missing@'));
    }

    #[Test]
    public function is_valid_phone_accepts_valid_phones(): void
    {
        $this->assertTrue(is_valid_phone('+201234567890'));
        $this->assertTrue(is_valid_phone('012 345 6789'));
        $this->assertTrue(is_valid_phone('(012) 345-6789'));
    }

    #[Test]
    public function is_valid_phone_rejects_invalid_phones(): void
    {
        $this->assertFalse(is_valid_phone('abc'));
        $this->assertFalse(is_valid_phone('12-abc-34'));
    }

    #[Test]
    public function is_valid_url_accepts_valid_urls(): void
    {
        $this->assertTrue(is_valid_url('https://example.com'));
        $this->assertTrue(is_valid_url('http://test.org/path'));
    }

    #[Test]
    public function is_valid_url_rejects_invalid_urls(): void
    {
        $this->assertFalse(is_valid_url('not-a-url'));
        $this->assertFalse(is_valid_url('example'));
    }

    #[Test]
    public function is_strong_password_requires_length_uppercase_lowercase_and_digit(): void
    {
        $this->assertTrue(is_strong_password('Password1'));
        $this->assertTrue(is_strong_password('MyPass123'));
        $this->assertFalse(is_strong_password('short1A'));
        $this->assertFalse(is_strong_password('nouppercase1'));
        $this->assertFalse(is_strong_password('NOLOWERCASE1'));
        $this->assertFalse(is_strong_password('NoNumbersHere'));
    }

    #[Test]
    public function slugify_returns_slug(): void
    {
        $this->assertSame('hello-world', slugify('Hello World'));
        $this->assertSame('test-slug', slugify('Test Slug'));
    }

    #[Test]
    public function truncate_text_limits_length_with_suffix(): void
    {
        $text = 'This is a long text that should be truncated';
        $result = truncate_text($text, 20);
        $this->assertLessThanOrEqual(23, strlen($result));
        $this->assertStringEndsWith('...', $result);
    }

    #[Test]
    public function truncate_text_returns_full_text_when_shorter_than_limit(): void
    {
        $text = 'Short';
        $this->assertSame('Short', truncate_text($text, 100));
    }

    #[Test]
    public function mask_email_masks_username_part(): void
    {
        $this->assertSame('us**@example.com', mask_email('user@example.com'));
        $this->assertSame('ab@x.co', mask_email('ab@x.co'));
    }

    #[Test]
    public function mask_email_returns_original_for_short_username(): void
    {
        $this->assertSame('a@example.com', mask_email('a@example.com'));
    }

    #[Test]
    public function mask_phone_masks_middle_part(): void
    {
        $masked = mask_phone('0123456789');
        $this->assertStringStartsWith('012', $masked);
        $this->assertStringEndsWith('789', $masked);
        $this->assertStringContainsString('*', $masked);
    }

    #[Test]
    public function format_date_formats_date(): void
    {
        $date = Carbon::parse('2025-01-15 14:30:00');
        $this->assertSame('2025-01-15 14:30:00', format_date($date));
        $this->assertSame('15/01/2025', format_date($date, 'd/m/Y'));
    }

    #[Test]
    public function format_date_returns_empty_for_null(): void
    {
        $this->assertSame('', format_date(null));
    }

    #[Test]
    public function time_ago_returns_human_diff(): void
    {
        $date = Carbon::now()->subMinutes(5);
        $result = time_ago($date);
        $this->assertStringContainsString('5', $result);
    }

    #[Test]
    public function is_today_returns_true_for_today(): void
    {
        $this->assertTrue(is_today(Carbon::today()));
        $this->assertFalse(is_today(Carbon::yesterday()));
    }

    #[Test]
    public function array_to_string_joins_with_separator(): void
    {
        $this->assertSame('a, b, c', array_to_string(['a', 'b', 'c']));
        $this->assertSame('a|b', array_to_string(['a', 'b'], '|'));
    }

    #[Test]
    public function array_to_string_returns_empty_for_non_array(): void
    {
        $this->assertSame('', array_to_string('not-array'));
    }

    #[Test]
    public function pluck_array_returns_column_values(): void
    {
        $arr = [['id' => 1, 'name' => 'A'], ['id' => 2, 'name' => 'B']];
        $this->assertSame([1, 2], pluck_array($arr, 'id'));
    }

    #[Test]
    public function array_has_keys_checks_all_keys_present(): void
    {
        $arr = ['a' => 1, 'b' => 2, 'c' => 3];
        $this->assertTrue(array_has_keys($arr, ['a', 'b']));
        $this->assertFalse(array_has_keys($arr, ['a', 'd']));
    }

    #[Test]
    public function hash_password_hashes_string(): void
    {
        $hashed = hash_password('secret');
        $this->assertNotSame('secret', $hashed);
        $this->assertTrue(verify_password('secret', $hashed));
    }

    #[Test]
    public function verify_password_returns_true_for_correct_password(): void
    {
        $hash = Hash::make('mypass');
        $this->assertTrue(verify_password('mypass', $hash));
        $this->assertFalse(verify_password('wrong', $hash));
    }

    #[Test]
    public function generate_random_string_returns_correct_length(): void
    {
        $str = generate_random_string(16);
        $this->assertSame(16, strlen($str));
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $str);
    }
}
