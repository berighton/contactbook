<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ContactController with basic CRUD contact operations
 *
 * @package App\Http\Controllers
 */
class ContactController extends Controller {

	/**
	 * Creates a new contact
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function create() {

		$contactData                 = request()->all();
		$contactData['user_id']      = auth()->id();
		$contactData['extra_fields'] = json_encode($contactData['extra_fields']);

		$contact = Contact::create($contactData);
		return response()->json($contact);
	}

	/**
	 * Updates an existing contact
	 *
	 * @param int $contact_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update($contact_id) {
		if ($contact = Contact::find($contact_id)) {
			$contact->fname        = request()->get('fname');
			$contact->lname        = request()->get('lname');
			$contact->email        = request()->get('email');
			$contact->phone        = request()->get('phone');
			$contact->extra_fields = json_encode(request()->get('extra_fields'));
			$contact->save();
		}
		return response()->json($contact);
	}

	/**
	 * Deletes a contact
	 *
	 * @param int $contact_id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function delete($contact_id) {
		$contact = Contact::destroy($contact_id);
		return response()->json($contact);
	}
}
