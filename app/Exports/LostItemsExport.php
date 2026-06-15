<?php

namespace App\Exports;

use App\Models\LostItem;
use Maatwebsite\Excel\Concerns\FromCollection;

class LostItemsExport implements FromCollection
{
    public function collection()
    {
        return LostItem::all();
    }
}