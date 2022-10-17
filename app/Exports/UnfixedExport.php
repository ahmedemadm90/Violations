<?php

namespace App\Exports;

use App\Models\UnfixedService;
use Maatwebsite\Excel\Concerns\FromCollection;

class UnfixedExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return UnfixedService::all();
    }
}
