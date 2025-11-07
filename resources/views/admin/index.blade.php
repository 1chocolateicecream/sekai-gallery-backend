@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">All Assets ({{ $assets->total() }})</h3>
    </div>
    <div class="card-body">
        <!-- Filter Form -->
        <div class="filter-panel mb-4 p-3 bg-light rounded">
            <form method="GET" action="{{ route('assets.index') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">🎵 Фильтр по юниту:</label>
                        <select name="unit" class="form-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">Все юниты</option>
                            <option value="leoneed" {{ request('unit') == 'leoneed' ? 'selected' : '' }}>Leo/need</option>
                            <option value="vbs" {{ request('unit') == 'vbs' ? 'selected' : '' }}>Vivid BAD SQUAD</option>
                            <option value="mmj" {{ request('unit') == 'mmj' ? 'selected' : '' }}>MORE MORE JUMP!</option>
                            <option value="wxs" {{ request('unit') == 'wxs' ? 'selected' : '' }}>Wonderlands×Showtime</option>
                            <option value="n25" {{ request('unit') == 'n25' ? 'selected' : '' }}>25-ji, Nightcord de.</option>
                            <option value="other" {{ request('unit') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-7">
                        <label class="form-label fw-bold">🏷 Фильтр по тегам:</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(['room', 'school', 'stage', 'street', 'cafe', 'park', 'outdoor', 'indoor', 'sekai', 'день', 'вечер', 'ночь', 'event', 'festival'] as $tag)
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag }}"
                                           id="filter_{{ $tag }}"
                                           {{ is_array(request('tags')) && in_array($tag, request('tags')) ? 'checked' : '' }}
                                           onchange="document.getElementById('filterForm').submit()">
                                    <label class="form-check-label small" for="filter_{{ $tag }}">
                                        {{ $tag }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-2">
                        @if(request('unit') || request('tags'))
                            <a href="{{ route('assets.index') }}" class="btn btn-outline-secondary w-100">
                                ✕ Сбросить
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        @if($assets->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Image URL</th>
                            <th>Unit</th>
                            <th>Tags</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assets as $asset)
                        <tr>
                            <td>{{ $asset->id }}</td>
                            <td>
                                <img src="{{ $asset->image_url }}" alt="Preview" class="asset-preview">
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($asset->image_url, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ strtoupper($asset->unit) }}</span>
                            </td>
                            <td>
                                @foreach($asset->tags as $tag)
                                    <span class="badge bg-secondary tag-badge">{{ $tag }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('assets.edit', $asset) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('assets.destroy', $asset) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $assets->appends(request()->query())->links() }}
            </div>
        @else
            <div class="alert alert-info">
                No assets yet. <a href="{{ route('assets.create') }}">Create your first one!</a>
            </div>
        @endif
    </div>
</div>
@endsection
