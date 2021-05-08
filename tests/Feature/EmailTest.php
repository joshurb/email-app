<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Email;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_email_in_database()
    {
        $email = Email::factory()->make();
        $email->save();
        $this->assertDatabaseHas('emails', ['id' => $email->id]);
    }

    public function test_email_endpoint()
    {
        $jsonString = '{
            "email_address": "example@test.dev",
            "message": "Its a new message!",
            "attachment": {
                "file": {
                    "mime": "@file/plain",
                    "data": "dGhpcyBpcyBhIHRlc3QgZmlsZQo="
                }
            },
            "attachment_filename": "testFile.txt"
        }';
//        var_dump(json_decode($jsonString, true));
        $response = $this->post('/api/send-email', json_decode($jsonString, true));
//        var_dump($response);
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Email Queued'
            ]);
    }

    public function test_get_all_emails_endpoint()
    {
        $response = $this->get('/api/get-all-emails');
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success'
            ]);
    }

    public function test_get_sent_emails_endpoint()
    {
        $response = $this->get('/api/get-sent-emails');
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success'
            ]);
    }
}
