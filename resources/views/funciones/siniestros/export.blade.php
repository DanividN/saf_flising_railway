    <table>
        <thead>

            <tr>
                <td colspan="7" style="font-weight: bold;font-size:18px;" align="center">
                    Información de Siniestros
                </td>
            </tr>
            <tr>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">ID de la unidad</td>
                <td colspan="2" align="center">{{ $unidades->vehiculo_id }}</td>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">Telefono</td>
                <td colspan="2" align="center">{{ $unidades->datosAsignacion->Cliente->telefono_cliente ?? 'Sin asignación' }}</td>
            </tr>
            <tr>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">Cliente</td>
                <td colspan="2" align="center">{{ $unidades->datosAsignacion->Cliente->nombre_cliente ?? 'Sin asignación' }}</td>
                <td bgcolor="#BE5014" style="color:white;font-weight: bold;" colspan="2" align="center">Responsable del activo</td>
                <td colspan="2" align="center">{{ $unidades->datosAsignacion->Cliente->responsable->nombre_responsable  ?? 'Sin asignación'}}</td>
            </tr>
            <tr>
                <th colspan="7"></th>
            </tr>
            <tr>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Folio</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Vehiculo</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Placas</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Cliente</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Aseguradora</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Tipo de póliza</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Siniestro</th>
                <th bgcolor="#BE5014" style="color:white;font-weight: bold;" align="center">Monto deducible</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siniestros as $siniestro)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $siniestro->unidad->tipo_unidad->descripcion }}</td>
                    <td align="center">{{ $siniestro->unidad->UltimoArrendamiento->placas ?? 'Sin asignación' }}</td>
                    <td align="center">{{ $siniestro->unidad->UltimoArrendamiento->Cliente->nombre_cliente ?? 'Sin asignación' }}</td>
                    <td align="center">{{ $siniestro->unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? 'Sin asignación' }}</td>
                    <td align="center">{{ $siniestro->unidad->datosAseguradora->polizas->nombre_poliza ?? 'Sin asignación' }}</td>
                    <td align="center">{{ $siniestro->siniestros->nombre ?? 'Sin asignación'}}</td>
                    <td align="center">{{ $siniestro->unidad->datosAseguradora->monto_deducible_seguro ?? 'Sin asignación'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

