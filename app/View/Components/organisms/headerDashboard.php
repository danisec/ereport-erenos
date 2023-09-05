<?php

namespace App\View\Components\organisms;

use Illuminate\Support\Facades\Auth;
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
        $userRole = Auth::user()->role;

        $navbar = [];
        $dataSekolah = [];
        $pemetaan = [];
        $pelajaran = [];
        $navbarLast = [];

        if($userRole === 'superadmin') {
            $navbar = [
                'Dashboard' => '',
                'Pengumuman' => 'pengumuman',
            ];

            $dataSekolah = [
                'Siswa' => 'siswa',
                'History Siswa' => 'history-siswa',
                'Guru' => 'guru',
                'Kelas' => 'kelas',
            ];

            $pemetaan = [
                'Kelas' => 'mappingkelas',
                'Jadwal' => 'mappingjadwal',
            ];

            $pelajaran = [
                'Mata Pelajaran' => 'pelajaran',
                'Materi' => 'materi',
            ];

            $navbarLast = [
                'Tahun Ajaran' => 'tahunajaran',
                'Presensi' => 'presensi',
                'Nilai' => 'nilai',
                'Rapor' => 'rapor',
            ];
        } elseif ($userRole === 'admin') {
            // Menu khusus untuk peran admin
            // ...
        } elseif ($userRole === 'guru') {
            $navbar = [
                'Dashboard' => '',
            ];

            $navbarLast = [
                'Presensi' => 'presensi',
                'Nilai' => 'nilai',
                'Rapor' => 'rapor',
            ];
        }

        return view('components.organisms.header-dashboard', compact(
            'navbar', 
        'dataSekolah',
        'pemetaan', 
        'pelajaran',
        'navbarLast',
        ));
    }
}
