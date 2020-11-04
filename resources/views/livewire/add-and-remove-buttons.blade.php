<div>
    @if ($successMessage)
        <div class="rounded-md bg-green-50 p-4 my-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-green-800">
                        {{ $successMessage }}
                    </p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button wire:click="$set('successMessage', false)" type="button"
                                class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150"
                                aria-label="Dismiss">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <table class="table-auto min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Phone</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($contacts as $key => $value)
            <tr class="bg-gray-100">
                <td class="px-4 py-2">{{ $value->id }}</td>
                <td class="px-4 py-2 text-center">{{ $value->name }}</td>
                <td class="px-4 py-2 text-center">{{ $value->phone }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form wire:submit.prevent="store" action="#" method="POST">
        <div class="add-input pb-3">
            <div class="row">
                <div class="pt-5">
                    <div class="w-1/6">
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Name" wire:model="name.0">
                        @error('name.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="pb-3">
                    <div class="w-1/6 mt-3">
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="phone.0" placeholder="Enter Phone">
                        @error('phone.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="add({{$i}})">Add</button>
                </div>
            </div>
        </div>

        @foreach($inputs as $key => $value)
            <div class="add-input">
                <div class="row">
                    <div class="pt-3">
                        <div class="w-1/6">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Name" wire:model="name.{{ $value }}">
                            @error('name.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="w-1/6 mt-3">
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="phone.{{ $value }}" placeholder="Enter phone">
                            @error('phone.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="pt-3">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click.prevent="remove({{$key}})">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="pt-5">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded disabled:opacity-50">
                    <svg wire:loading wire:target="store" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Submit</span>
                </button>
            </div>
        </div>
    </form>

    <div class="h-2">
        {{ $contacts->links() }}
    </div>
</div>
