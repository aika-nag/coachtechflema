<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function testUserRegisterValidateName()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => "",
            'email' => 'test@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください']);
    }

    public function testUserRegisterValidateEmail()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => '佐藤 次郎',
            'email' => '',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください']);
    }

    public function testUserRegisterValidatePassword()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => '佐藤 次郎',
            'email' => 'test@email.com',
            'password' => '',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください']);
    }

    public function testUserRegisterValidatePassword7()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => '佐藤 次郎',
            'email' => 'test@email.com',
            'password' => 'test123',
            'password_confirmation' => 'test123'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password' => 'パスワードは8文字以上で入力してください']);
    }

    public function testUserRegisterValidatePasswordEqual()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => '佐藤 次郎',
            'email' => 'test@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test5678'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password' => 'パスワードと一致しません']);
    }

    public function testUserRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
            'name' => '佐藤 次郎',
            'email' => 'test@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->post('/register', $data);
        $response->assertRedirect('/mypage/profile');

        $this->assertDatabaseHas('users', [
            'name' => '佐藤 次郎',
            'email' => 'test@email.com'
        ]);
    }
}
