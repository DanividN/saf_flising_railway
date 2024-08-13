<style>
    .progress-bar {
        height: 2px;
        background-color: #f0f0f0;
        position: absolute;
        left: 25px;
        right: 25px;
        top:14px;
    }

    .progress-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #fff;
        border: 2px solid #ccc;
        color: #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 10px;
    }

    .progress-label {
        color: #ccc;
        font-weight: bold;
    }

    .pasos {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        width: 100%;
    }

    .progress {
        height: 100%;
        background-color: #F26522;
        width: 0%;
        transition: width 0.3s ease;
    }

    .label {
        color: #F26522;
        font-weight: bold;
        font-size:20px;
        margin:10px;
    }

    .step {
        text-align: center;
        position: relative;

        box-sizing: border-box;
    }

    .progress-step.completed .progress-circle {
        background-color: #F26522;
        border: 2px solid #F26522;
        color: #fff;
    }

    .progress-step.completed .progress-label {
        color: #F26522;
    }

    .progress-step.procces .progress-circle {
        border: 2px solid #F26522;
        color: #F26522;
    }

    .progress-step.procces .progress-label {
        color: #F26522;
    }

    @media screen and (max-width: 767px) {

        .progress-step .progress-circle {
            width: 32px;
            height: 32px;
            background-color: #F26522;
            border: 2px solid #fff;
            color: #fff;
        }

        .progress-step.procces .progress-circle {
            width: 30px;
            height: 30px;
            background-color: #fff;
            border: 2px solid #F26522;
            color: #F26522;
        }
    }

</style>
<div class="card border-0 p-2">
    <div class='pasos'>
        <div class="progress-bar">
            <div class="d-none d-md-block progress" style="width:{{$arrendamiento->etapa * 35}}%"></div>
            <div class="d-block d-md-none progress" style="width:100%"></div>
        </div>
        <div class="step progress-step {{$arrendamiento->etapa>=1?"completed":"procces"}}">
            <div class="progress-circle">
                @if($arrendamiento->etapa>=1)
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                @else
                    <div class='d-none d-md-block'>1</div>
                @endif
            </div>
            <div class="d-none d-md-block progress-label">Asignación</div>
        </div>
        <div class="step progress-step {{$arrendamiento->etapa>=2?"completed":($arrendamiento->etapa==1?"procces":"")}}">
            <div class="progress-circle">
                @if($arrendamiento->etapa>=2)
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                @else
                    <div class='d-none d-md-block'>2</div>
                @endif
            </div>
            <div class="d-none d-md-block progress-label">Documentación</div>
        </div>
        <div class="step progress-step {{(($arrendamiento->DetallesAsignacion[0]->id_estado??null)==1&&$arrendamiento->etapa>=3)?"completed":($arrendamiento->etapa==2?"procces":"")}}">
            <div class="progress-circle">
                @if($arrendamiento->etapa>=3)
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                @else
                    <div class='d-none d-md-block'>3</div>
                @endif
            </div>
            <div class="d-none d-md-block progress-label">Garantías</div>
        </div>
        <div class="step progress-step {{$arrendamiento->etapa>=4?"completed":($arrendamiento->etapa==3?"procces":"")}}">
            <div class="progress-circle">
                @if($arrendamiento->etapa>=4)
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                @else
                    <div class='d-none d-md-block'>4</div>
                @endif
            </div>
            <div class="d-none d-md-block progress-label">Check list</div>
        </div>

    </div>
    <div class="card-body">
        <div class="row d-flex">
            <div class="col-md-4 mt-2 text-gray">
                @isset($arrendamiento->Cliente)
                <div class="col mt-2 text-gray">
                    <b>Cliente: </b><span>{{$arrendamiento->Cliente->nombre_cliente}}</span>
                </div>
                @endisset

                @isset($arrendamiento->Unidad)
                <div class="col mt-2 text-gray">
                    <b>I.D unidad: </b><span>{{$arrendamiento->Unidad->vehiculo_id}}</span>
                </div>
                @endisset

                @isset($arrendamiento->Responsable)
                <div class="col mt-2 text-gray">
                    <b>Responsable de activo: </b><span>{{$arrendamiento->Responsable->nombre_responsable}}</span>
                </div>
                @endisset

                @isset($arrendamiento->Responsable)
                <div class="col mt-2 text-gray">
                    <b>Numero de empleado: </b><span>{{$arrendamiento->Responsable->telefono_responsable}}</span>
                </div>
                @endisset
            </div>
            <div class="col-md-4 mt-2 text-gray">
                @isset($arrendamiento->Plazo)
                <div class="col mt-2 text-gray">
                    <b>Plazo de Arrendamiento: </b><span>{{$arrendamiento->Plazo->plazo}} Meses</span>
                </div>
                @endisset

                @isset($arrendamiento->fecha_inicial)
                <div class="col mt-2 text-gray">
                    <b>Fecha de inicio: </b><span>{{date_format($arrendamiento->fecha_inicial, 'd/M/Y')}}</span>
                </div>
                @endisset

                @isset($arrendamiento->fecha_final)
                <div class="col mt-2 text-gray">
                    <b>Fecha final: </b><span>{{date_format($arrendamiento->fecha_final, 'd/M/Y')}}</span>
                </div>
                @endisset

                @isset($arrendamiento->DetallesAsignacion)
                <div class="col mt-2 text-gray">
                    <b>Estatus: </b><span>{{$arrendamiento->DetallesAsignacion->map(function ($detalle) {
                                                return $detalle->estado->nombre_estado;
                                            })->join(' - ')}}</span>
                </div>
                @endisset
            </div>
            <div class="col-md-4 mt-2 text-gray">
                @isset($arrendamiento->placas)
                <div class="col mt-2 text-gray">
                    <b>Placas: </b><span>{{$arrendamiento->placas}}</span>
                </div>
                @endisset

                @isset($arrendamiento->terminacion_placas)
                <div class="col mt-2 text-gray">
                    <b>Terminación de placas: </b><span>{{$arrendamiento->terminacion_placas}}</span>
                </div>
                @endisset

                @isset($arrendamiento->primer_semestre)
                <div class="col mt-2 text-gray">
                    <b>Primer semestre: </b><span>{{ucwords(strtolower($arrendamiento->primer_semestre))}}</span>
                </div>
                @endisset

                @isset($arrendamiento->segundo_semestre)
                <div class="col mt-2 text-gray">
                    <b>Segundo Semestre: </b><span>{{ucwords(strtolower($arrendamiento->segundo_semestre))}}</span>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>
