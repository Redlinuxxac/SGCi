<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log; // For debugging

class LoginResponse implements LoginResponseContract
{
    /**
     * Create a new response instance.
     *
     * @param  \Illuminate\Routing\UrlGenerator  $urlGenerator
     * @return void
     */
    public function __construct(protected UrlGenerator $urlGenerator)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $home = config('fortify.home');

        // --- DEBUGGING START ---
        $user = $request->user();
        Log::info('LoginResponse: User ID - ' . $user->id);
        Log::info('LoginResponse: User Roles - ' . $user->roles->pluck('name')->toJson());
        Log::info('LoginResponse: User has Socio role? - ' . ($user->hasRole('Socio') ? 'Yes' : 'No'));
        // dd($user->hasRole('Socio')); // Use dd() if you want to halt execution here
        // dd($user->roles->pluck('name')); // To see roles directly
        // dd($home); // To see the home path

        if ($user->hasRole('Socio')) {
            $home = '/socio/dashboard';
            Log::info('LoginResponse: Redirecting Socio to - ' . $home);
        } else {
            Log::info('LoginResponse: Redirecting non-Socio to - ' . $home);
        }
        // --- DEBUGGING END ---


        return $request->wantsJson()
                    ? new JsonResponse(['url' => $this->urlGenerator->intended($home)->getTargetUrl()], 200)
                    : redirect()->intended($home);
    }
}