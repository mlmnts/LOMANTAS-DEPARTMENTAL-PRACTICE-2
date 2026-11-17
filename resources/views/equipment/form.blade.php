<div class="mb-3">
    <label class="form-label">Equipment Name</label>
    <input type="text" name="equipment_name" value="{{ old('equipment_name', $equipment->equipment_name ?? '') }}"
           class="form-control @error('equipment_name') is-invalid @enderror">
    @error('equipment_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category" class="form-select @error('category') is-invalid @enderror">
        <option value="">-- Select --</option>
        @foreach (\App\Models\Equipment::CATEGORIES as $cat)
            <option value="{{ $cat }}" @selected(old('category', $equipment->category ?? '') === $cat)>{{ $cat }}</option>
        @endforeach
    </select>
    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- type="text" on purpose, so bad values reach the server and you can demo server-side validation --}}
<div class="mb-3">
    <label class="form-label">Unit Price (₱)</label>
    <input type="text" inputmode="decimal" name="unit_price"
           value="{{ old('unit_price', $equipment->unit_price ?? '') }}"
           class="form-control @error('unit_price') is-invalid @enderror">
    @error('unit_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description (include specifications)</label>
    <textarea name="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $equipment->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Availability Status</label>
    <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror">
        @foreach (\App\Models\Equipment::STATUSES as $value => $label)
            <option value="{{ $value }}" @selected(old('availability_status', $equipment->availability_status ?? 'available') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    @error('availability_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary">Save</button>
<a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancel</a>