<?php

namespace App\View\Components\organisms;

use Illuminate\View\Component;

class headerDashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $navbar = [
         'Dashboard' => '',
         'Siswa' => 'siswa',
         'Guru' => 'guru',
         'kelas' => 'kelas',
         'Tahun Ajaran' => 'tahunajaran',
         'Mata Pelajaran' => 'pelajaran',
         'Mapping Kelas' => 'mappingkelas',
         'Mapping Jadwal' => 'mappingjadwal',
        ];

        return view('components.organisms.header-dashboard', compact('navbar'));
    }
}
