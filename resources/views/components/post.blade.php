@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{  $post->user->username  }}</a>
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <div class="flex justify-between">
    <div class="flex items-center">
        <p class="mb-2">{{  Str::limit($post->body, 100) }}</p>
    </div>
    
    <div class="flex items-center">
        @can('delete', $post)
            <form action="{{  route('posts.destroy', $post)  }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blue-400"><i class="fas fa-lg fa-trash"></i></button>
            </form>
        @endcan
    </div>
    </div>
    

    <div class="flex items-center">
    @auth
        @if (!$post->likedBy(auth()->user()))
            <form action="{{  route('posts.likes', $post->id)  }}" method="post" class="mr-1">
            @csrf
                <button type="submit" class="text-blue-500"><i class="far fa-lg fa-heart"></i></i></button>
            </form>
        @else
            <form action="{{  route('posts.likes', $post)  }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
                <button type="submit" class="text-blue-500"><i class="fas fa-lg fa-heart"></i></button>
            </form>
        @endif
    @endauth
        <span>{{  $post->likes->count()  }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>