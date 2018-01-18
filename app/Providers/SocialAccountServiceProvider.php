<?php

namespace App\Providers;

use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

/**
 * Class SocialAccountServiceProvider
 *
 * @package App\Providers
 */
class SocialAccountServiceProvider {

	/**
	 * Gets or creates a user
	 *
	 * @param ProviderUser $user
	 * @param              $provider
	 * @return mixed
	 */
	public function createOrGetUser(ProviderUser $user, $provider) {

		$account = User::whereProvider($provider)->whereProviderUserId($user->getId())->first();

		if (!$account) {
			$account = User::create([
				'email'            => $user->getEmail(),
				'name'             => $user->getName(),
				'password'         => md5(rand(1111, 9999)),
				'provider_user_id' => $user->getId(),
				'provider'         => $provider
			]);

			$account->save();
		}

		return $account;
	}
}
