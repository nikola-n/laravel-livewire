<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use App\Mail\ContactFormMailable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    //testing the existance of the component
    /** @test */
    public function main_page_contains_contact_form_livewire_component()
    {
        $this->get('/')
            ->assertSeeLivewire('contact-form');
    }

    //the emails is sent when the form is submitted

    /** @test */
    public function contact_form_sends_out_an_email()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Nikola')
            ->set('email', 'someguy@someguy.com')
            ->set('phone', '12345')
            ->set('message', 'This is my message.')
            ->call('submitForm');
        //->assertSee('We received your message successfully and will get back to you shortly!');

        Mail::assertSent(function (ContactFormMailable $mail) {
            $mail->build();

            return $mail->hasTo('nikola@nikola.com') && $mail->hasFrom('someguy@someguy.com')
                && $mail->subject === 'Contact Form Submission';
        });
    }

    //validation test

    /** @test */
    public function contact_form_name_field_is_required()
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'someguy@someguy.com')
            ->set('phone', '12345')
            ->set('message', 'This is my message.')
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function contact_form_message_field_has_minimum_characters()
    {
        Livewire::test(ContactForm::class)
            ->set('message', 'abc')
            ->call('submitForm')
            ->assertHasErrors(['message' => 'min']);
    }
}
