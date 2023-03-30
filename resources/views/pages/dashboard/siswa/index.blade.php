<x-layouts.app-layout title="{{ $title }}">

    <x-organisms.header-dashboard />

    <section class="layout min-h-screen bg-hero py-14 font-rubik">

        <div class="relative overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full text-left">

                <div class="bg-white py-5 px-9">
                    <div class="flex h-14 flex-row items-center justify-between rounded-3xl bg-hero px-20">
                        <h4 class="text-2xl font-bold text-white">Data Siswa</h4>

                        <div class="flex flex-row gap-4">
                            <x-molecules.search />

                            <a href="{{ URL('dashboard/tambah-siswa') }}">
                                <img class="h-auto w-10" src="{{ URL('assets/icons/plus.svg') }}" alt="tambah-siswa">
                            </a>

                        </div>
                    </div>
                </div>

                <thead class="border-b border-gray-200 bg-white text-base font-medium text-gray-500">
                    <tr>
                        <th class="px-9 py-3" scope="col">
                            No.
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('nis', 'NIS')

                                <svg class="h-5 w-5" viewBox="0 0 17 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="17" height="21" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_100_2178"
                                                transform="matrix(0.0153186 0 0 0.0124008 -0.235294 -0.0952381)" />
                                        </pattern>
                                        <image id="image0_100_2178" width="96" height="96"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAACiUlEQVR4nO3cPWgUQRjG8b8fMSCnpJAQJGChIMTCwsbCIlrYpLKxCLGxSSPYCFY2NsqpQbDQxka0sDRdCkmRwsZCEEGwEUSjuaCoiGg0I4s7ECXG+9i9mXfm+cEDIVX2eXPHfswOiIiIiIiIiIiIiIiIxGkQuAy8BRbLn4vfSR9sB+YA91fmgR2aQL0awMN1yvdZAHZqCPUYAh5tUL7PY2CXhlCtYeBJG+X7PAN2awjVGAGedlC+z3NgVEPozR7gRRfl+7wE9mkI3dkPvOqhfJ/iNPWAhtCZMeB1BeX7vAMOagjtOQS0Kizf5wNwWEPY2BHgYw3l+3wGjmkI6xsHPtVYvs8X4LiG8KcJ4Gsfyvf5BpzQEH47CXzvY/k+P4BTZG4SWAlQ/tohnCZT08DPgOX7rAJnycyZ8sBdRLlAJs5HULb7R4oHO0m7GEHJ7j+5AWwiMcUBXY+gXNdmbgGbScQW4HYEpboOcw/YSgLl34mgTNdl7gMDGLUNeBBBia7HzFpdcXE1gvJcRbmCQXXcUnaBsoRBKQ2ghUHXIijOVZTi69ScgXIIlj8JLaBp+UxIRERERETyUtwNnQGWI7igcl1mubwKNnkhNhNBga6iFFf05li+BeFSuBmX0gCWMCilBzJNDBosH+c545m1+kiyoIfyEbC6LOVuCstSrC7MupnSwixrSxObKS5NXEuLcyMQ2/L0VeAcmZnWCxrhTeoVpXxf0lsBpkIffCwm9JpqeON6UTuPrQqOhj7IXDfreK/NOto3pu1q0tmw6Y02bAq7ZdneCv8psjSiTfvCG9a2leENaePW8Braujjuzbsbof+43LavXyxPMy9ZXrkgIiIiIiIiIiIiIiIk7RfUS7cbQdmIYQAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('nama_siswa', 'Nama Siswa')

                                <svg class="h-5 w-5" viewBox="0 0 17 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="17" height="21" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_100_2178"
                                                transform="matrix(0.0153186 0 0 0.0124008 -0.235294 -0.0952381)" />
                                        </pattern>
                                        <image id="image0_100_2178" width="96" height="96"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAACiUlEQVR4nO3cPWgUQRjG8b8fMSCnpJAQJGChIMTCwsbCIlrYpLKxCLGxSSPYCFY2NsqpQbDQxka0sDRdCkmRwsZCEEGwEUSjuaCoiGg0I4s7ECXG+9i9mXfm+cEDIVX2eXPHfswOiIiIiIiIiIiIiIiIxGkQuAy8BRbLn4vfSR9sB+YA91fmgR2aQL0awMN1yvdZAHZqCPUYAh5tUL7PY2CXhlCtYeBJG+X7PAN2awjVGAGedlC+z3NgVEPozR7gRRfl+7wE9mkI3dkPvOqhfJ/iNPWAhtCZMeB1BeX7vAMOagjtOQS0Kizf5wNwWEPY2BHgYw3l+3wGjmkI6xsHPtVYvs8X4LiG8KcJ4Gsfyvf5BpzQEH47CXzvY/k+P4BTZG4SWAlQ/tohnCZT08DPgOX7rAJnycyZ8sBdRLlAJs5HULb7R4oHO0m7GEHJ7j+5AWwiMcUBXY+gXNdmbgGbScQW4HYEpboOcw/YSgLl34mgTNdl7gMDGLUNeBBBia7HzFpdcXE1gvJcRbmCQXXcUnaBsoRBKQ2ghUHXIijOVZTi69ScgXIIlj8JLaBp+UxIRERERETyUtwNnQGWI7igcl1mubwKNnkhNhNBga6iFFf05li+BeFSuBmX0gCWMCilBzJNDBosH+c545m1+kiyoIfyEbC6LOVuCstSrC7MupnSwixrSxObKS5NXEuLcyMQ2/L0VeAcmZnWCxrhTeoVpXxf0lsBpkIffCwm9JpqeON6UTuPrQqOhj7IXDfreK/NOto3pu1q0tmw6Y02bAq7ZdneCv8psjSiTfvCG9a2leENaePW8Braujjuzbsbof+43LavXyxPMy9ZXrkgIiIiIiIiIiIiIiIk7RfUS7cbQdmIYQAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('tinggi_badan', 'Tinggi Badan (cm)')

                                <svg class="h-5 w-5" viewBox="0 0 17 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="17" height="21" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_100_2178"
                                                transform="matrix(0.0153186 0 0 0.0124008 -0.235294 -0.0952381)" />
                                        </pattern>
                                        <image id="image0_100_2178" width="96" height="96"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAACiUlEQVR4nO3cPWgUQRjG8b8fMSCnpJAQJGChIMTCwsbCIlrYpLKxCLGxSSPYCFY2NsqpQbDQxka0sDRdCkmRwsZCEEGwEUSjuaCoiGg0I4s7ECXG+9i9mXfm+cEDIVX2eXPHfswOiIiIiIiIiIiIiIiIxGkQuAy8BRbLn4vfSR9sB+YA91fmgR2aQL0awMN1yvdZAHZqCPUYAh5tUL7PY2CXhlCtYeBJG+X7PAN2awjVGAGedlC+z3NgVEPozR7gRRfl+7wE9mkI3dkPvOqhfJ/iNPWAhtCZMeB1BeX7vAMOagjtOQS0Kizf5wNwWEPY2BHgYw3l+3wGjmkI6xsHPtVYvs8X4LiG8KcJ4Gsfyvf5BpzQEH47CXzvY/k+P4BTZG4SWAlQ/tohnCZT08DPgOX7rAJnycyZ8sBdRLlAJs5HULb7R4oHO0m7GEHJ7j+5AWwiMcUBXY+gXNdmbgGbScQW4HYEpboOcw/YSgLl34mgTNdl7gMDGLUNeBBBia7HzFpdcXE1gvJcRbmCQXXcUnaBsoRBKQ2ghUHXIijOVZTi69ScgXIIlj8JLaBp+UxIRERERETyUtwNnQGWI7igcl1mubwKNnkhNhNBga6iFFf05li+BeFSuBmX0gCWMCilBzJNDBosH+c545m1+kiyoIfyEbC6LOVuCstSrC7MupnSwixrSxObKS5NXEuLcyMQ2/L0VeAcmZnWCxrhTeoVpXxf0lsBpkIffCwm9JpqeON6UTuPrQqOhj7IXDfreK/NOto3pu1q0tmw6Y02bAq7ZdneCv8psjSiTfvCG9a2leENaePW8Braujjuzbsbof+43LavXyxPMy9ZXrkgIiIiIiIiIiIiIiIk7RfUS7cbQdmIYQAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            <div class="flex flex-row items-center gap-1">
                                @sortablelink('berat_badan', 'Berat Badan (kg)')

                                <svg class="h-5 w-5" viewBox="0 0 17 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="17" height="21" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                            height="1">
                                            <use xlink:href="#image0_100_2178"
                                                transform="matrix(0.0153186 0 0 0.0124008 -0.235294 -0.0952381)" />
                                        </pattern>
                                        <image id="image0_100_2178" width="96" height="96"
                                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAACiUlEQVR4nO3cPWgUQRjG8b8fMSCnpJAQJGChIMTCwsbCIlrYpLKxCLGxSSPYCFY2NsqpQbDQxka0sDRdCkmRwsZCEEGwEUSjuaCoiGg0I4s7ECXG+9i9mXfm+cEDIVX2eXPHfswOiIiIiIiIiIiIiIiIxGkQuAy8BRbLn4vfSR9sB+YA91fmgR2aQL0awMN1yvdZAHZqCPUYAh5tUL7PY2CXhlCtYeBJG+X7PAN2awjVGAGedlC+z3NgVEPozR7gRRfl+7wE9mkI3dkPvOqhfJ/iNPWAhtCZMeB1BeX7vAMOagjtOQS0Kizf5wNwWEPY2BHgYw3l+3wGjmkI6xsHPtVYvs8X4LiG8KcJ4Gsfyvf5BpzQEH47CXzvY/k+P4BTZG4SWAlQ/tohnCZT08DPgOX7rAJnycyZ8sBdRLlAJs5HULb7R4oHO0m7GEHJ7j+5AWwiMcUBXY+gXNdmbgGbScQW4HYEpboOcw/YSgLl34mgTNdl7gMDGLUNeBBBia7HzFpdcXE1gvJcRbmCQXXcUnaBsoRBKQ2ghUHXIijOVZTi69ScgXIIlj8JLaBp+UxIRERERETyUtwNnQGWI7igcl1mubwKNnkhNhNBga6iFFf05li+BeFSuBmX0gCWMCilBzJNDBosH+c545m1+kiyoIfyEbC6LOVuCstSrC7MupnSwixrSxObKS5NXEuLcyMQ2/L0VeAcmZnWCxrhTeoVpXxf0lsBpkIffCwm9JpqeON6UTuPrQqOhj7IXDfreK/NOto3pu1q0tmw6Y02bAq7ZdneCv8psjSiTfvCG9a2leENaePW8Braujjuzbsbof+43LavXyxPMy9ZXrkgIiIiIiIiIiIiIiIk7RfUS7cbQdmIYQAAAABJRU5ErkJggg==" />
                                    </defs>
                                </svg>
                            </div>
                        </th>
                        <th class="px-6 py-3" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>

                @if ($siswa->count())
                    @foreach ($siswa as $item)
                        <tbody>
                            <tr class="bg-white text-base font-medium leading-5 hover:bg-gray-50">
                                <th class="py-4 px-9" scope="row">
                                    {{ ($siswa->currentPage() - 1) * $siswa->perPage() + $loop->iteration }}
                                </th>
                                <td class="py-4 pl-6">
                                    {{ $item->nis }}
                                </td>
                                <td class="py-4 pl-6">
                                    {{ $item->nama_siswa }}
                                </td>
                                <td class="py-4 pl-32">
                                    {{ $item->tinggi_badan }}
                                </td>
                                <td class="py-4 pl-32">
                                    {{ $item->berat_badan }}
                                </td>
                                <td class="mr-3 flex flex-row items-center gap-5 py-4 2xl:m-0">
                                    <a href="">
                                        <img class="h-auto w-9" src="{{ URL('assets/icons/eye.svg') }}"
                                            alt="detail-siswa">
                                    </a>

                                    <a href="{{ route('siswa.edit', $item->nis) }}">
                                        <img class="h-auto w-7" src="{{ URL('assets/icons/edit.svg') }}"
                                            alt="edit-siswa">
                                    </a>

                                    <form action="{{ route('siswa.destroy', $item->nis) }}" method="post">
                                        @method('delete')
                                        @csrf

                                        <button class="focus:outline-none"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            <img class="mt-1.5 h-auto w-7" src="{{ URL('assets/icons/trash.svg') }}"
                                                alt="delete">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>

            <div class="bg-white p-6">
                {{ $siswa->links('vendor.pagination.tailwind') }}
            </div>

        </div>

    </section>

</x-layouts.app-layout>
