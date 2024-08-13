<a 
    class="btn btn-regresar {{ $class ?? '' }}"
    style="padding-left: 20px !important; padding-right: 20px !important;"
    href="{{ route($link, $params ?? []) }}"
>
    {{$text??'Regresar'}}
</a>