<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->getRedirectUrl($request->user());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->getRedirectUrl($request->user());
    }

    /**
     * Helper untuk menentukan arah redirect setelah verifikasi email
     */
    protected function getRedirectUrl($user): RedirectResponse
    {
        if ($user->student()->exists()) {
            // Jalur redirect untuk siswa
            return redirect()->intended(route('student.dashboard', absolute: false).'?verified=1');
        }

        // Jalur redirect untuk Guru / Admin
        return redirect()->intended(url('teachers/violations').'?verified=1');
    }
}
