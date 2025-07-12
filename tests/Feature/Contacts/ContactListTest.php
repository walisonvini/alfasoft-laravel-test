<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactListTest extends TestCase
{
    use RefreshDatabase;

    public function test_anyone_can_view_contacts_list()
    {
        $response = $this->get(route('contacts.index'));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.index');
    }
} 