@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Edit Asset #{{ $asset->id }}</h3>
    </div>
    <div class="card-body">
        <!-- Preview of current image -->
        <div class="mb-4 text-center">
            <img src="{{ $asset->image_url }}" alt="Current preview" class="img-fluid" style="max-height: 300px; border-radius: 8px;">
        </div>

        <form action="{{ route('assets.update', $asset) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL *</label>
                <input type="url" class="form-control @error('image_url') is-invalid @enderror"
                       id="image_url" name="image_url" value="{{ old('image_url', $asset->image_url) }}"
                       placeholder="https://example.com/image.jpg" required>
                @error('image_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit *</label>
                <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit" required>
                    <option value="">-- Select Unit --</option>
                    <option value="leoneed" {{ old('unit', $asset->unit) == 'leoneed' ? 'selected' : '' }}>Leo/need</option>
                    <option value="vbs" {{ old('unit', $asset->unit) == 'vbs' ? 'selected' : '' }}>Vivid BAD SQUAD</option>
                    <option value="mmj" {{ old('unit', $asset->unit) == 'mmj' ? 'selected' : '' }}>MORE MORE JUMP!</option>
                    <option value="wxs" {{ old('unit', $asset->unit) == 'wxs' ? 'selected' : '' }}>Wonderlands×Showtime</option>
                    <option value="n25" {{ old('unit', $asset->unit) == 'n25' ? 'selected' : '' }}>25-ji, Nightcord de.</option>
                    <option value="other" {{ old('unit', $asset->unit) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tags * (select all that apply)</label>

                <h6 class="mt-3 mb-2 text-muted">Локация:</h6>
                <div class="row">
                    @foreach(['room', 'school', 'stage', 'street', 'cafe', 'park', 'outdoor', 'indoor', 'sekai', 'крыша', 'класс', 'коридор'] as $tag)
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag }}"
                                   id="tag_{{ $tag }}"
                                   {{ in_array($tag, old('tags', $asset->tags ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag_{{ $tag }}">
                                {{ ucfirst($tag) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h6 class="mt-3 mb-2 text-muted">Время суток:</h6>
                <div class="row">
                    @foreach(['день', 'вечер', 'ночь'] as $tag)
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag }}"
                                   id="tag_{{ $tag }}"
                                   {{ in_array($tag, old('tags', $asset->tags ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag_{{ $tag }}">
                                {{ ucfirst($tag) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h6 class="mt-3 mb-2 text-muted">Событие:</h6>
                <div class="row">
                    @foreach(['event', 'festival'] as $tag)
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag }}"
                                   id="tag_{{ $tag }}"
                                   {{ in_array($tag, old('tags', $asset->tags ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag_{{ $tag }}">
                                {{ ucfirst($tag) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h6 class="mt-3 mb-2 text-muted">Погода:</h6>
                <div class="row">
                    @foreach(['другая погода'] as $tag)
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag }}"
                                   id="tag_{{ str_replace(' ', '_', $tag) }}"
                                   {{ in_array($tag, old('tags', $asset->tags ?? [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tag_{{ str_replace(' ', '_', $tag) }}">
                                {{ ucfirst($tag) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>

                @error('tags')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Asset</button>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

        <!-- Delete form outside main form to prevent conflicts -->
        <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this asset?')">Delete Asset</button>
        </form>
    </div>
</div>
@endsection
