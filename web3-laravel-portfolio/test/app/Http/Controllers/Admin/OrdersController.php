<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Orders;
use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use Illuminate\Http\Request;



class OrdersController extends Controller {

	/**
	 * Display a listing of orders
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $orders = Orders::all();

		return view('admin.orders.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new orders
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.orders.create');
	}

	/**
	 * Store a newly created orders in storage.
	 *
     * @param CreateOrdersRequest|Request $request
	 */
	public function store(CreateOrdersRequest $request)
	{
	    
		Orders::create($request->all());

		return redirect()->route(config('quickadmin.route').'.orders.index');
	}

	/**
	 * Show the form for editing the specified orders.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$orders = Orders::find($id);
	    
	    
		return view('admin.orders.edit', compact('orders'));
	}

	/**
	 * Update the specified orders in storage.
     * @param UpdateOrdersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateOrdersRequest $request)
	{
		$orders = Orders::findOrFail($id);

        

		$orders->update($request->all());

		return redirect()->route(config('quickadmin.route').'.orders.index');
	}

	/**
	 * Remove the specified orders from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Orders::destroy($id);

		return redirect()->route(config('quickadmin.route').'.orders.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Orders::destroy($toDelete);
        } else {
            Orders::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.orders.index');
    }

}
