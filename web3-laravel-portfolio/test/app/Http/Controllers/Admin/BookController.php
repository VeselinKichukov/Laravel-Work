<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
		return view('admin.book.index');
	}

}