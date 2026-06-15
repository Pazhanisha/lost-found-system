<?php

namespace App\Imports;

use App\Models\LostItem;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    public function model(array $row)
    {
        return new LostItem([
            'item_name'      => $row[0],
            'description'    => $row[1],
            'location'       => $row[2],
            'contact_number' => $row[3],
            'status'         => $row[4],
            'date'           => $row[5],
        ]);
    }
}