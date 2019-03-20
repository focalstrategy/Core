<div class="btn-group">
	@if($button->isButton())
		<button {!! $button->attributes() !!}>{{ $button->getText() }}</button>
	@else
		<a {!! $button->attributes() !!}>{{ $button->getText() }}</a>
	@endif
	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul class="dropdown-menu dropdown-menu-right">
		@foreach($button->buttons as $btn)
		<li>
			{!! $btn->render() !!}
		</li>
		@endforeach
	</ul>
</div>
