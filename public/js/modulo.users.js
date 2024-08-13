const divPermisos = document.querySelector('#permisos');
const divClientes = document.querySelector('#listado_clientes');
const divClientesAgregados = document.querySelector('#clientes_agregados');
const botonAgregarClientes = document.querySelector('#agregar-clientes-modal');
const checkAtencionVip = document.querySelector('#atencion_vip');
const tipoUsuario = document.querySelector('#tipo_usuario');
const formulario = document.querySelector('#create-user-form');
const btnGuardarUsuario = document.querySelector('#btn-guardar-usuario');

let eventoAgregado = false; // Bandera para verificar si el evento ya fue agregado
let clientesAgregados = new Set(); // Registro de clientes ya agregados

const loadAuthFunctions = () => {
    tipoUsuarioChange();
    triggerTipoUsuarioChange();
    agregarClientes();
    submitForm();
};

const submitForm = () => {
    formulario?.addEventListener('submit', function (e) {
        e.preventDefault();
        btnGuardarUsuario.disabled = true;

        const data = new FormData(e.target);
        const dataObject = Object.fromEntries(data.entries());

        if([dataObject.email, dataObject.name, dataObject.tipo_usuario].includes('')) {
            Swal.fire({
                title: 'Error',
                text: 'Los campos marcados con * son obligatorios',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            btnGuardarUsuario.disabled = false;
            return;
        }

        if(dataObject.tipo_usuario == 'CALL_CENTER' && !dataObject.turno) {
            Swal.fire({
                title: 'Error',
                text: 'El campo Turno es obligatorio para el tipo de usuario seleccionado',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            btnGuardarUsuario.disabled = false;
            return;
        }

        formulario.submit();
    });
}

const tipoUsuarioChange = () => {
    tipoUsuario?.addEventListener('change', () => {
        handleTipoUsuarioChange();
    });
};

const handleTipoUsuarioChange = () => {
    const tipo = tipoUsuario.value;
    const contenedorTurno = document.getElementById('contenedorTurno');

    if(tipo == '') {
        divPermisos.classList.add('d-none');
        divClientes.classList.add('d-none');
        checkAtencionVip.disabled = true;
        contenedorTurno.style.display = 'none';
        return;
    }

    if(tipo == 'SUPERVISION_APP'){
        divPermisos.classList.add('d-none');
        divClientes.classList.add('d-none');
        checkAtencionVip.disabled = true;
        contenedorTurno.style.display = 'none';

        while (divPermisos.firstChild) {
            divPermisos.removeChild(divPermisos.firstChild);
        }
    } else if (tipo == 'CALL_CENTER'){
        divPermisos.classList.remove('d-none');
        divClientes.classList.remove('d-none');
        checkAtencionVip.disabled = false;
        contenedorTurno.style.display = 'block';

        cargarPermisos(tipo);
    } else {
        divPermisos.classList.remove('d-none');
        divClientes.classList.add('d-none');
        checkAtencionVip.disabled = true;
        contenedorTurno.style.display = 'none';

        cargarPermisos(tipo);
    }
};

const cargarPermisos = async (tipo) => {
    const url = `/flising_saf/public/configuracion/usuarios/obtener/permisos/${tipo}`;
    const response = await fetch(url, { headers: { 'Content-Type': 'application/json' } });
    const data = await response.json();

    generarCheckbox(data);
};

const generarCheckbox = (roles) => {
    const permisosCargadosElement = document.getElementById('permisos_cargados');
    const rolesCargadosElement = document.getElementById('roles_cargados');

    const permisos_edicion = permisosCargadosElement ? JSON.parse(permisosCargadosElement.value || '[]') : [];
    const roles_edicion = rolesCargadosElement ? JSON.parse(rolesCargadosElement.value || '[]') : [];

    while (divPermisos.firstChild) {
        divPermisos.removeChild(divPermisos.firstChild);
    }

    roles.map((rol, indexRol) => {
        const divRol = document.createElement('div');
        divRol.classList.add('card', 'p-0', 'mt-2', 'mb-2');

        const divCardBodyRol = document.createElement('div');
        divCardBodyRol.classList.add('card-body', 'p-3', 'pt-0', 'pb-0', 'd-flex', 'justify-content-between');

        const h6Rol = document.createElement('h6');
        h6Rol.classList.add('font-bold', 'p-1', 'm-0');
        h6Rol.textContent = `${rol.name}`;
        h6Rol.textContent = `${rol.name.charAt(0).toUpperCase()}${rol.name.slice(1)}`;

        const inputCheckbox = document.createElement('input');
        inputCheckbox.setAttribute('type', 'checkbox');
        inputCheckbox.classList.add('form-check-input');
        inputCheckbox.setAttribute('value', rol.name);
        inputCheckbox.setAttribute('name', 'roles[]');
        inputCheckbox.setAttribute('id', `rol-checkbox-${indexRol}`);
        inputCheckbox.setAttribute('style', 'border: 1px solid #bdbfc2;');
        inputCheckbox.checked = roles_edicion.includes(rol.name);

        divCardBodyRol.appendChild(h6Rol);
        divCardBodyRol.appendChild(inputCheckbox);

        divRol.appendChild(divCardBodyRol);

        //------------------------- Sección de permisos -------------------------
        const divPermisosContenedor = document.createElement('div');
        const divPermisosBody = document.createElement('div');

        if(rol.permissions.length > 0)  {
            divPermisosContenedor.classList.add('card', 'p-0', 'mt-1');
            divPermisosContenedor.setAttribute('style', 'margin-left: 20px;');

            divPermisosBody.classList.add('card-body', 'p-0');            

            rol.permissions.map((permiso) => {
                const divPermisoDetalle = document.createElement('div');
                divPermisoDetalle.classList.add('form-check', 'form-check-inline', 'd-flex', 'justify-content-between');
                
                const labelPermiso = document.createElement('label');
                labelPermiso.classList.add('form-check-label');
                labelPermiso.textContent = `${permiso.name.charAt(0).toUpperCase()}${permiso.name.slice(1)}`;
                
                const inputPermiso = document.createElement('input');
                inputPermiso.setAttribute('type', 'checkbox');
                inputPermiso.classList.add('form-check-input');
                inputPermiso.setAttribute('value', permiso.name);
                inputPermiso.setAttribute('name', 'permisos[]');
                inputPermiso.setAttribute('style', 'border: 1px solid #bdbfc2;');
                inputPermiso.setAttribute('data-rol-checkbox-id', `rol-checkbox-${indexRol}`);
                inputPermiso.checked = permisos_edicion.includes(permiso.name);

                inputPermiso.addEventListener('change', function() {
                    const rolCheckboxId = this.getAttribute('data-rol-checkbox-id');
                    const rolCheckbox = document.getElementById(rolCheckboxId);
                    if (rolCheckbox && !rolCheckbox.checked) {
                        rolCheckbox.checked = true;
                    }
                });

                divPermisoDetalle.appendChild(labelPermiso);
                divPermisoDetalle.appendChild(inputPermiso);

                divPermisosBody.appendChild(divPermisoDetalle);
            });

            divPermisosContenedor.appendChild(divPermisosBody);
        }

        divPermisos.appendChild(divRol);
        divPermisos.appendChild(divPermisosContenedor);
    });
}

const triggerTipoUsuarioChange = () => {
    handleTipoUsuarioChange();
    agregarClientes();
};

const agregarClientes = () => {
    if (!eventoAgregado) {
        botonAgregarClientes?.addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][data-id="id_clientes"]:checked');
            checkboxes.forEach(checkbox => {
                const clienteId = checkbox.value; // obtener el id desde el valor del checkbox

                if (!clientesAgregados.has(clienteId)) { //Verificar si el cliente ya fue agregado
                    const botonCliente = document.createElement('button');
                    botonCliente.type = 'button';
                    botonCliente.classList.add('btn-border-red', 'd-flex', 'justify-content-between');
                    botonCliente.innerHTML = `${checkbox.dataset.name} <span class="btn-eliminar">X</span>`;

                    const inputOculto = document.createElement('input');
                    inputOculto.type = 'hidden';
                    inputOculto.name = 'clientes_asignado[]';
                    inputOculto.value = clienteId;

                    botonCliente.appendChild(inputOculto);

                    botonCliente.querySelector('.btn-eliminar').addEventListener('click', function() {
                        const clienteId = this.parentNode.querySelector('input[type="hidden"]').value;

                        const checkbox = document.querySelector(`#id_clientes_${clienteId}`);
                        if (checkbox) {
                            checkbox.checked = false;
                        }

                        this.parentNode.remove();
                        clientesAgregados.delete(clienteId); // Elimina el cliente del set
                    });

                    document.querySelector('.clientes_agregados').appendChild(botonCliente);
                    clientesAgregados.add(clienteId); //Actualizar el registro de clientes agregados
                }
            });
        });
        eventoAgregado = true; // ActualizaR la bandera para veerificar que el evento ya fue agregado

        botonAgregarClientes.click();
    }
};

document.addEventListener('DOMContentLoaded', loadAuthFunctions);