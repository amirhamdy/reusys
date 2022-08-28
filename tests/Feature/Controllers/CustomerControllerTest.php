<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Customer;

use App\Models\Region;
use App\Models\Country;
use App\Models\Industry;
use App\Models\CustomerStatus;
use App\Models\CustomerRating;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_customers()
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('customers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.index')
            ->assertViewHas('customers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_customer()
    {
        $response = $this->get(route('customers.create'));

        $response->assertOk()->assertViewIs('app.customers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_customer()
    {
        $data = Customer::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('customers.store'), $data);

        $this->assertDatabaseHas('customers', $data);

        $customer = Customer::latest('id')->first();

        $response->assertRedirect(route('customers.edit', $customer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.show', $customer));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.show')
            ->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.edit', $customer));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.edit')
            ->assertViewHas('customer');
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

        $response = $this->put(route('customers.update', $customer), $data);

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertRedirect(route('customers.edit', $customer));
    }

    /**
     * @test
     */
    public function it_deletes_the_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete(route('customers.destroy', $customer));

        $response->assertRedirect(route('customers.index'));

        $this->assertModelMissing($customer);
    }
}
