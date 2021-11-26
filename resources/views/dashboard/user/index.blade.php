@extends('dashboard.master')

@section('name')
    <h2 class="font-italic">LISTADO DE USUARIOS REGISTRADOS EN LA WEB</h2>
    @auth
        {{-- INGRESO DE USUARIO POR PARTE DE LA PERSONA LOGEADA --}}
        <a class="btn btn-success btn-lg mt-3 mb-3" href="{{ route('user.create') }}">CREA UN NUEVO USUARIO</a>
    @endauth

    {{-- TABLA CON LO DATOS DE TODOS LO USUARIO REGISTRADO EN LA PAGINA --}}
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    NOMBRE
                </td>
                <td>
                    EMAIL
                </td>
                <td>
                    CREACION
                </td>
                <td>
                    ACTUALIZACION
                </td>
                @auth
                    <td>
                        ACCION
                    </td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{-- FORMATEAR LA FECHA USANDO PROPIEDADES DE CARBON --}}
                            {{ $user->created_at->format('d-m-Y') }}
                        </td>
                        <td>
                            {{ $user->updated_at->format('d-m-Y') }}
                        </td>
                        @auth
                            <td>

                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary">VER</a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">ACTUALIZAR</a>

                                {{-- Primera validacion de auto borrado del usuario logeado --}}
                                @if (auth()->user()->id != $user->id)
                                    <button type="submit" data-toggle="modal" data-target="#deleteModel"
                                        data-id="{{ $user->id }}" data-usuario="{{ $user->name }}"
                                        class="btn btn-danger">ELIMINAR</button>
                                @endif



                            </td>
                        @endauth
                    </tr>
                @endforeach

            </tbody>

        </table>
        {{-- PAGINACION SIMPLE --}}
        {{ $users->links() }}



        {{-- Formulario modal simple para borrado de registros --}}
        <div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Seguro que desea borrar el usuario?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>


                        {{-- Ejecucion del metodo destroy --}}
                        <form id="formDelete" action="{{ route('user.destroy', 0) }}"
                            data-action="{{ route('user.destroy', 0) }}" method="POST">

                            {{-- Directiva que necesaria para el borrado --}}
                            @method("DELETE")
                            @csrf
                            <button type="submit" class="btn btn-primary">Borrar</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <script>
            // Pequenio scripst con Jquery para el manejo de borrado y formulario modal

            $('#deleteModel').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var usuario = button.data('usuario')
                action = $('#formDelete').attr('data-action').slice(0, -1)
                action += id
                $('#formDelete').attr('action', action)

                console.log(action);
                var modal = $(this)
                modal.find('.modal-title').text('Vas a borrar el usuario: ' + usuario)
            })
        </script>

    @endsection
