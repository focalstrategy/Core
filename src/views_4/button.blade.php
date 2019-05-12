@if($button->isButton())
	<button {{ $button->attributes() }}>
		@if($button->getIcon() != '')
			<span class="fa fa-{{ $button->getIcon() }}"></span>
		@endif
		{{ $button->getText() }}
	</button>
@else
	<a {{ $button->attributes() }}>
		@if($button->getIcon() != '')
			<span class="fa fa-{{ $button->getIcon() }}"></span>
		@endif
		{{ $button->getText() }}
	</a>
@endif