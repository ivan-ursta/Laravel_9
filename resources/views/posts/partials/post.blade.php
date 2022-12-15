
<h3>
    @if($post->trashed())
        <del>
    @endif

    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
        href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>

        @if($post->trashed())
            </del>
        @endif
</h3>

<p class="text-muted">
    Added {{ $post->created_at->diffForHumans() }}
    by {{ $post->user->name }}
</p>

@if($post->comments_count)
    <p>{{ $post->comments_count }} comments</p>
@else
    <p>No comments yet!</p>
@endif

@auth
@can('update', $post)
<div class="mb-3">
    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
       class="btn btn-primary">
        Edit
    </a>

    @endcan
    @endauth

{{--    @cannot('delete', $post)--}}
{{--        <p>You can`t delete this post</p>--}}
{{--    @endcannot--}}

    @auth
    @if(!$post->trashed())
         @can('delete', $post)
            <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
             @csrf
              @method('DELETE')

             <input type="submit" value="Delete!" class="btn btn-primary">
         </form>
        @endcan
    @endif
    @endauth
</div>
