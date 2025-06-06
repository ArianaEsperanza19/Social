<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SocialDash') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="././resources/css/styles.css">
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>

            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Settings
                    </h2>
                </div>
            </header>
            {{-- Formulario de configuracion --}}
            <br>
            <x-box-layout>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Profile Information') }}
                </h2>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}"
                    enctype="multipart/form-data">
                    @csrf
                </form>

                <form method="post" action="{{ route('user.update') }}" class="mt-6 space-y-6"
                    enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto">
                    @csrf
                    @method('post')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="surname" :value="__('Surname')" />
                        <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full"
                            :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
                        <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                    </div>
                    <div>
                        <x-input-label for="nickname" :value="__('Nickname')" />
                        <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full"
                            :value="old('nickname', $user->nickname)" required autofocus autocomplete="nickname" />
                        <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
                    </div>
                    <div>
                        <x-input-label for="role" :value="__('Role')" />
                        <x-text-input id="role" name="role" type="text" class="mt-1 block w-full"
                            :value="old('role', $user->role)" required autofocus autocomplete="role" />
                        <x-input-error class="mt-2" :messages="$errors->get('role')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        @include('includes.avatar')
                        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full"
                            :value="old('image', $user->image)" required autofocus autocomplete="image" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>


                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                </form>
            </x-box-layout>
            <x-box-layout>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </x-box-layout>
            <x-box-layout>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </x-box-layout>
    </div>

    </main>
</body>

</html>
