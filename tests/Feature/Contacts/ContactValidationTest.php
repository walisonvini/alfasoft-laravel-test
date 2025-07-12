<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_create_contact_validation_errors()
    {
        $response = $this->actingAs($this->user)
            ->post(route('contacts.store'), []);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_create_contact_with_invalid_email()
    {
        $data = [
            'name' => 'Test Contact',
            'contact' => '123456789',
            'email' => 'invalid-email'
        ];

        $response = $this->actingAs($this->user)
            ->post(route('contacts.store'), $data);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_update_contact_validation_errors()
    {
        $contact = Contact::factory()->create();

        $response = $this->actingAs($this->user)
            ->put(route('contacts.update', $contact), []);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_update_contact_with_invalid_email()
    {
        $contact = Contact::factory()->create();
        $data = [
            'name' => 'Updated Contact',
            'contact' => '987654321',
            'email' => 'invalid-email'
        ];

        $response = $this->actingAs($this->user)
            ->put(route('contacts.update', $contact), $data);

        $response->assertSessionHasErrors(['email']);
    }
} 