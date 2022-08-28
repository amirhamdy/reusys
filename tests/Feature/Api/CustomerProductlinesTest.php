<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\Productline;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerProductlinesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_customer_productlines()
    {
        $customer = Customer::factory()->create();
        $productlines = Productline::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.productlines.index', $customer)
        );

        $response->assertOk()->assertSee($productlines[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_productlines()
    {
        $customer = Customer::factory()->create();
        $data = Productline::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.productlines.store', $customer),
            $data
        );

        unset($data['name']);
        unset($data['pricebook_id']);
        unset($data['customer_id']);

        $this->assertDatabaseHas('productlines', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $productline = Productline::latest('id')->first();

        $this->assertEquals($customer->id, $productline->customer_id);
    }
}
