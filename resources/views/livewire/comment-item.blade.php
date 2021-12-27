<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2">
        <div class="p-3">
            <img src='{{ asset($comment->user->profile_photo_url) }}'
                alt="{{ $comment->user->name }}" class=" w-full rounded-t-md">
            </a>
        </div>
    </div>
    <div class="col-span-8">
        <div class="p-3">
            <p>
                {{ $comment->user->name }} replied {{ $created }}
            </p>
            <p class="text-gray-800">
                    {{ $comment->body }}
            </p>

            <div class="flex flex-row justify-between mt-2">
                <strong>
                    @if ($comment->deleted_user_id && $comment->deleted_user_id === $comment->user_id)
                        DELETED
                    @elseif ($comment->deleted_user_id && $comment->deleted_user_id != $comment->user_id)
                        DELETED BY ADMINISTRATOR<br>
                        <i>{{ $comment->deleted_reason }}</i>
                    @endif
                </strong>
            </div>
        </div>
    </div>
    @if (!$comment->deleted_user_id)
    <div class="col-span-1">

        @can ('update', $comment)
        <a href="{{ route('post-detail', $comment->post_id) }}?comment_id={{ $comment->id }}"
            class="bg-blue-600 px-2 py-1.5 text-xs rounded text-white">Edit</a>
        @endcan


    </div>
    <div class="col-span-1">
        @can('delete', $comment)
            <button class="p-1 text-xs text-gray-100 bg-red-600 rounded-sm"
            wire:click="delete({{ $comment->id }})">
                Delete
            </button>
        @endcan
    </div>
    @endif
</div>

<div>
    <article class="flex flex-col mb-2 rounded-md shadow-md md:mb-0">



    </article>
</div>
