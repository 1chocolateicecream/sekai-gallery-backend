<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Get all assets with optional filtering
     *
     * Query params:
     * - unit: Filter by unit (leoneed, vbs, mmj, wxs, n25, other)
     * - tags[]: Filter by tags (multiple allowed, uses AND logic)
     *
     * Example: /api/v1/images?unit=leoneed&tags[]=room&tags[]=school
     */
    public function index(Request $request)
    {
        $query = Asset::query();

        // Filter by unit
        if ($request->has('unit') && !empty($request->unit)) {
            $query->where('unit', $request->unit);
        }

        // Filter by tags (AND logic - asset must have ALL specified tags)
        if ($request->has('tags') && is_array($request->tags)) {
            foreach ($request->tags as $tag) {
                $query->whereJsonContains('tags', $tag);
            }
        }

        // Order by most recent first
        $query->orderBy('created_at', 'desc');

        $assets = $query->get();

        return response()->json($assets);
    }
}
