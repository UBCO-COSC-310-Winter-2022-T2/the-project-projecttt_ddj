<?php

// Test class
use PHPUnit\Framework\TestCase;

session_start();

// Mock login script
function login($username, $password, $user_type)
{
    if ($username == 'test_username' && $password == 'test_password' && $user_type == 'student') {
        // Successful login
        $_SESSION['user_type'] = $user_type;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = 123; // Hardcoded user ID
        return true;
    } else {
        // Failed login
        $_SESSION['username'] = null;
        $_SESSION['password'] = null;
        $_SESSION['user_type'] = null;
        $_SESSION['user_id'] = null;
        return false;
    }
}
class LoginTest extends TestCase
{
    //Functional Tests
    public function testValidLogin()
    {
        $this->assertTrue(login('test_username', 'test_password', 'student'));
        $this->assertEquals('student', $_SESSION['user_type']);
        $this->assertEquals('test_username', $_SESSION['username']);
        $this->assertEquals(123, $_SESSION['user_id']);
    }

    public function testInValidlogin()
    {
        $this->assertFalse(login('wrong_username', 'wrong_password', 'student'));
        $this->assertNull($_SESSION['user_type']);
        $this->assertNull($_SESSION['username']);
        $this->assertNull($_SESSION['user_id']);
    }

     // Non-functional Tests


    public function testLoginSpeed()
    {
        $start = microtime(true);
        login('test_username', 'test_password', 'student');
        $end = microtime(true);
        $duration = $end - $start;
        $this->assertLessThan(1, $duration);
    }

   
    public function testSessionSize()
    {
        login('test_username', 'test_password', 'student');
        $size = strlen(serialize($_SESSION));
        $this->assertLessThan(1000, $size);
    }
}