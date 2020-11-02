<div>
    Hello {{ $contact->name }} : {{ now() }}

    <button class="btn" wire:click="emitFoo">refresh</button>
</div>
