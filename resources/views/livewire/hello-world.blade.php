<div>
    <input wire:model="name" type="text">
    <input wire:model="loud" type="checkbox">
    <select wire:model="greeting" multiple>
        <option>Hello</option>
        <option>Goodbye</option>
        <option>Adios</option>
    </select>

    {{ implode(', ', $greeting) }} {{ $name }} @if ($loud) ! @endif

    <form action wire:submit.prevent="$set('name', 'Bingo')">
        <button class="btn">Reset Name</button>
    </form>
</div>


