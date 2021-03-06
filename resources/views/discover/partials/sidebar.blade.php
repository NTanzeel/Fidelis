<div class="panel panel-default">
    <div class="panel-heading">Categories</div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            @foreach($categories as $category)
                <li role="presentation">
                    <a class="{{ $active == $category->name ? 'active' : '' }}"
                       href="{{ route('discover.category', [$category->name]) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>