<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-6 font-rubik">
        <div class="w-full rounded-2xl bg-white py-5 shadow-sm">

            <div class="w-6/12 rounded-r-2xl bg-hero py-2">
                <h4 class="text-gray-9000 px-11 text-2xl font-bold text-white">View Data Akun</h4>
            </div>

            <div class="flex flex-col gap-3 px-11 pt-9">

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Nama Lengkap</label>
                        <input class="field-input-gray w-52" value="{{ $akun->name }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Username</label>
                        <input class="field-input-gray w-8/12" value="{{ $akun->username }}"
                            @disabled(true) @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">NIP</label>
                        <input class="field-input-gray w-96" value="{{ $akun->NIP }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Email</label>
                        <input class="field-input-gray w-96" value="{{ $akun->email }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex flex-row items-center">
                        <label class="mb-2 w-44 text-xl font-medium leading-9">Role</label>
                        <input class="field-input-gray w-32" value="{{ $akun->role }}" @disabled(true)
                            @readonly(true)>
                    </div>
                </div>

                <div class="flex flex-row items-center justify-center py-3">
                    <a class="rounded-sm bg-cyan-300 px-10 py-3 text-center text-sm font-normal shadow-xl shadow-gray-300"
                        href="{{ route('kelolaAkun.index') }}">Back</a>
                </div>
            </div>

        </div>

    </section>

</x-layouts.app-layout>
