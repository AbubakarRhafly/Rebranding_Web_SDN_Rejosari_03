@extends('layouts.app')

@section('title', 'Portal Masuk Admin — SDN Rejosari 03')

@push('styles')
<style>
    .portal-login-wrapper {
        min-height: calc(80vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
    }

    .portal-login-card {
        width: 100%;
        max-width: 440px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        padding: 36px 32px;
        box-sizing: border-box;
    }

    .portal-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .portal-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fdf2f4;
        color: var(--site-red-dark, #893642);
        border: 1px solid #fecdd3;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 12px;
    }

    .portal-badge svg {
        stroke: var(--site-red, #a84450);
    }

    .portal-title {
        margin: 0 0 6px;
        font-size: 24px;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .portal-subtitle {
        margin: 0;
        font-size: 13.5px;
        color: #64748b;
        line-height: 1.5;
    }

    .portal-alert {
        padding: 12px 14px;
        border-radius: 8px;
        font-size: 13.5px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        line-height: 1.5;
    }

    .portal-alert--success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }

    .portal-alert--error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .portal-form-group {
        margin-bottom: 20px;
    }

    .portal-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    .portal-input {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        font-size: 14.5px;
        color: #1e293b;
        background: #ffffff;
        box-sizing: border-box;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
        outline: none;
        font-family: inherit;
    }

    .portal-input:focus {
        border-color: var(--site-red, #a84450);
        box-shadow: 0 0 0 3px rgba(168, 68, 80, 0.15);
    }

    .portal-input.is-invalid {
        border-color: #ef4444;
        background: #fffafa;
    }

    .portal-input-error {
        margin: 5px 0 0;
        font-size: 12.5px;
        color: #dc2626;
        font-weight: 500;
    }

    /* Captcha Section */
    .captcha-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 20px;
    }

    .captcha-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .captcha-visual {
        flex-shrink: 0;
        line-height: 0;
        border-radius: 8px;
        overflow: hidden;
        background: #ffffff;
    }

    .captcha-visual svg {
        display: block;
        width: 160px;
        height: 46px;
    }

    .btn-refresh-captcha {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 12px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .btn-refresh-captcha:hover {
        background: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
    }

    .btn-refresh-captcha svg {
        transition: transform 0.3s ease;
    }

    .btn-refresh-captcha:active svg {
        transform: rotate(180deg);
    }

    .portal-btn-submit {
        width: 100%;
        padding: 12px 18px;
        background: var(--site-red, #a84450);
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.15s ease, transform 0.1s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 3px 10px rgba(168, 68, 80, 0.25);
    }

    .portal-btn-submit:hover {
        background: var(--site-red-dark, #893642);
    }

    .portal-btn-submit:active {
        transform: scale(0.99);
    }

    .portal-footer-links {
        margin-top: 24px;
        text-align: center;
        border-top: 1px solid #f1f5f9;
        padding-top: 16px;
    }

    .portal-back-link {
        color: #64748b;
        font-size: 13px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.15s ease;
    }

    .portal-back-link:hover {
        color: var(--site-red-dark, #893642);
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="portal-login-wrapper">
    <div class="portal-login-card">

        <div class="portal-header">
            <div class="portal-badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                Portal Admin
            </div>
            <h1 class="portal-title">Masuk ke Sistem</h1>
            <p class="portal-subtitle">Khusus pengelola dan staf administrasi SDN Rejosari 03</p>
        </div>

        @if (session('success'))
            <div class="portal-alert portal-alert--success" role="alert">
                <span>✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if ($errors->has('email') && !old('email'))
            <div class="portal-alert portal-alert--error" role="alert">
                <span>⚠️</span>
                <div>{{ $errors->first('email') }}</div>
            </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST" autocomplete="off" id="form-portal-login">
            @csrf

            {{-- Input Email --}}
            <div class="portal-form-group">
                <label for="email" class="portal-label">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="portal-input @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="nama@sdnrejosari03.sch.id"
                    required
                    autofocus
                >
                @error('email')
                    <p class="portal-input-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="portal-form-group">
                <label for="password" class="portal-label">Kata Sandi</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="portal-input @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <p class="portal-input-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kode CAPTCHA --}}
            <div class="captcha-box">
                <label for="captcha-input" class="portal-label" style="margin-bottom: 8px;">
                    Verifikasi Keamanan (CAPTCHA)
                </label>

                <div class="captcha-row">
                    <div class="captcha-visual" id="captcha-image-wrapper" title="Kode Keamanan">
                        {!! $captchaSvg !!}
                    </div>

                    <button
                        type="button"
                        id="btn-refresh-captcha"
                        class="btn-refresh-captcha"
                        title="Klik untuk mengganti kode jika kurang terbaca"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                        </svg>
                        Ganti Kode
                    </button>
                </div>

                <input
                    type="text"
                    id="captcha-input"
                    name="captcha"
                    class="portal-input @error('captcha') is-invalid @enderror"
                    placeholder="Ketik 5 karakter di atas"
                    maxlength="6"
                    autocomplete="off"
                    autocapitalize="characters"
                    required
                >
                @error('captcha')
                    <p class="portal-input-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="portal-btn-submit">
                Masuk ke Panel Admin →
            </button>
        </form>

        <div class="portal-footer-links">
            <a href="{{ url('/') }}" class="portal-back-link">
                ← Kembali ke Beranda Sekolah
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnRefresh = document.getElementById('btn-refresh-captcha');
        const captchaWrapper = document.getElementById('captcha-image-wrapper');
        const captchaInput = document.getElementById('captcha-input');

        if (btnRefresh && captchaWrapper) {
            btnRefresh.addEventListener('click', function () {
                btnRefresh.disabled = true;
                btnRefresh.style.opacity = '0.6';

                fetch('{{ route("login.captcha-refresh") }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal memuat CAPTCHA');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.svg) {
                        captchaWrapper.innerHTML = data.svg;
                        if (captchaInput) {
                            captchaInput.value = '';
                            captchaInput.focus();
                        }
                    }
                })
                .catch(err => {
                    console.error('Error saat refresh captcha:', err);
                })
                .finally(() => {
                    btnRefresh.disabled = false;
                    btnRefresh.style.opacity = '1';
                });
            });
        }
    });
</script>
@endsection
