@extends('layouts.master')

@section('title', 'Add Equipment')

@section('content')
<h3>Add Equipment</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('equipment.store') }}">
        @csrf
        @include('equipment._form')
    </form>
</div></div>
@endsection