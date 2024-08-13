@extends('layouts.app')
@section('content')
@section('configuracion','active')
    @section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('garantias.index') }}" class="rutas"><small>Garantias Flising</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información de prooverdor</small></a></span></li>
    @endsection
    @include('components.alertas')
    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Lista de Garantías</a></label>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-md-4 mt-2 text-gray">
                        <p class="text-black font-bold">Nombre: <span class="text-gray">{{ $garantia->razon_social }}</span>
                        </p>
                        <p class="text-black font-bold">Razón Social: <span
                                class="text-gray">{{ $garantia->razon_social }}</span> </p>
                        <p class="text-black font-bold">RFC: <span class="text-gray">{{ $garantia->rfc_g_flising }}</span>
                        </p>
                        <p class="text-black font-bold">Fecha de Registro:
                            <span>{{ $garantia->created_at->format('d-m-y') }}</span> </p>
                        <p class="text-black font-bold">Teléfono: <span
                                class="text-gray">{{ $garantia->telefono_g_flising }}</span> </p>
                        <p class="text-black font-bold">Municipio:
                            <span class="text-gray">
                                @foreach ($municipiosAll as $municipio)
                                    @if ($municipio->id_municipio == $garantia->id_municipio)
                                        {{ $municipio->nombre_municipio }}
                                    @endif
                                @endforeach
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-md mt-2 border-0 p-2">
            <div class="d-flex justify-content-end me-3 mt-4">
                <button type="button" class="btn btn-primary boton-principal-corto btn-flis-corto" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" onclick="resetModal()" style="width: 194px !important;"
                    id="btn-pantcomp">
                    <i class="bi bi-plus-lg"></i> <strong> Agregar Garantía</strong>
                </button>
            </div>
            <div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" class="text-start encabezado">No</th>
                                    <th scope="col" class="text-center encabezado">Garantía Extendida</th>
                                    <th scope="col" class="text-center encabezado">Vigencia</th>
                                    <th scope="col" class="text-center encabezado">Monto</th>
                                    <th scope="col" class="text-center encabezado">Evidencia</th>
                                    <th scope="col" class="text-center encabezado">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($garantias_flising_extendidas as $garantiaE)
                                    @if ($garantiaE->id_g_flising == $garantia->id_g_flising)
                                        <tr class="text-center">
                                            <td class="text-start">{{ $loop->iteration }}</td>
                                            <td>{{ $garantiaE->nombre_g_extendida }}</td>
                                            <td>{{ $garantiaE->vigencia_g_extendida }} meses</td>
                                            <td>$ {{ number_format($garantiaE->monto_g_extendida, 2, '.', ',') }}</td>
                                            <td>
                                                @if (!empty($garantiaE->a_evidencia_extendida))
                                                    <a href="{{ asset('storage/' . $garantiaE->a_evidencia_extendida) }}" target="_blank">
                                                        <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf" width="23px">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                            alt="menu" style="width: 30px !important;">
                                                    </a>
                                                    <ul class="dropdown-menu p-0">
                                                        <li>
                                                            <a class="dropdown-item" data-bs-toggle="modal" href=""
                                                                data-bs-target="#staticBackdrop"
                                                                onclick="editGarantia({{ $garantiaE }})">
                                                                Ver / Editar</a>
                                                        </li>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            @include('configuracion.garantias.garantias_seguimiento.garantias_modal')
            <script src="{{ asset('js/garantias/configuracion/garantia_extendida.js') }}"></script>
        </div>
    </div>
    <script src='{{asset('js/input-file.js')}}'></script>
    <script>
        function resetModal() {
            document.getElementById('miFormulario').reset();
            document.getElementById('staticBackdropLabel').innerText = 'Agregar Garantía extendida';
            document.getElementById('miFormulario').action = '{{ route('garantias_seguimiento.store') }}';
            document.querySelector('[name="_method"]').value = 'POST';
            document.getElementById('garantia_id').value = '';
            document.getElementById('file-link-container').innerHTML = '';
        }
    
        function editGarantia(garantia) {
            document.getElementById('staticBackdropLabel').innerText = 'Editar Garantía extendida';
            document.getElementById('miFormulario').action =
                `{{ route('garantias_seguimiento.update', ['garantias_seguimiento' => ':garantia_id']) }}`.replace(
                    ':garantia_id', garantia.id_g_flising);
            document.querySelector('[name="_method"]').value = 'PUT';
            document.getElementById('garantia_id').value = garantia.id_g_flising;
            document.getElementById('id_g_flising_extendidas').value = garantia.id_g_flising_extendidas;
            document.getElementById('nombre_g_extendida').value = garantia.nombre_g_extendida;
            document.getElementById('range4').value = garantia.vigencia_g_extendida;
            document.getElementById('eventos_por_year').value = garantia.eventos_por_year;
            document.getElementById('descripcion_g_extendida').value = garantia.descripcion_g_extendida;
            document.getElementById('activo').checked = garantia.activo;
            var monto = parseFloat(garantia.monto_g_extendida).toFixed(2);
            var montoFormateado = parseFloat(monto).toLocaleString('en-US', {
            minimumFractionDigits: 2
            });
            document.getElementById('monto_g_extendida').value = montoFormateado;
            if (garantia.a_evidencia_extendida) {
                document.querySelector('.a_evidencia_extendida').innerText = garantia.a_evidencia_extendida;
                var fileLinkContainer = document.getElementById('file-link-container');
                fileLinkContainer.innerHTML = '';
                var downloadLink = document.createElement('a');
                downloadLink.style.margin = '0';
                downloadLink.href = `{{ url('storage/') }}/${garantia.a_evidencia_extendida}`;
                downloadLink.target = '_blank';
                // downloadLink.download = garantia.a_evidencia_extendida;
                downloadLink.classList.add('input-download-link');
                downloadLink.innerHTML = '<span class="input-group-text icono-download"><i class="bi bi-download"></i></span>';
                fileLinkContainer.appendChild(downloadLink);
            } else {
                document.querySelector('.a_evidencia_extendida').innerText = '';
            }
            actualizarValorActivo();
        }
    </script>
@endsection


