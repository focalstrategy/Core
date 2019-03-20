@if($button->isButton())
	<button {!! $button->attributes() !!}><img height="20" src="{{ $button->getImage() }}" /></button>
@else
	<a {!! $button->attributes() !!}><img height="20" src="{{ $button->getImage() }}" /></a>
@endif

