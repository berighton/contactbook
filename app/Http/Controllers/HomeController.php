<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard by getting all contacts of the authenticated user and then searching through them if a search term was specified
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$searchText = trim(request()->get('search'));
		if ($searchText) {
			$contacts = Contact::whereUserId(auth()->id())->where(function ($query) {
					$searchText = trim( request()->get( 'search' ) );
					$query
						->where( 'fname', 'like', '%' . $searchText . '%' )
						->orWhere( 'lname', 'like', '%' . $searchText . '%' )
						->orWhere( 'email', 'like', '%' . $searchText . '%' )
						->orWhere( 'phone', 'like', '%' . $searchText . '%' );
				} )
				->get()
				->all();
		} else {
			$contacts = Contact::whereUserId(auth()->id())->get()->all();
		}

		return view( 'home', [
			'contacts' => $contacts,
			'search'   => request()->get( 'search' )
		] );
	}
}
