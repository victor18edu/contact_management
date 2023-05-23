<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCreateContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact_data = Contact::factory()->make()->toArray();

        $response = $this->post('/contacts', $contact_data);
        $response->assertStatus(302);
        
        $response = $this->followRedirects($response);

        $response->assertStatus(200); 
        
        $this->assertDatabaseHas('contacts', $contact_data);;
    }
 
    public function testUpdateContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create();

        $contact_data = [
            'name' => 'New name',
            'contact' => '987654321',
            'email' => 'newemail@example.com',
        ];

        $response = $this->put('/contacts/'.$contact->id, $contact_data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('contacts', $contact_data);
    }

    public function testDeleteContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create();

        $response = $this->delete('/contacts/'.$contact->id);

        $response->assertStatus(302); 
        
        $this->assertSoftDeleted('contacts', ['id' => $contact->id]);
    }

    public function testValidationNameCreateContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $contact_data = [
            'name' => 'Jhon', 
            'contact' => '123456789',
            'email' => 'jhon@example.com',
        ];

        $response = $this->post('/contacts', $contact_data);

        $response->assertSessionHasErrors('name');
        
    }
    public function testValidationEmailCreateContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $contact_data = [
            'name' => 'Jhon', 
            'contact' => '123456789',
            'email' => 'jhon',
        ];

        $response = $this->post('/contacts', $contact_data);

        $response->assertSessionHasErrors('email');
        
    }
    public function testValidationContactCreateContact()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $contact_data = [
            'name' => 'Jhon', 
            'contact' => '12345678',
            'email' => 'jhon',
        ];

        $response = $this->post('/contacts', $contact_data);

        $response->assertSessionHasErrors('contact');
        
    }

    public function testLogin()
    {
        $user = User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/'); 
        
        $this->assertAuthenticated(); 
    }

    public function testLogout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/'); 
        
        $this->assertGuest(); 
    } 
}
