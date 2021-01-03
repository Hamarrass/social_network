<div>
    <label for="">Your title</label>
    <input  name="title" id="title" type="text" value="{{old('title',$post->title ?? "")}}">
</div>

<div>
    <label for="content">Your content</label>
    <input name="content" id="content" type="text" value="{{old('content',$post->content ??  "")}}">
</div>
    @if($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
