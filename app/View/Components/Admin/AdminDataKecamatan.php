<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use App\Models\Kecamatan;

class AdminDataKecamatan extends Component
{
    public $kecamatans;

    public function __construct($kecamatans)
    {
        $this->kecamatans = $kecamatans;
    }

    public function render()
    {
        return view('admin.pages.data');
    }
}
