<?php

namespace App\Exports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BannerExport implements FromView
{
    public function __construct($banner)
    {
        $this->banner = $banner;
    }

    public function view(): View
    {
        return view('backend.banner.export', [
            'banner' => $this->banner
        ]);
    }
}
