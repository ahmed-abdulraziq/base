<?php

namespace Tests\Unit;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AttachmentModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function attachment_url_attribute_returns_asset_path(): void
    {
        $attachment = new Attachment(['path' => 'uploads/file.jpg']);
        $this->assertStringContainsString('uploads/file.jpg', $attachment->url);
    }

    #[Test]
    public function human_size_formats_bytes_correctly(): void
    {
        $attachment = new Attachment(['size' => 1024]);
        $this->assertSame('1024 B', $attachment->human_size);

        $attachment->size = 2048;
        $this->assertSame('2 KB', $attachment->human_size);

        $attachment->size = 1536;
        $this->assertSame('1.5 KB', $attachment->human_size);

        $attachment->size = 500;
        $this->assertSame('500 B', $attachment->human_size);
    }

    #[Test]
    public function is_image_returns_true_for_image_extensions(): void
    {
        $this->assertTrue((new Attachment(['extension' => 'jpg']))->isImage());
        $this->assertTrue((new Attachment(['extension' => 'png']))->isImage());
        $this->assertTrue((new Attachment(['extension' => 'webp']))->isImage());
    }

    #[Test]
    public function is_image_returns_false_for_non_image_extensions(): void
    {
        $this->assertFalse((new Attachment(['extension' => 'pdf']))->isImage());
        $this->assertFalse((new Attachment(['extension' => 'doc']))->isImage());
    }

    #[Test]
    public function scope_images_filters_by_image_extensions(): void
    {
        $user = User::factory()->create();
        Attachment::factory()->forUser($user)->create(['extension' => 'jpg']);
        Attachment::factory()->forUser($user)->create(['extension' => 'pdf']);
        Attachment::factory()->forUser($user)->create(['extension' => 'png']);

        $images = Attachment::images()->get();
        $this->assertCount(2, $images);
        $extensions = $images->pluck('extension')->toArray();
        $this->assertContains('jpg', $extensions);
        $this->assertContains('png', $extensions);
        $this->assertNotContains('pdf', $extensions);
    }

    #[Test]
    public function scope_of_type_filters_by_type(): void
    {
        $user = User::factory()->create();
        Attachment::factory()->forUser($user)->create(['type' => 'avatar']);
        Attachment::factory()->forUser($user)->create(['type' => 'document']);
        Attachment::factory()->forUser($user)->create(['type' => 'avatar']);

        $avatars = Attachment::ofType('avatar')->get();
        $this->assertCount(2, $avatars);
    }

    #[Test]
    public function attachment_belongs_to_attachmentable_morph(): void
    {
        $user = User::factory()->create();
        $attachment = Attachment::factory()->forUser($user)->create();

        $this->assertInstanceOf(User::class, $attachment->attachmentable);
        $this->assertTrue($attachment->attachmentable->is($user));
    }
}
