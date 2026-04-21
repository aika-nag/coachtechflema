<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\User;


class LoginTest extends TestCase
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

    public function testLoginValidateEmail()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $data = [
            'email' => '',
            'password' => 'coachhanako',
        ];
        $response = $this->post('/login', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください']);
    }

    public function testLoginValidatePassword()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $data = [
            'email' => 'hanako@test.jp',
            'password' => ''
        ];
        $response = $this->post('/login', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください']);
    }

    public function testLoginValidateRecord()
    {
        $response = $this->post('/login', [
            'email' => 'hanako@test.jp',
            'password' => 'test1234'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'ログイン情報が登録されていません'
        ]);
    }

    public function testLogin()
    {
        $user = User::find(11);

        $response = $this->post('/login', [
            'email' => 'hanako@test.jp',
            'password' => 'coachhanako'
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testLogout()
    {
        $user = User::find(11);

        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
