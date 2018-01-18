<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\SocialAccountServiceProvider;
use Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class AuthController that handles social logins
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller {

	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @param string $provider
	 * @return RedirectResponse
	 */
	public function redirectToProvider($provider) {
		return Socialite::driver($provider)->redirect();
	}

	/**
	 * Obtain the user information from GitHub.
	 *
	 * @param string $provider
	 * @return RedirectResponse
	 */
	public function handleProviderCallback($provider, SocialAccountServiceProvider $service) {

		$user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);
		auth()->login($user);

		return redirect()->to('/home');
	}
}
