{{-- Pequenio mensajito de ejecucion de acciones --}}
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif