<x-layouts.app-layout title="{{ $title }}">

    <div class="h-32 w-full bg-login-pattern bg-cover bg-no-repeat">
        <x-molecules.breadcrumb :title="$title . ' ' . 'to the site'" />
    </div>

    <div class="absolute min-h-screen w-full bg-hero">
        <div class="relative inset-x-0 -top-20 mx-auto w-5/12 rounded-3xl bg-white py-16 shadow-xl">
            <div class="flex flex-col items-center justify-center gap-11">
                <x-atoms.logo classLogo="h-auto w-48" />
                <p class="text-center font-lexend text-2xl font-normal leading-7">Masuk dengan akun Anda</p>
            </div>

            <form action="{{ route('login') }}" class="mt-14" method="post">
                @csrf
                <div class="flex flex-col justify-center gap-12">
                    <div>
                        <input autofocus class="@error('username') border-red-500 bg-red-500 @enderror field-input"
                            name="username" placeholder="Username" required type="text"
                            value="{{ old('username') }}">

                        @error('username')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="field-input" name="password" placeholder="Password" required type="password">
                    </div>

                    <div class="mx-auto flex w-9/12 flex-row items-center justify-between">
                        <div class="flex flex-row items-center justify-start gap-2">
                            <input
                                class="h-6 w-8 rounded border-gray-600 bg-gray-700 text-blue-600 ring-offset-gray-800 focus:ring-2 focus:ring-blue-600"
                                name="remember" type="checkbox">
                            <label class="ml-2 font-lexend text-sm font-medium text-gray-900"
                                for="default-checkbox">Remember
                                me</label>
                        </div>

                        <a href="/change-password">
                            <p class="font-lexend text-sm font-medium hover:text-blue-500">Change password?</p>
                        </a>
                    </div>

                    <button class="btn-auth" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app-layout>
