<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Order;
use App\Models\Favorite;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ItemTest extends TestCase
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

    public function testGetAllItem()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('items', Item::all());
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
        $user = User::find(12);

        $this->actingAs($user);
        $this->assertAuthenticated();
        $myItems = Item::find([1,2,3,4,5]);
        $notMyItems = Item::find([6,7,8,9,10]);

        $response = $this->get('/');
        foreach($myItems as $myItem){
            $response->assertDontSee($myItem->name);
        }
        foreach($notMyItems as $notMyItem){
            $response->assertSee($notMyItem->name);
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
