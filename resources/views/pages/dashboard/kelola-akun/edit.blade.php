<x-layouts.app-layout title="{{ $title }}">

    <div class="h-32 w-full bg-login-pattern bg-cover bg-no-repeat">
        <x-molecules.breadcrumb :title="$title" />
    </div>

    <div class="absolute min-h-screen w-full bg-hero">
        <div class="relative inset-x-0 -top-20 mx-auto w-5/12 rounded-3xl bg-white py-16 shadow-xl">
            <div class="flex flex-col items-center justify-center gap-11">
                <x-atoms.logo classLogo="h-auto w-48" />
                <p class="text-center font-lexend text-2xl font-normal leading-7">Ubah Akun</p>
            </div>

            <form class="mt-14" action="{{ route('kelolaAkun.update', $akun->id) }}" method="post">
                @method('put')
                @csrf

                <div class="flex flex-col justify-center gap-12">
                    <div>
                        <input class="@error('name') border-red-500 bg-red-500 @enderror field-input"" name="name"
                            type="text" value="{{ $akun->name }}" placeholder="Nama Lengkap" required>

                        @error('name')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('username') border-red-500 bg-red-500 @enderror field-input"
                            name="username" type="text" value="{{ $akun->username }}" placeholder="Username"
                            required>

                        @error('username')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('email') border-red-500 bg-red-500 @enderror field-input" name="email"
                            type="email" value="{{ $akun->email }}" placeholder="Email" required>

                        @error('email')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('NIP') border-red-500 bg-red-500 @enderror field-input" name="NIP"
                            type="number" value="{{ $akun->NIP }}" placeholder="NIP" required>

                        @error('NIP')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <select class="@error('role') border-red-500 bg-red-500 @enderror field-input" name="role"
                            required>
                            <option selected disabled hidden>Role</option>

                            @foreach ($role as $index => $item)
                                <option value="{{ $index }}" {{ $index == $akun->role ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>

                        @error('role')
                            <p class="invalid-feedback">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <input class="@error('password') border-red-500 bg-red-500 @enderror field-input"
                            name="password" type="password" placeholder="Password" required>

                        @error('password')
                            <p class="mx-auto w-9/12 text-sm font-medium tracking-wide text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button class="btn-auth" type="submit">Ubah</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app-layout>
