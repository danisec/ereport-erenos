<x-layouts.app-layout title="{{ $title }}">

    <div class="h-32 w-full bg-login-pattern bg-cover bg-no-repeat">
        <x-molecules.breadcrumb :title="$title . ' ' . 'to the site'" />
    </div>

    <div class="absolute min-h-screen w-full bg-hero">
        <div class="relative inset-x-0 -top-20 mx-auto w-5/12 rounded-3xl bg-white py-16 shadow-xl">
            <div class="flex flex-col items-center justify-center gap-11">
                <x-atoms.logo classLogo="h-auto w-48" />
                <p class="text-center font-lexend text-2xl font-normal leading-7">Ganti Password Akun</p>
            </div>

            <form class="mt-14" action="{{ route('changePassword') }}" method="post">
                @csrf
                <div class="flex flex-col justify-center gap-12">
                    <div>
                        <input class="@error('old_password') border-red-500 bg-red-500 @enderror field-input"
                            name="old_password" type="password" value="{{ old('old_password') }}" autofocus
                            placeholder="Masukkan Password Lama" required>

                        @error('old_password')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('new_password') border-red-500 bg-red-500 @enderror field-input"
                            name="new_password" type="password" value="{{ old('new_password') }}" autofocus
                            placeholder="Masukkan Password Baru" required>

                        @error('new_password')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('confirm_password') border-red-500 bg-red-500 @enderror field-input"
                            name="confirm_password" type="password" value="{{ old('confirm_password') }}" autofocus
                            placeholder="Konfirmasi Password Baru" required>

                        @error('confirm_password')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button class="btn-auth" type="submit">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app-layout>
