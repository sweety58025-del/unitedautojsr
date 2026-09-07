<?php

namespace Tests\Feature;

use App\Mail\ContactInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_validates_and_sends_a_message(): void
    {
        Mail::fake();

        $response = $this->post(route('contact-us.store'), [
            'name' => 'Website Visitor',
            'email' => 'visitor@example.com',
            'subject' => 'Service question',
            'message' => 'Please contact me about a service.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->data['email'] === 'visitor@example.com';
        });
    }
}