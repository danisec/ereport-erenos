<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class HeaderDashboard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $navbar;
    public $dataSekolah;
    public $pemetaan;
    public $pelajaran;
    public $navbarLast;
    public function __construct()
    {
        $userRole = Auth::user()->role;

        $this->navbar = [];
        $this->dataSekolah = [];
        $this->pemetaan = [];
        $this->pelajaran = [];
        $this->navbarLast = [];

        if($userRole === 'superadmin') {
            $this->navbar = [
                'Dashboard' => '',
                'Pengumuman' => 'pengumuman',
            ];

            $this->dataSekolah = [
                'Siswa' => 'siswa',
                'History Siswa' => 'history-siswa',
                'Guru' => 'guru',
                'Kelas' => 'kelas',
            ];

            $this->pemetaan = [
                'Kelas' => 'mappingkelas',
                'Jadwal' => 'mappingjadwal',
            ];

            $this->pelajaran = [
                'Mata Pelajaran' => 'pelajaran',
                'Materi' => 'materi',
            ];

            $this->navbarLast = [
                'Tahun Ajaran' => 'tahunajaran',
                'Presensi' => 'presensi',
                'Nilai' => 'nilai',
                'Rapor' => 'rapor',
            ];
        } elseif ($userRole === 'admin') {
            // Menu khusus untuk peran admin
            // ...
        } elseif ($userRole === 'guru') {
            $this->navbar = [
                'Dashboard' => '',
            ];

            $this->navbarLast = [
                'History Siswa' => 'history-siswa',
                'Presensi' => 'presensi',
                'Nilai' => 'nilai',
                'Rapor' => 'rapor',
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header-dashboard', [
            'navbar' => $this->navbar,
            'dataSekolah' => $this->dataSekolah,
            'pemetaan' => $this->pemetaan,
            'pelajaran' => $this->pelajaran,
            'navbarLast' => $this->navbarLast,
        ]);
    }
}
