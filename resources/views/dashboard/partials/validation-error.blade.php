
{{-- Obtienen lo errores en caso de la validacion que no se cumpla y alerta --}}
@if ($errors->any())
@foreach ($errors->all(); as $error)
<div class="alert alert-danger" role="alert">
   {{$error}}
  </div>   
@endforeach
@endif
