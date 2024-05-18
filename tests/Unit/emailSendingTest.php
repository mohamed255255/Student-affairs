<?php
namespace Tests\Unit;

use App\Http\Controllers\StudentController;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\TestCase;

class EmailSendingTest extends TestCase
{
    public function testSendNewUserRegisteredEmail()
    {
        // Mock the Mail facade
        Mail::fake();

        $controller = new StudentController();
        $controller->sendNewUserRegisteredEmail('John Doe', 'john@example.com');

        // Assert that an email was sent
        Mail::assertSent(MyEmail::class, function ($mail) {
            // Assert specific conditions on the email if needed
            return $mail->hasTo("fcailavarelsendemail@gmail.com");
        });
    }
}
