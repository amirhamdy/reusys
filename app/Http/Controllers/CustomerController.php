<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Industry;
use Illuminate\Http\Request;
use App\Models\CustomerStatus;
use App\Models\CustomerRating;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Customer::class);

        $search = $request->get('search', '');

        $customers = Customer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.customers.index', compact('customers', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Customer::class);

        $customerStatuses = CustomerStatus::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $regions = Region::pluck('name', 'id');
        $customerRatings = CustomerRating::pluck('name', 'id');
        $industries = Industry::pluck('name', 'id');

        return view(
            'app.customers.create',
            compact(
                'customerStatuses',
                'countries',
                'regions',
                'customerRatings',
                'industries'
            )
        );
    }

    /**
     * @param \App\Http\Requests\CustomerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validated();

        $customer = Customer::create($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        $this->authorize('view', $customer);

        return view('app.customers.show', compact('customer'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customerStatuses = CustomerStatus::pluck('name', 'id');
        $countries = Country::pluck('name', 'id');
        $regions = Region::pluck('name', 'id');
        $customerRatings = CustomerRating::pluck('name', 'id');
        $industries = Industry::pluck('name', 'id');

        return view(
            'app.customers.edit',
            compact(
                'customer',
                'customerStatuses',
                'countries',
                'regions',
                'customerRatings',
                'industries'
            )
        );
    }

    /**
     * @param \App\Http\Requests\CustomerUpdateRequest $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $validated = $request->validated();

        $customer->update($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
