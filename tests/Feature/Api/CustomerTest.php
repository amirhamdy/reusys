<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;

use App\Models\Region;
use App\Models\Country;
use App\Models\Industry;
use App\Models\CustomerStatus;
use App\Models\CustomerRating;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
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
    public function it_gets_customers_list()
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customers.index'));

        $response->assertOk()->assertSee($customers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer()
    {
        $data = Customer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.customers.store'), $data);

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer()
    {
        $customer = Customer::factory()->create();

        $customerStatus = CustomerStatus::factory()->create();
        $country = Country::factory()->create();
        $region = Region::factory()->create();
        $customerRating = CustomerRating::factory()->create();
        $industry = Industry::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'fax' => $this->faker->text(255),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(255),
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'billing_address' => $this->faker->text(255),
            'customer_status_id' => $customerStatus->id,
            'country_id' => $country->id,
            'region_id' => $region->id,
            'customer_rating_id' => $customerRating->id,
            'industry_id' => $industry->id,
        ];

        $response = $this->putJson(
            route('api.customers.update', $customer),
            $data
        );

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson(
            route('api.customers.destroy', $customer)
        );

        $this->assertModelMissing($customer);

        $response->assertNoContent();
    }
}
