var searchInput = document.getElementById('search-input-unidades');
const formulario = document.getElementById('formularioSeguimiento');
const idsDeVistas = ['pills-frontal-superior', 'pills-izquierda-superior', 'pills-trasera-superior', 'pills-derecha-superior'];
let haDibujado = false;

document.addEventListener('DOMContentLoaded', function () {
    formulario?.addEventListener('submit', function (e) {
        e.preventDefault();
        const data = new FormData(e.target);
        const dataObject = Object.fromEntries(data.entries());

        prepararDatosFormulario();
        
        let camposVacios = [];
        for (const key in dataObject) {
            if (dataObject[key] === '') camposVacios.push(key.replace(/_/g, ' '));
        }

        if (camposVacios.length > 0) {
            return Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: `Los campos ${camposVacios.join(', ')} no pueden estar vacíos.`,
            });
        }

        if(dataObject.evidecia_vista_derecha.name === '' || dataObject.evidecia_vista_frontal.name === '' || dataObject.evidecia_vista_izquierda.name === '' || dataObject.evidecia_vista_trasera.name === '') {
            return Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Debes subir las imagenes de la evidencia de la unidad.',
            });
        }

        if (!haDibujado) {
            return Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'Debes firmar electrónicamente para continuar.',
            });
        }

        formulario.submit();
    });

    vistasDeUnidad();
    buscadorDeUnidades();
    crearCanvasParaImagen(idsDeVistas[0]);
    previsualizarImagen();
    prepararDatosFormulario();
    firmaElectronica();
});

function prepararDatosFormulario() {
    const formulario = document.getElementById('formularioSeguimiento');
    const canvases = document.querySelectorAll('canvas');
    canvases.forEach((canvas) => {
        const name = canvas.id.replace(/-/g, '_');
        const imageData = canvas.toDataURL();
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = imageData;

        formulario.appendChild(input);
    });
}

function vistasDeUnidad() {
    document?.querySelectorAll('.nav-link.pill-btn').forEach(function (element) {
        element.addEventListener('click', function () {
            var target = this.getAttribute('data-bs-target');

            document.querySelectorAll('.nav-link.pill-btn, .tab-pane').forEach(function (el) {
                el.classList.remove('active', 'show');
            });

            document.querySelectorAll('[aria-selected="true"]').forEach(function (el) {
                el.setAttribute('aria-selected', 'false');
            });

            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            document.querySelector(target).classList.add('show', 'active');

            var pairTarget = target.replace('-superior', '');
            if (pairTarget === target) {
                pairTarget = target + '-superior';
                setTimeout(() => {
                    crearCanvasParaImagen(pairTarget.replace('#', ''));
                }, 100);
            }

            document.querySelectorAll(`[data-bs-target="${pairTarget}"]`).forEach(function (el) {
                el.classList.add('active');
                el.setAttribute('aria-selected', 'true');
            });

            document.querySelector(pairTarget).classList.add('show', 'active');

        });
    });
}

function buscadorDeUnidades() {
    if (searchInput) {
        var searchUrl = searchInput.getAttribute('data-search-url');
        searchInput?.addEventListener('input', function () {
            var search = this.value;
            fetch(searchUrl + '?search=' + encodeURIComponent(search))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Respuesta de red incorrecta');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('resultados-busqueda-unidades').innerHTML = html;
                })
                .catch(error => {
                    console.error('Ocurrío un error al realizar la búsqueda:', error);
                });
        });
    }
}

function previsualizarImagen() {
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const imgId = 'img-' + this.id.split('-')[1];
            const imgElement = document.getElementById(imgId);
            if (e.target.files.length) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            } else {
                imgElement.src = imgElement.getAttribute('data-default-src');
            }
        });
    });
}

function crearCanvasParaImagen(idDeVista) {
    const contenedor = document.getElementById(idDeVista);
    if (contenedor) {
        const img = contenedor.querySelector('img');
        if (img) {
            if (img.complete && img.naturalHeight !== 0) {
                agregarCanvas(img, contenedor);
            } else {
                img.onload = () => agregarCanvas(img, contenedor);
            }
        }
    }
}

function agregarCanvas(img, contenedor) {
    const canvas = document.createElement('canvas');

    if (contenedor.querySelector('canvas')) {
        return;
    }

    canvas.id = img.getAttribute('data-id');
    canvas.width = img.offsetWidth;
    canvas.height = img.offsetHeight;
    canvas.style.position = 'absolute';
    canvas.style.left = img.offsetLeft + 'px';
    canvas.style.top = img.offsetTop + 'px';

    contenedor.insertBefore(canvas, img.nextSibling); // Inserta el canvas después de la imagen

    const ctx = canvas.getContext('2d');
    ctx.drawImage(img, 0, 0, img.offsetWidth, img.offsetHeight);

    let contador = 1;

    // Agrega un botón de reseteo
    const botonReset = document.createElement('button');
    botonReset.textContent = 'Limpiar';
    botonReset.type = 'button';
    botonReset.role = 'button';
    botonReset.style.position = 'absolute';
    botonReset.classList.add('btn', 'btn-orange');
    botonReset.style.padding = '0px';
    botonReset.style.left = canvas.style.left; 
    botonReset.style.top = parseInt(canvas.style.top) - botonReset.offsetHeight - 30 + 'px';
    
    botonReset.addEventListener('click', function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpia el canvas
        ctx.drawImage(img, 0, 0, img.offsetWidth, img.offsetHeight); // Vuelve a dibujar la imagen
        contador = 1; // Reinicia el contador
    });

    contenedor.appendChild(botonReset);

    // Función para obtener coordenadas
    function getCoordinates(event) {
        const rect = canvas.getBoundingClientRect();
        return event.touches ? {
            x: event.touches[0].clientX - rect.left,
            y: event.touches[0].clientY - rect.top
        } : {
            x: event.offsetX,
            y: event.offsetY
        };
    }

    // Función para dibujar cuadro y número
    function dibujarCuadroYNumero(e) {
        e.preventDefault();
        const coords = getCoordinates(e);
        const lado = 30;

        // Dibujar fondo negro del cuadro
        ctx.fillStyle = 'black';
        ctx.fillRect(coords.x - lado / 2, coords.y - lado / 2, lado, lado);

        // Dibujar borde rojo del cuadro
        ctx.strokeStyle = 'red';
        ctx.lineWidth = 3;
        ctx.strokeRect(coords.x - lado / 2, coords.y - lado / 2, lado, lado);

        // Dibujar número en blanco
        ctx.font = '20px Arial bold';
        ctx.fillStyle = 'white';
        ctx.fillText(contador, coords.x - 5, coords.y + 5);

        contador++;
    }

    canvas.addEventListener('mousedown', dibujarCuadroYNumero);
    canvas.addEventListener('touchstart', dibujarCuadroYNumero);
}

function firmaElectronica() {
    const $canvas = document.querySelector("#canvas"),
    $btnLimpiar = document.querySelector("#btnLimpiar"),
    $btnGenerarDocumento = document.querySelector("#btnGenerarDocumento");
    const contexto = $canvas.getContext("2d");
    const COLOR_PINCEL = "black";
    const COLOR_FONDO = "white";
    const GROSOR = 3;
    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
    const obtenerXReal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
    const obtenerYReal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
    let haComenzadoDibujo = false; // Bandera que indica si el usuario está presionando el botón del mouse sin soltarlo

    const limpiarCanvas = () => {
        // Colocar color blanco en fondo de canvas
        contexto.fillStyle = COLOR_FONDO;
        contexto.fillRect(0, 0, $canvas.width, $canvas.height);
        haDibujado = false;
    };
    limpiarCanvas();
    
    $btnLimpiar.onclick = limpiarCanvas;

    window.obtenerImagen = () => {
        return $canvas.toDataURL();
    };

    const onClicOToqueIniciado = evento => {
        // En este evento solo se ha iniciado el clic, así que dibujamos un punto
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR_PINCEL;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        // Y establecemos la bandera
        haComenzadoDibujo = true;
        haDibujado = true;
    }

    const onMouseODedoMovido = evento => {
        evento.preventDefault();
        if (!haComenzadoDibujo) {
            return;
        }
        // El mouse se está moviendo y el usuario está presionando el botón, dibujamos todo
        let target = evento;
        if (evento.type.includes("touch")) {
            target = evento.touches[0];
        }
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(target.clientX);
        yActual = obtenerYReal(target.clientY);
        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR_PINCEL;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
        haDibujado = true;
    }
    const onMouseODedoLevantado = () => {
        haComenzadoDibujo = false;
    };

    // Lo demás tiene que ver con pintar sobre el canvas en los eventos del mouse
    ["mousedown", "touchstart"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onClicOToqueIniciado);
    });

    ["mousemove", "touchmove"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onMouseODedoMovido);
    });
    ["mouseup", "touchend"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onMouseODedoLevantado);
    });
}