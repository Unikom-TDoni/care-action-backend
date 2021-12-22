<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Services\AuthService;

class RedirectIfProfileDataIncomplate
{
    private $authService;
    private $accountService;
    
    public function __construct(AuthService $authService, AccountService $accountService)
    {
        $this->authService = $authService;
        $this->accountService = $accountService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUserId = $this->authService->getActivePelangganId();
        return $this->accountService->isProfileComplate($currentUserId) ?
            $next($request) : 
            redirect()->route('pelanggan.profile.index')->with('status', 'Please Complete Your Profile Data First');
    }
}
