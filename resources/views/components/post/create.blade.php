<form class="ajax post-form" method="post" action="{{ route('api.post.store') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label class="sr-only" for="text">Email address</label>
        <textarea class="form-control" id="text" name="text" placeholder="What are you thinking?"></textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-orange">Submit</button>
    </div>
</form>