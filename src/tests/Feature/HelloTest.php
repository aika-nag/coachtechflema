<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Profile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class HelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    use WithFaker;

    public function testUserRegisterValidateName()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

        $data = [
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
            'name' => '山田　花子',
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
            'name' => '山田　花子',
            'email' => 'test@email.com',
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
            'name' => '山田　花子',
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
            'name' => '山田　花子',
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
            'name' => '山田　花子',
            'email' => 'test@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234'
        ];
        $response = $this->post('/register', $data);
        $response->assertStatus(302)->assertRedirect('/mypage/profile');

        $this->assertDatabaseHas('users',[
            'name' => '山田　花子',
            'email' => 'test@email.com'
        ]);
    }

     public function testLoginValidateEmail()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $data = [
            'password' => 'test1234',
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
            'email' => 'test@email.com',
        ];
        $response = $this->post('/login', $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください']);
    }

    public function testLoginValidateRecord()
    {
        $user = User::create([
            'name' => '山田　花子',
            'email' => 'test@email.com',
            'password' => bcrypt('test1234'),
        ]);
        $response = $this->get('/login');
        $response->assertStatus(200);

       $response = $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'test5678'
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'ログイン情報が登録されていません'
        ]);
    }

    public function testLogin()
    {
        $user = User::create([
            'name' => '山田　花子',
            'email' => 'test@email.com',
            'password' => bcrypt('test1234'),
        ]);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->post('/login', [
            'email' => 'test@email.com',
            'password' => 'test1234'
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testLogout()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }

    public function testGetAllItem()
    {
        $items = Item::factory(10)->create();

        $response = $this->get('/');
        $response->assertStatus(200);

        foreach($items as $item){
            $response->assertSee($item->name);
        }

        $response->assertViewHas('items',function($viewItems) use ($items){
            return count($viewItems) === count($items);
        });
    }

    public function testSoldItemView()
    {
        $unpurchasedItems = Item::factory(3)->create();
        $purchasedOrders = Order::factory(2)->create();
        $purchasedItems = $purchasedOrders->map(fn($order) => $order->item);

        $allItems = $unpurchasedItems->merge($purchasedItems);

        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $soldCount = substr_count($html, 'Sold');

        foreach($purchasedItems as $purchasedItem){
            $response->assertSee("Sold");
        }

        $response->assertViewHas('items',function($viewItems) use ($allItems){
            return count($viewItems) === count($allItems);
        });
        $this->assertEquals($purchasedItems->count(), $soldCount);
    }

    public function testMyItemNotShown()
    {
        $myUser = User::factory()->create();
        $myItems = Item::factory(2)->create([
            'user_id' => $myUser->id
        ]);

        $otherUsers = User::factory(3)->create();
        $theirItems = Item::factory(3)->create([
            'user_id' => $otherUsers->random()->id
        ]);

        /** @var \Illuminate\Contracts\Auth\Authenticatable $myUser */
        $this->actingAs($myUser);
        $response = $this->get('/');
        $response->assertStatus(200);

        foreach($myItems as $myItem) {
            $response->assertDontSee($myItem->name);
        }

        foreach($theirItems as $theirItem){
            $response->assertSee($theirItem->name);
        }
    }

    public function testMyListShown()
    {
        $myUser = User::factory()->create();
        $items = Item::factory(5)->create();

        $myFavorites = collect();
        foreach($items->random(2) as $item){
            $myFavorites->push(
                Favorite::factory()->create([
                    'user_id' => $myUser->id,
                    'item_id' => $item->id
                ])
            );
        }

        $favoriteItems = $myFavorites->map(fn($favorite) => $favorite->item);

        /** @var \Illuminate\Contracts\Auth\Authenticatable $myUser */
        $this->actingAs($myUser);
        $response = $this->post('/?tab=mylist');
        $response->assertStatus(200);

        foreach($favoriteItems as $favoriteItem){
            $response->assertSee($favoriteItem->name);
        }
        $response->assertViewHas('items',function($viewItems) use ($favoriteItems){
            return count($viewItems) === count($favoriteItems);
        });
    }

    public function testMyListSoldShown()
    {
        $myUser = User::factory()->create();

        //購入済みアイテム１件
        $purchasedOrder = Order::factory()->create();
        $purchasedItem = $purchasedOrder->item;

        //未購入アイテム２件
        $unpurchasedItems = Item::factory(2)->create();
        $unpurchasedItemA = $unpurchasedItems[0];
        $unpurchasedItemB = $unpurchasedItems[1];

        //お気に入りかつ購入済みアイテム
        Favorite::factory()->create([
            'user_id' => $myUser->id,
            'item_id' => $purchasedItem->id
        ]);

        //お気に入りかつ未購入アイテム
        Favorite::factory()->create([
            'user_id' => $myUser->id,
            'item_id' => $unpurchasedItemA->id
        ]);

        //お気に入り登録も購入もされていないアイテムは表示されないことを確認
        /** @var \Illuminate\Contracts\Auth\Authenticatable $myUser */
        $this->actingAs($myUser);
        $response = $this->post('/?tab=mylist');
        $response->assertStatus(200);

        $response->assertSee($purchasedItem->name);
        $response->assertSee($unpurchasedItemA->name);
        $response->assertDontSee($unpurchasedItemB->name);
        $response->assertSee('Sold');
    }

    public function testMyListForGuest()
    {
        $this->assertGuest();
        $response = $this->post('/?tab=mylist');
        $response->assertStatus(200);

        $response->assertViewHas('items', null);
    }

    public function testGetProfile()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'name' => $user->name,
            'image' => 'default_icon.png'
        ]);

        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'テスト腕時計'
        ]);

        $userOrder = Order::factory()->create([
            'buyer_id' => $user->id,
        ]);
        $buyItem = $userOrder->item;

        $response = $this->actingAs($user)->get('/mypage');
        $response->assertStatus(200);
        $response->assertSee($profile->name);
        $response->assertSee($profile->image);

        $response = $this->post('/mypage?page=buy');
        $response->assertSee($buyItem->name);

        $response = $this->post('/mypage?page=sell');
        $response->assertSee($sellItem->name);
    }

    public function testEditProfile()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'name' => $user->name,
            'image' => 'default_icon.png'
        ]);

        $response = $this->actingAs($user)->get('/mypage/profile');
        $response->assertStatus(200);

        $response->assertSee($profile->name);
        $response->assertSee($profile->zipcode);
        $response->assertSee($profile->address);
        $response->assertSee($profile->building);
        $response->assertSee($profile->image);
    }
}
