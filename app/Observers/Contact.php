<?php

namespace App\Observers;

/**
 * Class Contact - observes contact changes
 *
 * @package App\Observers
 */
class Contact {

	/**
	 *
	 * Main ActiveCampaign instance
	 * 
	 * @var \ActiveCampaign
	 */
	private $ac;

	/**
	 * Contact constructor. Instantiates the default AC object passing an API key from our config files
	 * 
	 */
	public function __construct() {
		$this->ac = new \ActiveCampaign(\Config::get('services')['active_campaign']['url'], \Config::get('services')['active_campaign']['key']);
	}

	/**
	 * Creates a new AC record on create
	 * 
	 * @param \App\Contact $contact
	 */
	public function created(\App\Contact $contact) {
		$contactData  = [
			'email'                                                             => $contact->email,
			'phone'                                                             => $contact->phone,
			'first_name'                                                        => $contact->fname,
			'last_name'                                                         => $contact->lname,
			'p[' . \Config::get('services')['active_campaign']['list_id'] . ']' => \Config::get('services')['active_campaign']['list_id']
		];
		$contact_sync = $this->ac->api("contact/sync", $contactData);

		if (1 === (int) $contact_sync->success) {
			// Update a contact model with the new AC id
			$contact->ac_id = $contact_sync->subscriber_id;
			$contact->save();
		}
	}

	/**
	 * Updates AC on update
	 * 
	 * @param \App\Contact $contact
	 */
	public function updated(\App\Contact $contact) {

		$contactData  = [
			'email'                                                             => $contact->email,
			'phone'                                                             => $contact->phone,
			'first_name'                                                        => $contact->fname,
			'last_name'                                                         => $contact->lname,
			'p[' . \Config::get('services')['active_campaign']['list_id'] . ']' => \Config::get('services')['active_campaign']['list_id'],
			'id'                                                                => $contact->ac_id
		];
		$contact_edit = $this->ac->api("contact/edit", $contactData);

		if (1 === (int) $contact_edit->success) {
			// Do something here on successful update
		}
	}

	/**
	 * Updates AC on delete
	 * 
	 * @param \App\Contact $contact
	 */
	public function deleting(\App\Contact $contact) {
		if ($contact->ac_id) {
			$contact_delete = $this->ac->api('contact/delete', ['id' => $contact->ac_id]);

			if (1 === (int) $contact_delete->success) {
				// Do something here on successful delete
			}
		}
	}
}
