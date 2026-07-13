@extends('layouts.tocaai')

@section('title', 'Painel do Cantor - TocaAí')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-dark pb-3">
        <div>
            <h1 class="fw-black text-white uppercase italic m-0" style="font-size: 1.5rem; letter-spacing: -1px;">
                PALCO: <span class="text-coral">{{ $musician->name }}</span>
            </h1>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4 border-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">
                <i class="bi bi-box-arrow-right me-1"></i> Sair
            </button>
        </form>

        {{-- No topo, onde tem o botão de Sair, adicione o de Notificações --}}
<div class="d-flex align-items-center gap-2">
    {{-- Botão para Ativar Notificações no Celular --}}
    <button type="button" onclick="ativarNotificacoes()" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold" style="font-size: 10px; border-color: #333;">
        <i class="bi bi-bell-fill text-coral me-1"></i> ATIVAR NOTIFICAÇÕES
    </button>

    <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-dark btn-sm rounded-pill px-4 border-secondary text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">
            <i class="bi bi-box-arrow-right me-1"></i> Sair
        </button>
    </form>
</div>

    </div>

    <div class="row g-4">
        
        <div class="col-12 col-lg-4">
            <div class="card-tocaai p-4 text-center h-100 shadow-lg" style="background: #111; border: 1px solid #222; border-radius: 32px;">
                <span class="text-secondary text-uppercase fw-bold mb-3 d-block" style="font-size: 10px; letter-spacing: 2px;">Seu Link de Pedidos</span>
                
                @if(isset($musician->slug))
                    <div class="bg-white p-3 rounded-4 d-inline-block border border-5 border-coral mb-3">
                        @if(class_exists('SimpleSoftwareIO\QrCode\Facades\QrCode'))
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(160)->generate(route('musician.show', $musician->slug)) !!}
                        @else
                            <img src="https://chart.googleapis.com/chart?chs=160x160&cht=qr&chl={{ urlencode(route('musician.show', $musician->slug)) }}&choe=UTF-8" alt="QR Code">
                        @endif
                    </div>
                    
                    <div class="px-3 mb-4">
                        <a href="{{ route('musician.show', $musician->slug) }}" target="_blank" class="btn btn-coral w-100 rounded-pill fw-black uppercase italic py-2 shadow-sm" style="font-size: 12px;">
                            <i class="bi bi-eye-fill me-2"></i> Visualizar Perfil
                        </a>
                        <small class="text-secondary d-block mt-2 italic" style="font-size: 10px;">tocaai.com/{{ $musician->slug }}</small>
                    </div>
                @endif

                <hr class="border-secondary opacity-25 mb-4">

                <div class="d-grid gap-2">
                    <a href="{{ route('musician.songs.index', $musician->slug) }}" class="btn btn-outline-light rounded-pill fw-bold btn-sm opacity-75 hover-opacity-100">
                        <i class="bi bi-list-ul me-2"></i> VER REPERTÓRIO
                    </a>
                    
                    <a href="{{ route('musician.songs.import', $musician->slug) }}" class="btn btn-dark rounded-pill fw-bold btn-sm border-secondary mt-2">
                        <i class="bi bi-box-arrow-in-down me-2"></i> IMPORTAR LISTA
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card-tocaai p-4 h-100" style="background: #111; border: 1px solid #222; border-radius: 32px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-white fw-black uppercase italic m-0" style="font-size: 1.1rem;">
                        Fila de Pedidos
                        <span class="ms-2 spinner-grow spinner-grow-sm text-coral" role="status" style="width: 8px; height: 8px; animation-duration: 2s;"></span>
                    </h4>
                    <span class="badge rounded-pill bg-coral px-3">{{ $orders->where('status', 'pending')->count() }}</span>
                </div>

                <div class="overflow-auto" style="max-height: 450px;">
                    @if($orders->where('status', 'pending')->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-music-note text-secondary fs-1 opacity-25"></i>
                            <p class="text-secondary small mt-2 uppercase fw-bold tracking-widest">Silêncio no palco...</p>
                        </div>
                    @else
                    {{-- Remova isso após testar --}}

@foreach($orders->where('status', 'pending') as $order)
<div class="d-flex justify-content-between align-items-center p-3 mb-3 shadow-sm" style="background: #161616; border-radius: 16px; border-left: 4px solid #FF4757;">
    <div class="flex-grow-1">
        <h6 class="text-white fw-bold mb-0">{{ $order->client_name }}</h6>
        <small class="text-secondary italic uppercase font-bold d-block mb-1" style="font-size: 10px;">
            <i class="bi bi-music-note-beamed text-coral me-1"></i> {{ $order->song->title ?? 'Música solicitada' }}
        </small>
        
        @if(!empty($order->message))
            <div class="mt-2 p-2 rounded" style="background: rgba(255, 71, 87, 0.05); border: 1px dashed rgba(255, 71, 87, 0.3);">
                <p class="text-white m-0" style="font-size: 12px; line-height: 1.4;">
                    <i class="bi bi-chat-quote-fill text-coral me-1"></i> 
                    <span class="fw-bold text-coral uppercase" style="font-size: 9px;">Recado:</span> 
                    "{{ $order->message }}"
                </p>
            </div>
        @endif
    </div>

    <div class="text-end ms-3">
        <span class="d-block text-coral fw-bold mb-2">R$ {{ number_format($order->amount, 2, ',', '.') }}</span>
        
        <form action="{{ route('orders.complete', $order->id) }}" method="POST" id="form-order-{{ $order->id }}" class="m-0">
            @csrf
            <button type="button" 
                    onclick="agradecerETocar(
                        '{{ $order->id }}', 
                        '{{ str_replace(["\r", "\n"], ' ', addslashes($order->song->title ?? 'música')) }}', 
                        '{{ str_replace(["\r", "\n"], ' ', addslashes($order->client_name)) }}', 
                        '{{ str_replace(["\r", "\n"], ' ', addslashes($order->message ?? '')) }}'
                    )" 
                    class="btn btn-sm btn-light rounded-pill px-3 fw-black uppercase italic"
                    style="font-size: 10px;">
                Tocar
            </button>
        </form>
    </div>
</div>
@endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
/**
 * Voz AI e Controle de Fluxo
 */
function agradecerETocar(orderId, musica, cliente, mensagem) {
    console.log(orderId, musica, cliente, mensagem)
    // Cancela vozes anteriores para não encavalar
    window.speechSynthesis.cancel();

    let texto = `Obrigado pelo pedido, ${cliente}! `;
    
    // Validação de segurança para a mensagem
    if (mensagem && mensagem !== 'null' && mensagem.trim() !== "") {
        texto += `Você mandou um recado: ${mensagem}. `;
    }
    
    texto += `Vou tocar agora a música ${musica}. Toca aí!`;
    
    const msg = new SpeechSynthesisUtterance();
    msg.text = texto;
    msg.lang = 'pt-BR';
    msg.rate = 1.1; // Um pouco mais rápido para ser dinâmico

    // Callback para enviar o formulário após a voz
    msg.onend = function() {
        document.getElementById('form-order-' + orderId).submit();
    };

    // Fallback: Se a voz falhar por algum motivo, envia o form em 5s
    setTimeout(() => {
        const form = document.getElementById('form-order-' + orderId);
        if(form) form.submit();
    }, 5000);

    window.speechSynthesis.speak(msg);
}

/**
 * Auto-Refresh Inteligente (20s)
 * Não recarrega se a Voz AI estiver falando para não cortar o áudio
 */
setInterval(function() {
    if (!window.speechSynthesis.speaking) {
        window.location.reload();
    }
}, 10000);

// Registra o Service Worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js');
}

// Função essencial para converter a string Base64 da chave VAPID para Uint8Array
function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

async function ativarNotificacoes() {
    // 1. Pedir permissão
    const permission = await Notification.requestPermission();
    if (permission !== 'granted') return alert('Você precisa permitir as notificações no navegador!');

    // 2. Verificar Service Worker
    const registration = await navigator.serviceWorker.ready;
    
    // 3. Gerar assinatura (Token)
    try {
        const rawVapidKey = '{{ env("VAPID_PUBLIC_KEY") }}';
        
        // Proteção caso o .env não esteja enviando o valor correto
        if (!rawVapidKey) {
            console.error('A chave VAPID_PUBLIC_KEY está vazia ou ilegível no .env');
            return alert('Erro interno: Chave de pareamento não configurada.');
        }

        // Conversão obrigatória para o navegador aceitar
        const catConvertedKey = urlBase64ToUint8Array(rawVapidKey);

        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: catConvertedKey
        });

       // 4. Enviar para o Laravel
@if(Route::has('notifications.subscribe'))
    const response = await fetch('{{ route("notifications.subscribe") }}', {
        method: 'POST',
        body: JSON.stringify(subscription),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json', // <--- Importante para o Laravel responder em JSON
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Verifica se o servidor retornou algum erro (4xx ou 5xx)
    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.message || `Erro no servidor: ${response.status}`);
    }

    alert('🚀 Celular pareado! Você receberá avisos mesmo com a tela bloqueada.');
@else
    console.error('A rota notifications.subscribe não foi encontrada no web.php');
    alert('Erro técnico: Rota de assinatura não configurada.');
@endif
}

</script>

<style>
    body { background-color: #000 !important; color: #fff; }
    .text-coral { color: #FF4757 !important; }
    .bg-coral { background-color: #FF4757 !important; }
    .btn-coral { background-color: #FF4757 !important; color: white !important; border: none; transition: 0.3s; }
    .btn-coral:hover { background-color: #ff6b81 !important; transform: scale(1.02); }
    .card-tocaai { box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
    .fw-black { font-weight: 900; }
    .italic { font-style: italic; }
    
    /* Scrollbar Customizada Estilo Dark */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #111; }
    ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #FF4757; }
</style>
@endsection
