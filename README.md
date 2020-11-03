# Livewire essentials -- Getting started tutorials
-- composer require livewire/livewire
-- livewire:make componentName
@livewireStyles in head
@livewireScripts in body


# Passing data into the blade
views/livewire/componentName - rendered view
Http/Livewire/ComponentName - pass the data
include the view @livewire('componentName')

# Data binding
-- when you add public property it's automatically passed to the view
-- wire:model - keep the value of th input element and  sync it with the value passed from the public property (backend)
-- As you do some action it's sending ajax requests
-- debounce.1--ms - wire:model attribute that defines when to send the ajax 
request 
-- lazy - wire:model attribute that sends the request after you click away.
-- it doesn't have wire-if wire-loop like vue, it uses laravel blade directives
- for multiple select make the property array and implode it.

# Actions
-- fire methods on livewire component 
-- wire:click="methodName('acceptParam')" it can accept parameters
-- define the method in the Component
-- magic $event variable that is accepted in the method
-- $event.target.innerText
-- wire:submit.prevent="methodName('param'), you must prevent the form from submitting
if you want to display other action!
-- you can pass the data directly without creating a method in the Component
$set('property', 'Bing'); 

# Livecycle Hook
-- mount method is the __construct of livewire. Then the component is loaded
the first will be called the mount method
-- we can pass data in the mount method, and pass the parameters in the blade component like
we do in the @include 
-- we can dependency inject in the mount method and pass Request, then in the url assign the ?name="
-- You should not pass Request anywhere else.
-- hydrate method will run after the mount method (it runs after mount method). Every action you will
make it will trigger this livecycle method.
-- updated method it runs after the property is updated!
-- updating 
-- scope all methods to run on a specific property, to do that
you add the property on the method name updatedFoo (studlyCase)

# Nesting

-- you can nest components in a component, use foreach loop, you should add key() if the data is changed
not to be lost.
-- you can store eloquent models and collections as public property
-- wire:click="$refresh" magic method, refreshes Carbon now()
-- Child component aren't rendered from the parent on subsequent requests
-- When we hit refresh it refreshes just the parent component, and each child refreshes separately
-- you can pass the modal attribute(name) in the method 

# Events
-- Events are livewire API to enable communication between child components and parent
components. 
-- we use $this->emit('nameOfMethod') then a request is sent to the server then it comes back to emit the event, then
it listens to the event in the property $listeners in the child component and fires an event
-- you can also pass parameters in the emit.
-- we can use magic $emit method on the view to skip extra call to the server 
-- but this way it will refresh only the children
-- you can call it from the dev tools Livewire, window.livewire livewire.emit('bla')
-- emitUp fires the event in the one of the children components and the parent

---------------------------------------------------------------------------------------------------

# A Basic form with validation
