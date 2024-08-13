@if (session('success'))
    <script>
        Swal.fire(
            '¡Muy bien!',
            '{{ session('success') }}',
            'success'
        )
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        })
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire(
            '¡Atención!',
            '{{ session('warning') }}',
            'warning'
        )
    </script>
@endif