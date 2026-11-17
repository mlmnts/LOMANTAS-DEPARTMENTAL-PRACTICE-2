@extends('layouts.master')

@section('title', 'Equipment')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Pickleball Equipment</h3>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary">+ Add Equipment</a>
</div>

<div class="card shadow-sm">
    <table class="table table-hover mb-0 align-middle">
        <thead class="table-light">
            <tr><th>Name</th><th>Category</th><th>Price</th><th>Status</th><th>Added By</th><th class="text-end">Actions</th></tr>
        </thead>
        <tbody>
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->equipment_name }}</td>
                <td>{{ $item->category }}</td>
                <td>₱{{ number_format($item->unit_price, 2) }}</td>
                <td>
                    <span class="badge {{ $item->availability_status === 'available' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($item->availability_status) }}
                    </span>
                </td>
                <td>{{ $item->user->name }}</td>
                <td class="text-end">
                    <a href="{{ route('equipment.show', $item) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('equipment.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                    {{-- DELETE needs @method('DELETE'); confirm() asks before deleting --}}
                    <form action="{{ route('equipment.destroy', $item) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this equipment record?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No equipment yet.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $items->links('pagination::bootstrap-5') }}</div>
@endsection