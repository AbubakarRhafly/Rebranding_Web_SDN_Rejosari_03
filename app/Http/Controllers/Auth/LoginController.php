<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $captchaSvg = $this->createCaptcha();

        return view('auth.login', compact('captchaSvg'));
    }

    public function refreshCaptcha(): JsonResponse
    {
        $captchaSvg = $this->createCaptcha();

        return response()->json([
            'status' => 'success',
            'svg' => $captchaSvg,
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'captcha' => 'required|string',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'captcha.required' => 'Kode CAPTCHA wajib diisi.',
        ]);

        $sessionCaptcha = session('admin_login_captcha');
        session()->forget('admin_login_captcha');

        if (! $sessionCaptcha || strtoupper(trim($request->input('captcha'))) !== $sessionCaptcha) {
            return back()
                ->withErrors([
                    'captcha' => 'Kode CAPTCHA tidak sesuai atau sudah kadaluarsa. Silakan coba lagi.',
                ])
                ->onlyInput('email');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil logout.');
    }

    private function createCaptcha(): string
    {
        $characters = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';
        $code = '';
        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < 5; $i++) {
            $code .= $characters[random_int(0, $maxIndex)];
        }

        session(['admin_login_captcha' => $code]);

        return $this->renderCaptchaSvg($code);
    }

    private function renderCaptchaSvg(string $code): string
    {
        $width = 160;
        $height = 46;
        $elements = [];

        // Latar belakang dengan sudut melengkung dan border
        $elements[] = '<rect width="100%" height="100%" fill="#f8fafc" rx="8" stroke="#cbd5e1" stroke-width="1.5"/>';

        // Garis-garis kurva acak untuk mengelabui OCR
        $noiseColors = ['#fecdd3', '#fed7aa', '#e2e8f0', '#cbd5e1', '#fbcfe8'];
        for ($i = 0; $i < 5; $i++) {
            $x1 = rand(5, $width - 5);
            $y1 = rand(5, $height - 5);
            $x2 = rand(5, $width - 5);
            $y2 = rand(5, $height - 5);
            $cx = rand(10, $width - 10);
            $cy = rand(10, $height - 10);
            $color = $noiseColors[array_rand($noiseColors)];
            $elements[] = sprintf(
                '<path d="M %d %d Q %d %d %d %d" stroke="%s" stroke-width="1.5" fill="none" opacity="0.7"/>',
                $x1, $y1, $cx, $cy, $x2, $y2, $color
            );
        }

        // Titik-titik acak
        for ($i = 0; $i < 30; $i++) {
            $cx = rand(3, $width - 3);
            $cy = rand(3, $height - 3);
            $r = rand(1, 2);
            $elements[] = sprintf('<circle cx="%d" cy="%d" r="%d" fill="#94a3b8" opacity="0.4"/>', $cx, $cy, $r);
        }

        // Karakter teks dengan rotasi dan offset vertikal
        $chars = str_split($code);
        $charCount = count($chars);
        $step = ($width - 32) / max(1, $charCount);
        $letterColors = ['#893642', '#a84450', '#1e293b', '#991b1b', '#334155'];

        foreach ($chars as $idx => $char) {
            $x = 20 + ($idx * $step) + rand(-2, 2);
            $y = rand(30, 34);
            $rot = rand(-15, 15);
            $color = $letterColors[array_rand($letterColors)];
            $size = rand(22, 25);

            $elements[] = sprintf(
                '<text x="%d" y="%d" font-family="Courier New, monospace, sans-serif" font-weight="800" font-size="%d" fill="%s" transform="rotate(%d %d %d)" text-anchor="middle" style="user-select:none;pointer-events:none;">%s</text>',
                $x, $y, $size, $color, $rot, $x, $y, htmlspecialchars($char, ENT_QUOTES, 'UTF-8')
            );
        }

        // Garis gelombang melintang di bagian depan
        $elements[] = sprintf(
            '<path d="M 6 %d C %d %d, %d %d, %d %d" stroke="rgba(168, 68, 80, 0.4)" stroke-width="1.8" fill="none"/>',
            rand(20, 26),
            rand(35, 65), rand(6, 40),
            rand(95, 125), rand(6, 40),
            $width - 6, rand(20, 26)
        );

        return sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="%d" height="%d" viewBox="0 0 %d %d" role="img" aria-label="Kode Keamanan CAPTCHA">%s</svg>',
            $width, $height, $width, $height, implode('', $elements)
        );
    }
}
