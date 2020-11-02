<div>
    @foreach($contacts as $contact)
        @livewire('say-hi', ['contact' => $contact], key($contact->id))
        <button wire:click="removeContact('{{ $contact->name }}')">Remove Contact</button>
    @endforeach

    <hr>
    <button wire:click="$emit('refreshChildren')">Refresh Children</button>

    {{--        <button wire:click="$refresh">refresh</button>--}}
    {{ now() }}
</div>
