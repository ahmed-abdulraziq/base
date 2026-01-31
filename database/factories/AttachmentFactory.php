<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ext = fake()->randomElement(['jpg', 'png', 'pdf', 'doc']);
        return [
            'type' => 'image',
            'extension' => $ext,
            'size' => fake()->numberBetween(100, 5000),
            'name' => fake()->word() . '.' . $ext,
            'path' => 'uploads/' . fake()->uuid() . '.' . $ext,
            'attachmentable_type' => User::class,
            'attachmentable_id' => User::factory(),
            'owner_type' => null,
            'owner_id' => null,
        ];
    }

    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'attachmentable_type' => User::class,
            'attachmentable_id' => $user->id,
        ]);
    }
}
