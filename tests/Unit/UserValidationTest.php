<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserValidationTest extends TestCase
{
    use RefreshDatabase;


    public function testMissingFields()
    {
        // Test case for missing fields
        $response = $this->post(route('students.store'), [
            'student_address' => '123 Main St',
            'student_username' => 'superman',
            'student_email' => 'john@example.com',
            'student_password' => 'Password@123',
            'student_password_confirmation' => 'Password@123',
        ]);

        // Assert that the request fails validation due to missing fields
        $response->assertSessionHasErrors(['student_name']);
        $response->assertSessionHasErrors(['student_birthdate']);
        $response->assertSessionHasErrors(['student_phone']);
        $response->assertSessionHasErrors(['student_image']);


    }


    public function testWrongPasswordFormat()
    {
        $response = $this->post(route('students.store'), [
            // Fill in the request data with a wrong password format
            'student_name' => 'John Doe',
            'student_birthdate' => '2000-01-01',
            'student_phone' => '01123456789',
            'student_address' => '123 Main St',
            'student_username' => 'johndoe',
            'student_email' => 'john@example.com',
            'student_password' => '123', // incorrect format it should be 8 chars capital + letters + #$@#!
            'student_password_confirmation' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors(['student_password']);

        /// i assert img because of a bug in laravel
        $response->assertSessionHasErrors(['student_image']);

    }
}


