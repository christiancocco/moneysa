
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="gap-4 m-2 md:grid md:grid-cols-1 lg:grid-cols-1">
                @auth
                <div class="flex flex-row justify-between">
                    <a href="{{ route('new-post-front') }}" class="px-2 py-1 text-white bg-green-700 rounded">New</a>
                </div>
            @endauth
            </div>
            <div class="gap-4 m-2 md:grid md:grid-cols-12 lg:grid-cols-12">
                <div class="col-span-2">
                <select wire:change="filter" wire:model="category">
                    <option value="">-</option>
                    <option value="Category 1">Category 1</option>
                    <option value="Category 2">Category 2</option>
                    <option value="Category 3">Category 3</option>
                </select>
                </div>
                <div class="col-span-3">
                    <x-jet-input class="w-full" type="text" wire:keyup.enter="filter"
                                       wire:model="search" placeholder="Search" />
                </div>
            </div>

            <div class="gap-4 m-2 md:grid md:grid-cols-1 lg:grid-cols-1">
                @foreach ($posts as $post)
                    @livewire('post-item', ['post' => $post], key($post->id))
                @endforeach
            </div>
        </div>
    </div>
</div>
