<div class="form-group @if($errors->has('title')) has-error @endif">
    <label for="title-field">Title</label>
    <input type="text" id="title-field" name="title" class="form-control" value="{{ $blog->title }}"/>
    @if($errors->has("title"))
        <span class="help-block">{{ $errors->first("title") }}</span>
    @endif
</div>
<div class="form-group @if($errors->has('mark_down')) has-error @endif">
    <label for="mark_down-field">Markdown Body</label>
    <textarea class="form-control" id="mark_down-field" rows="20" name="mark_down">{{ $blog->mark_down }}</textarea>
    @if($errors->has("mark_down"))
        <span class="help-block">{{ $errors->first("mark_down") }}</span>
    @endif
</div>

<div class="form-group">
    <label for="image">Attach Image</label>
    <input type="file" id="image" name="image">
    <p class="help-block">Upload Banner Image</p>
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
    <button type="submit" class="btn btn-primary">Create</button>
    <a class="btn btn-link pull-right" href="{{ route('blogs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
</div>