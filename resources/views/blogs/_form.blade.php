<div class="form-group @if($errors->has('title')) has-error @endif">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}"/>
    @if($errors->has("title"))
        <span class="help-block">{{ $errors->first("title") }}</span>
    @endif
</div>

<div class="form-group @if($errors->has('intro')) has-error @endif">
    <label for="intro">Intro Plain Text</label>
    <textarea class="form-control" id="intro" rows="3" name="intro">{{ $blog->intro }}</textarea>
    @if($errors->has("intro"))
        <span class="help-block">{{ $errors->first("intro") }}</span>
    @endif
</div>

<div class="form-group @if($errors->has('mark_down')) has-error @endif">
    <label for="mark_down">Markdown Body</label>
    <textarea class="form-control" id="mark_down" rows="20" name="mark_down">{{ $blog->mark_down }}</textarea>
    @if($errors->has("mark_down"))
        <span class="help-block">{{ $errors->first("mark_down") }}</span>
    @endif
</div>

<div class="form-group">
    <label for="image">Attach Image</label>
    <input type="file" id="image" name="image">
    <p class="help-block">
        Upload Banner Image
        @if($blog->image)
                <img src="{{ asset('/blog') }}/{{$blog->image}}" class="post-img img-responsive" alt="" style="max-width: 50%">
        @endif
    </p>
</div>

<div class="form-group">
    <label for="active">Active</label>
    @if($blog->active == 1)
        <input type="checkbox" name="active" checked="checked" value="on">
    @else
        <input type="checkbox" name="active" value="on">
    @endif
</div>

<div class="well well-sm">
    <button type="submit" class="btn btn-primary" name="submit" id="submit">Save</button>
    <a class="btn btn-link pull-right" href="{{ route('blogs.index') }}"><i class="fa fa-backward"></i> Back</a>
</div>