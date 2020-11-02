@extends('layouts.app')

@section('content')

    @livewire('hello-world', [
    'name' => 'Chicho'])

    <br>
    <hr>
    <div class="bg-white shadow">
        @livewire('nesting-livewire')
    </div>
@endsection
