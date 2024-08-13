@props(['link', 'name'])

<a href="{{ route($link) }}" class="btn boton-principal boton-principal-corto me-2 rounded-lg d-flex align-items-center text-white" id="btn-pantcomp">
    <i class="fas fa-plus me-1"></i> {{ $name }}
</a>
