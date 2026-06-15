<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Exports\LostItemsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;
use Spatie\Browsershot\Browsershot;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LostItemController extends Controller
{
    // LIST + SEARCH (USER + ADMIN)
    public function index(Request $request)
    {
        $query = LostItem::query();

        if ($request->search) {
            $query->where('item_name', 'like', '%' . $request->search . '%');
        }

    if ($request->status && $request->status != 'All') {
    $query->where('status', $request->status);
}    

        $sort = $request->sort ?? 'latest';

if ($sort == 'oldest') {
    $query->orderBy('created_at', 'asc');
} else {
    $query->orderBy('created_at', 'desc');
}

$items = $query->paginate(5);

        return view('lost_items.index', [
            'items' => $items,
            'search' => $request->search,
            'status' => $request->status,
            'sort' => $sort,
            'totalItems' => LostItem::count(),
            'lostItems' => LostItem::where('status', 'Lost')->count(),
            'foundItems' => LostItem::where('status', 'Found')->count(),
            'returnedItems' => LostItem::where('status', 'Returned')->count(),
        ]);
    }

    // CREATE FORM (ADMIN ONLY)
    public function create()
    {
        return view('lost_items.create');
    }

    // STORE (ADMIN ONLY)
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'contact_number' => 'required',
            'status' => 'required',
            'date' => 'required',
            'image' => 'nullable|image'
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only([
    'item_name',
    'description',
    'location',
    'contact_number',
    'date'
]);

$data['status'] = 'Pending';
$data['user_id'] = auth()->id();
           

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $data['image'] = $filename;
            }

            LostItem::create($data);

            DB::commit();

            return redirect()->route('items.index')
                ->with('success', 'Item added successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return back()->with('error', 'Failed to add item');
        }
        ActivityLog::create([
    'user_id' => Auth::id(),
    'action' => 'Item Added',
    'description' => 'User added a new item'
]);
    ActivityLog::create([
    'user_id' => Auth::id(),
    'action' => 'Item Updated',
    'description' => 'User updated an item'
]);
    ActivityLog::create([
    'user_id' => Auth::id(),
    'action' => 'Item Deleted',
    'description' => 'User deleted an item'
]);
    }

    // EDIT (ADMIN ONLY)
    public function edit($id)
    {
        $item = LostItem::findOrFail($id);
        return view('lost_items.edit', compact('item'));
    }

    // UPDATE (ADMIN ONLY)
    public function update(Request $request, $id)
    {
        $item = LostItem::findOrFail($id);

        $data = $request->only([
            'item_name',
            'description',
            'location',
            'contact_number',
            'status',
            'date'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $item->update($data);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully!');
    }

    // DELETE (ADMIN ONLY)
    public function destroy($id)
    {
        $item = LostItem::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully!');
    }

    // EXPORT (ADMIN)
    public function export()
    {
        return Excel::download(new LostItemsExport, 'items.xlsx');
    }

    // IMPORT (ADMIN)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ItemsImport, $request->file('file'));

        return back()->with('success', 'Imported successfully!');
    }

    // PDF (ADMIN)
    public function pdf()
    {
        $items = LostItem::all();

        $html = view('lost_items.pdf', compact('items'))->render();

        Browsershot::html($html)
            ->savePdf(public_path('report.pdf'));

        return response()->download(public_path('report.pdf'));
    }

    // SCREENSHOT (ADMIN)
    public function screenshot()
    {
        set_time_limit(300);

        $html = view('lost_items.index', [
            'items' => LostItem::paginate(5),
            'totalItems' => LostItem::count(),
            'lostItems' => LostItem::where('status', 'Lost')->count(),
            'foundItems' => LostItem::where('status', 'Found')->count(),
            'returnedItems' => LostItem::where('status', 'Returned')->count(),
        ])->render();

        return Browsershot::html($html)
            ->noSandbox()
            ->setDelay(3000)
            ->timeout(120)
            ->setOption('args', [
                '--no-sandbox',
                '--disable-dev-shm-usage'
            ])
            ->save(public_path('screenshot.png'));
    }
    public function myReports()
{
    $items = LostItem::where('user_id', auth()->id())
                ->latest()
                ->paginate(5);

    return view('lost_items.my_reports', compact('items'));
}
public function apiIndex()
{
    $items = \App\Models\LostItem::all();

    return response()->json([
        'status' => true,
        'data' => $items
    ]);
}
public function apiStore(Request $request)
{
    $item = LostItem::create([
        'item_name' => $request->item_name,
        'description' => $request->description,
        'location' => $request->location,
        'contact_number' => $request->contact_number,
        'status' => $request->status,
        'date' => $request->date,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Item added successfully',
        'data' => $item
    ]);
}
public function apiUpdate(Request $request, $id)
{
    $item = \App\Models\LostItem::find($id);

    if (!$item) {
        return response()->json([
            'status' => false,
            'message' => 'Item not found'
        ]);
    }

    $item->update([
        'item_name' => $request->item_name,
        'description' => $request->description,
        'location' => $request->location,
        'contact_number' => $request->contact_number,
        'status' => $request->status,
        'date' => $request->date,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Item updated successfully',
        'data' => $item
    ]);
}
public function apiDelete($id)
{
    $item = \App\Models\LostItem::find($id);

    if (!$item) {
        return response()->json([
            'status' => false,
            'message' => 'Item not found'
        ]);
    }

    $item->delete();

    return response()->json([
        'status' => true,
        'message' => 'Item deleted successfully'
    ]);
}
}