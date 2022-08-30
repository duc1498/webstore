<?php

namespace App\Imports;

use App\Models\Banner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class BannerImport implements ToModel, WithHeadingRow
{
    public function withStart()
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $banner = Banner::create([
            "title"=> data_get($row,'title'),
            "slug"=> data_get($row,'title').Str::random(2),
            "image"=> data_get($row,'image'),
            "url"=> data_get($row,'url'),
            "target"=> data_get($row,'target'),
            "description"=> data_get($row,'description'),
            "type"=> 1,
            "position"=> data_get($row,'position'),
            "is_active"=> 1,

        ]);
        return $banner ;
    }
}
