{{ Form::open(['url' => $button->getRoute(),'style' => 'display:inline-block;']) }}
@foreach($button->data() as $key => $value)
	{{ Form::hidden($key, $value) }}
@endforeach
<button type="submit" {!! $button->attributes() !!}>{{ $button->getText() }}</button>
{{ Form::close() }}
