@extends('layouts.front')

@section('content')
<div class="font-36 font-weight-medium text-center">Accede a tu área personal</div>
	<div class="font-24 mb-20 text-center">Rellena los datos para acceder</div>
		<v-app id="app">
			<login-form-component id="login" auth="{{ auth()->check() }}"></login-form-component>
		</v-app>
	</div>
</div>
@endsection