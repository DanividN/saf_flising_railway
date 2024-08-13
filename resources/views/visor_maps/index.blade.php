@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap" type="text/javascript"></script>
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 col-sm-12 map-control" id="style-selector-control">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <b>Capa de Simbolog&iacute;a B&aacute;sica</b>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>L&iacute;mite de CDMX</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_cdmx">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>L&iacute;mite de Edo.Mex</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_edomex">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>L&iacute;mite de alcald&iacute;as CDMX</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_alcaldias">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>L&iacute;mite de municipios Edo.Mex</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_municipios">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>Patios</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_patios">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault"><b>Regiones de Edo.Mex</b></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_regiones">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <b>Talleres | Agencias | Verificentros</b>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                                    <b>
                                                        <img src="{{url('/img/iconos_visor/visor_talleres.png')}}" alt="iconTalleres" class="iconTalleres">
                                                        Talleres
                                                    </b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_talleres">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                                    <b>
                                                        <img src="{{url('/img/iconos_visor/visor_agencias.png')}}" alt="iconTalleres" class="iconTalleres">
                                                        Agenc&iacute;as
                                                    </b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_agencias">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-2">
                                            <div class="mt-2">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">
                                                    <b>
                                                        <img src="{{url('/img/iconos_visor/visor_verificentro.png')}}" alt="iconTalleres" class="iconTalleres">
                                                        Verificentros
                                                    </b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check form-switch">
                                                <label class="switch">
                                                    <input type="checkbox" id="switch_verificentros">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <b>Clientes</b>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="height:230px;overflow: auto !important;">
                                <div class="search_div">
                                    <div class="search_div">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                                            <input type="text" id="find" class="form-control" autocomplete="off" placeholder="Buscar" onkeyup="search()">
                                        </div>
                                        <div class="dependencia-list">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($clientes as $cliente)
                                                    <div class="dependencia list-group-item">
                                                        <li class="d-flex justify-content-between align-items-center">
                                                            <h3 class="h3_search">
                                                                <b>
                                                                    <img src="{{url('/img/iconos_visor/visor_clientes.png')}}" alt="iconTalleres" class="iconTalleres"> 
                                                                    {{ $cliente->nombre_cliente }}
                                                                </b>
                                                            </h3>
                                                            <span>
                                                                <label class="switch">
                                                                    <input type="checkbox" class="shape_cliente" value="{{ $cliente->id_cliente }}" id="switch_clientes{{ $cliente->id_cliente }}">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </span>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" style="width: 100%; height:850px;"></div>
    </div>
    <script>
        console.warn = () => {};
        //Buscador
        function search() {
            let filter = document.getElementById('find').value.toUpperCase();
            let item = document.querySelectorAll('.dependencia');
            let l = document.getElementsByTagName('h3');
            for(var i = 0;i<=l.length;i++){
                let a=item[i].getElementsByTagName('h3')[0];
                let value=a.innerHTML || a.innerText || a.textContent;
                if(value.toUpperCase().indexOf(filter) > -1) {
                    item[i].style.display="";
                }else{
                    item[i].style.display="none";
                }
            }
        }
        //Google Maps
        function initMap(){
            var latitud = 19.360231;
            var longitud = -99.447956; 
            coords = {
                lng: longitud,
                lat: latitud
            }

            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11,
                scrollwheel: true,
                scaleControl: true,
                mapTypeControl: false,
                maypTypeId: 'satellite',
                center: new google.maps.LatLng(coords.lat, coords.lng),
            });

            // Add a style-selector control to the map.
            const styleControl = document.getElementById("style-selector-control");
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);
            //Capas - CDMX
            const cdmx = new google.maps.KmlLayer({
                url: "https://desarrollo.sistemas-gob-ti.com/saf/public/kml/limite_cdmx.kml",
                map: null,
            }); 
            //Capas - EDOMEX
            const edomex = new google.maps.KmlLayer({
                url: "https://desarrollo.sistemas-gob-ti.com/saf/public/kml/limite_edomex.kml",
                map: null,
            });
            //Capas - Alcaldias
            const alcaldias = new google.maps.KmlLayer({
                url: "https://desarrollo.sistemas-gob-ti.com/saf/public/kml/limite_alcaldias.kml",
                map: null,
            });
            //Capas - Municipios
            const municipios = new google.maps.KmlLayer({
                url: "http://187.217.138.216/base_plata/public/kml/edomexx.kmz",
                map: null,
            });
            //Capas - Regiones
            const regiones = new google.maps.KmlLayer({
                url: "https://desarrollo.sistemas-gob-ti.com/saf/public/kml/regiones_edomex.kml",
                map: null,
            });
            //Switch de CDMX
            $('#switch_cdmx').change(function(){
                if($(this).is(':checked')){
                    cdmx.setMap(map);
                    $(".accordion-collapse").collapse('hide');
                }else{                   
                    cdmx.setMap(null);
                }
            });
            //Switch de EDOMEX
            $('#switch_edomex').change(function(){
                if($(this).is(':checked')){
                    edomex.setMap(map); 
                    $(".accordion-collapse").collapse('hide');                              
                }else{                   
                    edomex.setMap(null);
                }
            });
            //Switch de ALCALDÍAS
            $('#switch_alcaldias').change(function(){
                if($(this).is(':checked')){
                    alcaldias.setMap(map);
                    $(".accordion-collapse").collapse('hide');                               
                }else{                   
                    alcaldias.setMap(null);
                }
            });
            //Switch de MUNICIPIOS
            $('#switch_municipios').change(function(){
                if($(this).is(':checked')){
                    municipios.setMap(map);  
                    $(".accordion-collapse").collapse('hide');                             
                }else{                   
                    municipios.setMap(null);
                }
            });
            //Switch de REGIONES
            $('#switch_regiones').change(function(){
                if($(this).is(':checked')){
                    regiones.setMap(map);  
                    $(".accordion-collapse").collapse('hide');                             
                }else{                   
                    regiones.setMap(null);
                }
            });
            //Talleres, Agencias y Verificentros 
            //Switch de AGENCIAS
            const iconAgencias = "{{url('/img/iconos_visor/visor_agencias.png')}}";
            $('#switch_agencias').change(function(){
                if($(this).is(':checked')){
                    $(".accordion-collapse").collapse('hide');
                    $.ajax({
                        type: 'get',
                        url: "{{ url('visor/getAgencias') }}",
                        data: {
                            
                        },
                        success: function(data){
                            const iconA = {
                                url: iconAgencias, // url
                                scaledSize: new google.maps.Size(22, 30), // scaled size
                            }
                            const features = [];                            
                            agencias = []; 
                            for (var i = 0; i < data.length; i++) {
                                features.push({
                                    position: new google.maps.LatLng(data[i].cx, data[i].cy),
                                    type: data[i].id_proveedor
                                }) ; 
                            } 
                            //Añadir marcadores
                            for (let i = 0; i < features.length; i++) {                                    
                                const base_agencias = new google.maps.Marker ({
                                    map: map,
                                    animation: google.maps.Animation.DROP,
                                    icon: iconA,
                                    position: features[i].position,
                                    title: data[i].nombre_comercial,
                                });   
                                const contentString =
                                        '<div id="content" style="font-weight:bolder;">' +
                                            '<h5 id="firstHeading" class="firstHeading" style="font-style: italic;">'+data[i].nombre_comercial+'</h5>' +
                                            '<div id="bodyContent" class="mt-2" style="font-style: italic;">' +
                                                "<i class='bi bi-geo-alt-fill icons_map'></i> &nbsp;"+data[i].direccion_proveedor+"<br/>" +
                                                "<i class='bi bi-car-front icons_map'></i> &nbsp;"+data[i].servicios+"<br/>" +
                                                "<i class='bi bi-telephone icons_map'></i> &nbsp;"+data[i].telefono_proveedor+"<br/>" +
                                                "<i class='bi bi-envelope-at icons_map'></i> &nbsp;"+data[i].correo_proveedor+"<br/>" +
                                            "</div>" +
                                        "</div>";
                                    const infowindow = new google.maps.InfoWindow({
                                        content: contentString,
                                        maxWidth: 500,
                                        
                                    });                  
                                    base_agencias.addListener("click", () => {
                                        infowindow.open({
                                            anchor: base_agencias,
                                            map,
                                        });
                                    });                                      
                                agencias.push(base_agencias);                                                                                                                      
                            }
                        }
                    })
                }else{    
                    for (let i = 0; i < agencias.length; i++) {
                        agencias[i].setMap(null);
                    }
                    agencias = [];
                }
            });
            //Switch de TALLERES
            const iconTalleres = "{{url('/img/iconos_visor/visor_talleres.png')}}";
            $('#switch_talleres').change(function(){
                if($(this).is(':checked')){
                    $(".accordion-collapse").collapse('hide');
                    $.ajax({
                        type: 'get',
                        url: "{{ url('visor/getTalleres') }}",
                        data: {
                            
                        },
                        success: function(data){
                            const features = [];                            
                            talleres = []; 
                            for (var i = 0; i < data.length; i++) {
                                features.push({
                                    position: new google.maps.LatLng(data[i].cx, data[i].cy),
                                    type: data[i].id_proveedor
                                }) ; 
                            } 
                            const iconT = {
                                url: iconTalleres, // url
                                scaledSize: new google.maps.Size(22, 30), // scaled size
                            }
                            //Añadir marcadores
                            for (let i = 0; i < features.length; i++) {                                    
                                const base_talleres = new google.maps.Marker ({
                                    map: map,
                                    animation: google.maps.Animation.DROP,
                                    icon: iconT,
                                    position: features[i].position,
                                    title: data[i].nombre_comercial,
                                });   
                                const contentString =
                                        '<div id="content" style="font-weight:bolder;">' +
                                            '<h4 id="firstHeading" class="firstHeading" style="font-style: italic;">'+data[i].nombre_comercial+'</h4>' +
                                            '<div id="bodyContent" class="mt-2" style="font-style: italic;">' +
                                                "<i class='bi bi-geo-alt-fill icons_map'></i> &nbsp;"+data[i].direccion_proveedor+"<br/>" +
                                                "<i class='bi bi-car-front icons_map'></i> &nbsp;"+data[i].servicios+"<br/>" +
                                                "<i class='bi bi-telephone icons_map'></i> &nbsp;"+data[i].telefono_proveedor+"<br/>" +
                                                "<i class='bi bi-envelope-at icons_map'></i> &nbsp;"+data[i].correo_proveedor+"<br/>" +
                                            "</div>" +
                                        "</div>";
                                    const infowindow = new google.maps.InfoWindow({
                                        content: contentString,
                                        maxWidth: 400,
                                    });                  
                                    base_talleres.addListener("click", () => {
                                        infowindow.open({
                                            anchor: base_talleres,
                                            map,
                                        });
                                    });                                      
                                    talleres.push(base_talleres);                                                                                                                      
                            }
                        }
                    })
                }else{   
                    for (let i = 0; i < talleres.length; i++) {
                        talleres[i].setMap(null);
                    }
                    talleres = [];
                }
            });
            //Switch de VERIFICENTROS
            const iconVerificentros = "{{url('/img/iconos_visor/visor_verificentro.png')}}";
            $('#switch_verificentros').change(function(){
                if($(this).is(':checked')){
                    $(".accordion-collapse").collapse('hide');
                    $.ajax({
                        type: 'get',
                        url: "{{ url('visor/getVerificentros') }}",
                        data: {
                            
                        },
                        success: function(data){
                            const features = [];                            
                            verificentros = []; 
                            for (var i = 0; i < data.length; i++) {
                                features.push({
                                    position: new google.maps.LatLng(data[i].latitud, data[i].longitud),
                                    type: data[i].id_verificentro
                                }) ;  
                            } 
                            const iconV = {
                                url: iconVerificentros, // url
                                scaledSize: new google.maps.Size(22, 30), // scaled size
                            }
                            //Añadir marcadores
                            for (let i = 0; i < features.length; i++) {                                    
                                const base_verificentros = new google.maps.Marker ({
                                    map: map,
                                    animation: google.maps.Animation.DROP,
                                    icon: iconV,
                                    position: features[i].position,
                                    title: "Verificentro " + data[i].no_verificentro,
                                });   
                                const contentString =
                                        '<div id="content" style="font-weight:bolder;">' +
                                            '<h4 id="firstHeading" class="firstHeading" style="font-style: italic;">'+"Verificentro "+data[i].no_verificentro+'</h4>' +
                                            '<div id="bodyContent" class="mt-2" style="font-style: italic;">' +
                                                "<i class='bi bi-geo-alt-fill icons_map'></i> &nbsp;"+data[i].direccion+"<br/>" +
                                                "<i class='bi bi-building-exclamation icons_map'></i> &nbsp;"+data[i].razon_social+"<br/>" +
                                                "<i class='bi bi-telephone icons_map'></i> &nbsp;"+data[i].telefono+"<br/>" +
                                            "</div>" +
                                        "</div>";
                                    const infowindow = new google.maps.InfoWindow({
                                        content: contentString,
                                        maxWidth: 400,
                                    });                  
                                    base_verificentros.addListener("click", () => {
                                        infowindow.open({
                                            anchor: base_verificentros,
                                            map,
                                        });
                                    });                                      
                                    verificentros.push(base_verificentros);                                                                                                                      
                            }
                        }
                    })
                }else{   
                    for (let i = 0; i < verificentros.length; i++) {
                        verificentros[i].setMap(null);
                    }
                    verificentros = [];
                }
            });
            //Switch de CLIENTES
            var clientes = @json($clientes);
            const iconClientes = "{{url('/img/iconos_visor/visor_clientes.png')}}";
            for(var i = 0;i < clientes.length; i++){
                $('#switch_clientes' + clientes[i].id_cliente ).change(function(){
                    if($(this).is(':checked')){
                        $(".accordion-collapse").collapse('hide');
                        var cliente_id = $(this).val();
                        $.ajax({
                            type: "GET",
                            url: "{{ url('visor/getClientes') }}",
                            data:{
                                id_cliente: cliente_id
                            },
                            success: function(data){
                                const features_clientes = [];
                                cliente = []; 
                                for (var i = 0; i < data.length; i++) {
                                    features_clientes.push({
                                        position: new google.maps.LatLng(data[i].cx, data[i].cy),
                                        type: data[i].id_cliente
                                    }) ;  
                                }
                                const iconV = {
                                    url: iconClientes, // url
                                    scaledSize: new google.maps.Size(22, 30), // scaled size
                                }
                                //Añadir marcador cliente
                                for (let i = 0; i < features_clientes.length; i++) {                                    
                                    const base_cliente = new google.maps.Marker ({
                                        map: map,
                                        animation: google.maps.Animation.DROP,
                                        icon: iconV,
                                        position: features_clientes[i].position,
                                        title: "Cliente " + data[i].nombre_cliente,
                                    });  
                                    const contentString =
                                            '<div id="content" style="font-weight:bolder;">' +
                                                '<h4 id="firstHeading" class="firstHeading" style="font-style: italic;">'+data[i].nombre_cliente+'</h4>' +
                                                '<div id="bodyContent" class="mt-2" style="font-style: italic;">' +
                                                    "<i class='bi bi-geo-alt-fill icons_map'></i> &nbsp;"+data[i].direccion_cliente+"<br/>" +
                                                    "<i class='bi bi-person icons_map'></i> &nbsp;"+data[i].nombre_representante+"<br/>" +
                                                    "<i class='bi bi-envelope-at icons_map'></i> &nbsp;"+data[i].correo_representante+"<br/>" +
                                                    "<i class='bi bi-telephone icons_map'></i> &nbsp;"+data[i].telefono_cliente+"<br/>" +
                                                "</div>" +
                                            "</div>";
                                        const infowindow = new google.maps.InfoWindow({
                                            content: contentString,
                                            maxWidth: 400,
                                        });                  
                                        base_cliente.addListener("click", () => {
                                            infowindow.open({
                                                anchor: base_cliente,
                                                map,
                                            });
                                        });                                    
                                    cliente.push(base_cliente);                                                                                                                      
                                }
                            }
                        })
                    }else{  
                        for (let i = 0; i < cliente.length; i++) {
                            cliente[i].setMap(null);
                        }
                        cliente = [];
                    }
                });
            }
            //Bloquear switch CLIENTES
            document.querySelectorAll('.shape_cliente').forEach(element => element.addEventListener('click',disableCliente));
            function disableCliente(eventCliente){
                if(eventCliente.target.checked){
                    document.querySelectorAll('.shape_cliente').forEach(element => element.disabled = true)
                    eventCliente.target.disabled = false;
                }else{
                    document.querySelectorAll('.shape_cliente').forEach(element =>  element.disabled = false)
                }
            }
        }
    </script>
@endsection