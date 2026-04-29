<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_requires_name_with_more_than_5_characters(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => '12345',
            'contact' => '123456789',
            'email' => 'test@test.com'
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_contact_number_must_be_exactly_9_digits(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => 'Valid Name',
            'contact' => '12345678',
            'email' => 'test@test.com'
        ]);

        $response->assertSessionHasErrors(['contact']);
    }

    public function test_contact_and_email_must_be_unique(): void
    {
        $user = User::factory()->create();

        Contact::create([
            'name' => 'First Contact',
            'contact' => '111111111',
            'email' => 'first@test.com'
        ]);

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => 'Second Contact',
            'contact' => '111111111',
            'email' => 'first@test.com'
        ]);

        $response->assertSessionHasErrors(['contact', 'email']);
    }

    public function test_unique_validation_ignores_current_contact_on_update(): void
    {
        $user = User::factory()->create();

        $contact = Contact::create([
            'name' => 'My Contact',
            'contact' => '999999999',
            'email' => 'my@test.com'
        ]);

        $response = $this->actingAs($user)->put("/contacts/{$contact->id}", [
            'name' => 'Updated Name',
            'contact' => '999999999', 
            'email' => 'my@test.com' 
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('contacts', ['name' => 'Updated Name']);
    }
}
