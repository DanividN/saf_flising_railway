<style>
#messages {
    height: 260px; /* Ajusta según sea necesario */
    overflow-y: auto;
}
</style>
<section>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mt-5">
        <h6 class="mb-2">Chat de Emergencia</h6>
        <div class="row d-flex justify-content-center">
            <div class="">
                <div class="card" id="chat2">
                    <div class="card-body" data-mdb-perfect-scrollbar-init style="position: relative; height: 300px; overflow-y: auto;">
                        <div id="messages">
                            @php
                                $messages = DB::SELECT("SELECT messages.*, users.*, tipo_emergencia.descripcion as emergencia
                                            FROM messages
                                            JOIN users ON messages.user_id = users.id
                                            JOIN asignacion_emergencia on messages.id_asignacion_emergencia = asignacion_emergencia.id_asignacion_emergencia
                                            JOIN tipo_emergencia on asignacion_emergencia.id_tipo_emergencia = tipo_emergencia.id_tipo_emergencia
                                            WHERE messages.id_asignacion_emergencia = $id_asignacion_emergencia
                                            ORDER BY messages.created_at ASC");
                            @endphp
                            @foreach($messages as $message)
                                @php
                                    $isCurrentUser = $message->user_id == auth()->id();
                                    $alignmentClass = $isCurrentUser ? 'justify-content-end' : 'justify-content-start';
                                    $textAlignClass = $isCurrentUser ? 'text-end ml-4' : 'text-start mr-4

                                    ';
                                @endphp
                                <div class="d-flex {{ $alignmentClass }} mb-3">
                                    <div class="{{ $textAlignClass }}">
                                        <h6 class="title-orange mb-0">{{ $message->created_at }}</h6>
                                        <h6 class="font-bold mb-0">Emergencia - {{ $message->emergencia}}</h6>
                                        <p class="mb-0 text-gray">{{ $message->message }}</p>
                                        <p class="font-bold mb-0">{{ $message->name}}</p>
                                        <p class="mb-0 text-gray">{{ $message->tipo_usuario }}</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24H0z" fill="none"/>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                    </svg>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="form-group mt-4 font-bold">
    <label for="mensaje" class="form-label">Responder</label>
    <textarea class="form-control" rows="5" id="mensaje" placeholder="Escribe un mensaje"></textarea>
    <div class="d-flex flex-row-reverse">
        <a class="btn btn-enviar mt-2" id="sendButton"> Enviar <i class="bi bi-send"></i></a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.0.1/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Desplazar al final al cargar la página
        const messagesContainer = document.querySelector('#messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Configurar Pusher
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
            forceTLS: true
        });

        var channel = pusher.subscribe('Flising_chat');
        channel.bind('evento' + {{$id_asignacion_emergencia}}, function(data) {
            addMessage(data);
        });

        function addMessage(object) {
            const userId = {{ auth()->id() }};
            const isCurrentUser = object.user_id == userId;

            const alignmentClass = isCurrentUser ? 'justify-content-end ' : 'justify-content-start ';
            const textAlignClass = isCurrentUser ? 'text-end ml-4' : 'text-start mr-4';

            const messageHtml = `
                <div class="d-flex ${alignmentClass} mb-3">
                    <div class="${textAlignClass}">
                        <h6 class="title-orange mb-0">${object.date}</h6>
                        <h6 class="font-bold mb-0">Emergencia - ${object.emergencia}</h6>
                        <p class="mb-0 text-gray">${object.message}</p>
                        <p class="font-bold mb-0"> ${object.nombre}</p>
                        <p class="mb-0 text-gray"> ${object.tipo_usuario}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                </div>
            `;

            $('#messages').append(messageHtml);

            // Desplazar al final después de añadir un mensaje
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#sendButton').on('click', function() {
            const messageContent = $('#mensaje').val();

            $.ajax({
                url: '/emergencias/{{ $id_asignacion_emergencia }}/messages',
                type: 'POST',
                data: {
                    message: messageContent
                },
                success: function(response) {
                    $('#mensaje').val('');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
