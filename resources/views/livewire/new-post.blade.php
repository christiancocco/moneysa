<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 mx-auto mt-3 md:p-8 md:w-full md:mt-0">
                <h1 class="mb-3 text-xl font-semibold text-gray-600">
                    {{ isset($isEdit) ? "Edit post": "New post" }}
                </h1>
                @if (session()->has('message'))
                    <div class="flex flex-row justify-between p-2 mb-4 text-green-900
                         bg-green-600 bg-opacity-25 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="save">
                    <div class="overflow-hidden bg-white rounded-md shadow">
                        <div class="px-4 py-3 space-y-8 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="title">
                                        {{ __("Post title") }}
                                    </x-jet-label>
                                    <x-jet-input class="w-full" type="text"
                                       wire:model="post.title" placeholder="Post title" />
                                    <x-jet-input-error for="post.title" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label>
                                        {{ __("Summary") }}
                                    </x-jet-label>
                                    <x-jet-input type="text" class="w-full" wire:model="post.summary"
                                       placeholder="Summary" />
                                    <x-jet-input-error for="post.summary" />
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="category"
                                        class="block text-sm font-medium text-gray-700">
                                        {{ __("Category") }}
                                    </x-jet-label>
                                    <select id="category"  class="block mt-1 w-full" name="category" wire:model="post.category">
                                        <option>-</option>
                                        <option value="Category 1">
                                            Category 1
                                        </option>
                                        <option value="Category 2">
                                            Category 2
                                        </option>
                                        <option value="Category 3">
                                            Category 3
                                        </option>

                                    </select>

                                    <x-jet-input-error for="post.category" />
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <x-jet-label for="body">
                                    {{ __("Body") }}
                                </x-jet-label>
                                <textarea id="body" rows="4" wire:model="post.body" class="border-gray-300 rounded-sm form-textarea">
                                </textarea>
                                <x-jet-input-error for="post.body" />
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <x-jet-button class="inline-flex justify-center">
                                Submit
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




