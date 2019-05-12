@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="page-header mb-2">
		<div class="row">
			<div class="col-sm-12 col-md-8">
			<h1>{{ $page_title ?? 'No Title' }}
				@if (!empty($page_sub_title))
				<small>{{ $page_sub_title }}</small>
				@endif
			</h1>
			</div>
			<div class="col-sm-12 col-md-4">
				@if(isset($header_renderables) && count($header_renderables) > 0)
				<div class="pull-right">
					@foreach($header_renderables as $hr)
					{!! $hr->render() !!}
					@endforeach
				</div>
				@endif
			</div>
		</div>
	</div>
	@if(Config::get('app.debug'))
		@if(isset($dev_errors) && count($dev_errors) > 0)
			@foreach($dev_errors as $error)
				<div class="alert alert-danger">
					<strong>Developer Notice</strong>
					{{ $error }}
				</div>
			@endforeach
		@endif
	@endif

	@section('page_content')
		@if(isset($data_dump))
			<div class="card bg-light">
     			<div class="card-body">
					<pre>{{ json_encode($data_dump,JSON_PRETTY_PRINT | JSON_HEX_TAG) }}</pre>
				</div>
			</div>
		@endif
	@show
</div>
@endsection