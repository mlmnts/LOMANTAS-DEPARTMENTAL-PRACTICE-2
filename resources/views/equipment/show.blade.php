@extends('layouts.master')

@section('title', $equipment->equipment_name)

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <h3>{{ $equipment->equipment_name }}</h3>
    <dl class="row">
        <dt class="col-sm-3">Category</dt><dd class="col-sm-9">{{ $equipment->category }}</dd>
        <dt class="col-sm-3">Unit Price</dt><dd class="col-sm-9">₱{{ number_format($equipment->unit_price, 2) }}</dd>
        <dt class="col-sm-3">Availability</dt><dd class="col-sm-9">{{ ucfirst($equipment->availability_status) }}</dd>
        <dt class="col-sm-3">Description</dt><dd class="col-sm-9">{{ $equipment->description }}</dd>
        <dt class="col-sm-3">Added By</dt><dd class="col-sm-9">{{ $equipment->user->name }}</dd>
    </dl>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning">Edit</a>
</div></div>
@endsection