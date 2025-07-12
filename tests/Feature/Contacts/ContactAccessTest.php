<?php

namespace Tests\Feature\Contacts;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_create_page()
    {
        $response = $this->get(route('contacts.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_unauthenticated_user_cannot_access_edit_page()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contacts.edit', $contact));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_create_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.create'));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.create');
    }

    public function test_authenticated_user_can_access_edit_page()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.edit', $contact));

        $response->assertStatus(200);
        $response->assertViewIs('contacts.edit');
    }

    public function test_unauthenticated_user_cannot_see_create_button()
    {
        $response = $this->get(route('contacts.index'));

        $response->assertDontSee('Criar Novo Contato');
    }

    public function test_unauthenticated_user_cannot_see_trash_button()
    {
        $response = $this->get(route('contacts.index'));

        $response->assertDontSee('Lixeira');
    }

    public function test_unauthenticated_user_cannot_see_edit_delete_buttons()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route('contacts.index'));

        $response->assertDontSee('hover:text-yellow-600');
        $response->assertDontSee('hover:text-red-600');
    }

    public function test_unauthenticated_user_sees_login_message()
    {
        $response = $this->get(route('contacts.index'));

        $response->assertSee('Faça login para gerenciar contatos');
    }

    public function test_authenticated_user_can_see_create_button()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.index'));

        $response->assertSee('Criar Novo Contato');
    }

    public function test_authenticated_user_can_see_trash_button()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.index'));

        $response->assertSee('Lixeira');
    }

    public function test_authenticated_user_can_see_edit_delete_buttons()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.index'));

        $response->assertSee('hover:text-yellow-600');
        $response->assertSee('hover:text-red-600');
    }

    public function test_authenticated_user_cannot_see_login_message()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('contacts.index'));

        $response->assertDontSee('Faça login para gerenciar contatos');
    }
} 