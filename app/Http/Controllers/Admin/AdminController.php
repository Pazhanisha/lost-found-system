<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostItem;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalItems = LostItem::count();
        $lostItems = LostItem::where('status', 'Lost')->count();
        $foundItems = LostItem::where('status', 'Found')->count();
        $returnedItems = LostItem::where('status', 'Returned')->count();

        return view('admin.dashboard', compact(
            'totalItems',
            'lostItems',
            'foundItems',
            'returnedItems'
        ));
    }
}