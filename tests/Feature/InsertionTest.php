<?php
namespace test\Feature ;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InsertionTest extends TestCase
{
    use RefreshDatabase;

    public function testInsertANewStudent()
    {

        //////// Copy the avatar.jpg to app before testing
        $imagePath = 'C:\Users\mohamed\Desktop\20200436_20210358_20200055_20200203_20201118\avatar.jpg';

        $response = $this->post(route('students.store'), [
            'student_name' => 'John Doe',
            'student_birthdate' => '2000-01-01',
            'student_phone' => '01123456789',
            'student_address' => '123 Main St',
            'student_username' => 'johndoe',
            'student_email' => 'john@example.com',
            'student_password' => 'Password@123',
            'student_password_confirmation' => 'Password@123',
            'student_image' => new UploadedFile($imagePath, 'avatar.jpg', 'image/jpeg', null, true),
        ]);

        $response->assertStatus(302); // test for request

        $response->assertSessionHas('success', trans('public.added'));  /// test for result msg

        $this->assertDatabaseHas('students', [  /// test for DB insertion
            'student_name' => 'John Doe',
            'student_email' => 'john@example.com',
            'student_username' => 'johndoe',
        ]);
    }
}
