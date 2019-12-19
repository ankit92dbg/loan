@if(Session::has('msg'))
<div class="flash-message animated fadeOut delay-3s">
	<p>{{ Session::get('msg') }}</p>
</div>
@endif