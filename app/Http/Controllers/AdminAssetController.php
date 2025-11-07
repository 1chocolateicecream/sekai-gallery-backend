<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AdminAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asset::query();

        // Filter by unit
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // Filter by tags
        if ($request->filled('tags')) {
            foreach ($request->tags as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
        }

        $assets = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_url' => 'required|url',
            'unit' => 'required|in:leoneed,vbs,mmj,wxs,n25,other',
            'tags' => 'required|array',
            'tags.*' => 'string',
        ]);

        Asset::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('admin.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        return view('admin.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'image_url' => 'required|url',
            'unit' => 'required|in:leoneed,vbs,mmj,wxs,n25,other',
            'tags' => 'required|array',
            'tags.*' => 'string',
        ]);

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully!');
    }
}
