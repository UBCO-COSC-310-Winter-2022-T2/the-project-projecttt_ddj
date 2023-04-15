<?php

use PHPUnit\Framework\TestCase;

session_start();

function signup($username, $password, $email, $user_type)
{
    if (strlen($username) < 6 || strlen($password) < 6) {
        // Invalid username or password length
        return false;
    } else {
        // Successful signup
        $_SESSION['user_type'] = $user_type;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = 123; // Hardcoded user ID
        return true;
    }
}

class SignupTest extends TestCase
{
    // Functional Tests
    public function testValidSignup()
    {
        $this->assertTrue(signup('test_username', 'test_password', 'test_email@example.com', 'student'));
        $this->assertEquals('student', $_SESSION['user_type']);
        $this->assertEquals('test_username', $_SESSION['username']);
        $this->assertEquals('test_email@example.com', $_SESSION['email']);
        $this->assertEquals(123, $_SESSION['user_id']);
    }

    public function testInvalidSignup()
    {
        $this->assertFalse(signup('test', 'test', 'invalid_email', 'student'));
        $this->assertNull($_SESSION['user_type']);
        $this->assertNull($_SESSION['username']);
        $this->assertNull($_SESSION['email']);
        $this->assertNull($_SESSION['user_id']);
    }

    // Non-functional Tests
    public function testSignupSpeed()
    {
        $start = microtime(true);
        signup('test_username', 'test_password', 'test_email@example.com', 'student');
        $end = microtime(true);
        $duration = $end - $start;
        $this->assertLessThan(1, $duration);
    }

    public function testSessionSize()
    {
        signup('test_username', 'test_password', 'test_email@example.com', 'student');
        $size = strlen(serialize($_SESSION));
        $this->assertLessThan(1000, $size);
    }
}