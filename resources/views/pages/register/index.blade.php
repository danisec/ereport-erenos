<x-layouts.app-layout title="{{ $title }}">

    <div class="h-32 w-full bg-login-pattern bg-cover bg-no-repeat">
        <x-molecules.breadcrumb :title="$title . ' ' . 'to the site'" />
    </div>

    <div class="absolute min-h-screen w-full bg-hero">
        <div class="relative inset-x-0 -top-20 mx-auto w-5/12 rounded-3xl bg-white py-16 shadow-xl">
            <div class="flex flex-col items-center justify-center gap-11">
                <x-atoms.logo classLogo="h-auto w-48" />
                <p class="text-center font-lexend text-2xl font-normal leading-7">Daftar akun Anda</p>
            </div>

            <form action="{{ route('register.store') }}" class="mt-14" method="post">
                @csrf
                <div class="flex flex-col justify-center gap-12">
                    <div>
                        <input autofocus class="@error('name') border-red-500 bg-red-500 @enderror field-input"
                            name="name" placeholder="Name" required type="text" value="{{ old('name') }}">

                        @error('name')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('username') border-red-500 bg-red-500 @enderror field-input"
                            name="username" placeholder="Username" required type="text"
                            value="{{ old('username') }}">

                        @error('username')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('email') border-red-500 bg-red-500 @enderror field-input" name="email"
                            placeholder="Email" required type="email" value="{{ old('email') }}">

                        @error('email')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('password') border-red-500 bg-red-500 @enderror field-input"
                            name="password" placeholder="Password" required type="password">

                        @error('password')
                            <p class="mx-auto w-9/12 text-sm font-medium tracking-wide text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button class="btn-auth" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app-layout>
