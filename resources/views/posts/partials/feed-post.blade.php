@php($abusive = Auth::user() && ($post->content->reports->count() || Auth::user()->settings['abuse_rating']->value < $post->content->abuse_score))
<div id="post-{{ $post->id }}" class="post" data-url="{{ route('post.view', [$post->user->username, $post->id]) }}">
    <div class="media-left">
        <a href="#">
            <img class="media-object avatar author-photo" src="{{ $post->user->photo }}"
                 alt="{{ $post->user->name }} Profile Photo">
        </a>
    </div>
    <div class="media-body">
        <div class="media-heading post-header info">
            <a class="author" href="{{ route('profile.view', [$post->user->username]) }}">
                <strong class="full-name author-name">{{ $post->user->name }}</strong>
                <span class="username author-username">&commat;{{ $post->user->username }}</span>
            </a>
            <span class="time small color light">{{ $post->created_at->diffForHumans() }}</span>
            <div class='post-category'>
                <span class="small color light category-link">
                    @if(Auth::user()->id == $post->user->id)
                        <a id="edit-{{ $post->automaticTag->count() > 0 ? $post->automaticTag{0}->id : 0 }}" class='edit-category' href='#'><i class='fa fa-pencil'></i></a>
                    @endif
                    @if($post->automaticTag->count() == 0)
                        No category
                    @else
                        <a href='{{ route('discover.category', $post->automaticTag{0}->text) }}'>{{ $post->automaticTag{0}->text }}</a>
                    @endif
                </span>
            </div>
        </div>
        <div class="post-body">
            <div id="post-{{ $post->id }}-content" class="collapse {{ $abusive ? 'margin-b-15' : 'in' }}"
                    {!! $abusive ? 'aria-expanded="false"' : 'aria-expanded="true"' !!}>
                <div class="post-images">
                    @foreach($post->images as $key => $image)
                        <img src="{{ asset('storage/' . $image->path) }}" class="lightbox img-responsive img-thumbnail"
                             data-type="post"
                             data-source="{{ $image->id }}"
                             data-album="{{ $post->id }}"
                             width="45%" />

                        @if ($key >= 3)
                            @break
                        @endif
                    @endforeach
                </div>
                <div class="post-text">
                    {!! $post->content->htmlText() !!}
                </div>
            </div>
            @if ($abusive)
                <div class="text-warning" id="post-{{ $post->id }}-content-toggle">
                    This post has been hidden as it was considered abusive for you.
                    <a class="text-danger" role="button" data-toggle="collapse" href="#post-{{ $post->id }}-content"
                       aria-expanded="false" aria-controls="post-{{ $post->id }}-content">
                        Toggle View
                    </a>
                </div>
            @endif
        </div>
        <div class="post-footer">
            @include('posts.partials.actions', ['isPost' => true, 'comment' => $post->content, 'post' => $post])
        </div>
    </div>
</div>
