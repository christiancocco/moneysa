<div class="mx-auto md:w-4/5 lg:w-3/5">
    @if (session()->has('message'))
                    <div class="flex flex-row justify-between p-2 mb-4 text-green-900
                         bg-green-600 bg-opacity-25 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif
    <h2 class="mt-2 text-xl font-bold lg:text-2xl">
        {{ $post->title }}
        @can ('update', $post)
        <a href="{{ route('edit-post-front', $post->id) }}"
            class="bg-blue-600 px-2 py-1.5 text-xs rounded text-white">Edit</a>
        @endcan
        @can('delete', $post)
            <button class="p-1 text-xs text-gray-100 bg-red-600 rounded-sm"
            wire:click="delete">
                Delete
            </button>
        @endcan
    </h2>
    <div class="flex flex-row my-3">
        <div class="mr-2 text-gray-700">
            {{ $post->user->name }}
        </div>

        <div class="w-2 h-2 my-auto mr-1 text-xl
                bg-gray-300 rounded-full"></div>

        <div class="my-auto mr-2 text-sm
                text-gray-500" title="Category">
            {{ ucwords($post->category) }}
        </div>

        <div class="w-2 h-2 my-auto mr-1 text-xl bg-gray-300
                rounded-full"></div>

        <div class="my-auto text-sm text-gray-500">
            {{ $post->published_date }}
        </div>
    </div>
    <div>
        {!! $post->body !!}
    </div>

    @foreach ($post->comments as $comment)
        @livewire('comment-item', ['comment' => $comment], key($comment->id))
    @endforeach

    @auth
        @if (!$comment_id)
            <livewire:new-comment :post_id="$post->id">
        @else
            <livewire:edit-comment :comment_id="$comment_id">
        @endif
    @endauth

</div>

