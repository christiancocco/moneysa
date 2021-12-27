<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 mx-auto mt-3 md:p-8 md:w-full md:mt-0">
                <h1 class="mb-3 text-xl font-semibold text-gray-600">
                    Add reason
                </h1>
                <form wire:submit.prevent="save">

                    <div class="overflow-hidden bg-white rounded-md shadow">
                        <div class="px-4 py-3 space-y-8 sm:p-6">
                            <div class="flex flex-col">
                                <x-jet-label for="body">
                                    {{ __("Body") }}
                                </x-jet-label>
                                <textarea id="body" rows="4" wire:model="post.deleted_reason" class="border-gray-300 rounded-sm form-textarea">
                                </textarea>
                                <x-jet-input-error for="post.deleted_reason" />
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                            <x-jet-button class="inline-flex justify-center">
                                Update
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




