<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductlineResource;
use App\Http\Resources\ProductlineCollection;

class CustomerProductlinesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Customer $customer)
    {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $productlines = $customer
            ->productlines()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductlineCollection($productlines);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $this->authorize('create', Productline::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'pricebook_id' => ['required', 'exists:pricebooks,id'],
        ]);

        $productline = $customer->productlines()->create($validated);

        return new ProductlineResource($productline);
    }
}
