@extends('layouts.master')

@section('title', 'Edit Equipment')

@section('content')
<h3>Edit Equipment</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('equipment.update', $equipment) }}">
        @csrf @method('PUT')
        @include('equipment._form')
    </form>
</div></div>
@endsection