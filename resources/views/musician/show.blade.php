<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $musician->name }} // TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #000; color: #fff; font-family: 'Inter', sans-serif; }
        .text-coral { color: #FF4757; }
        .bg-coral { background-color: #FF4757; }
        .card-tocaai { background: #161616; border: 1px solid #222; border-radius: 24px; }
        .modal-open { overflow: hidden; }
    </style>
</head>
<body class="p-4 sm:p-8">
    <div class="max-w-xl mx-auto">
        
        <header class="text-center mb-10">
            <h1 class="text-5xl font-black uppercase italic tracking-tighter mb-2">
                Toca<span class="text-coral">Aí</span>
            </h1>
            <div class="inline-block px-4 py-1 rounded-full border border-gray-800 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                Ao vivo: {{ $musician->name }}
            </div>
        </header>

        <div class="mb-8">
            <div class="relative">
                <i class="bi bi-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-500"></i>
                <input type="text" id="searchInput" onkeyup="filterSongs()" placeholder="Buscar no repertório..." 
                       class="w-full bg-[#111] border-2 border-[#222] rounded-2xl pl-12 pr-6 py-4 text-white focus:border-coral outline-none transition-all text-sm">
            </div>
        </div>

        <div id="songList" class="space-y-3 mb-20">
            @foreach($musician->songs as $song)
                <div class="song-item card-tocaai p-5 flex justify-between items-center group active:scale-[0.98] transition-all">
                    <div class="flex-1 pr-4">
                        <h3 class="font-bold text-lg text-white leading-tight song-title">{{ $song->title }}</h3>
                        <p class="text-gray-500 text-xs uppercase font-bold mt-1 song-artist">
                            <i class="bi bi-mic-fill mr-1 text-coral"></i>{{ $song->artist ?? 'Autor Desconhecido' }}
                        </p>
                    </div>
                    <button onclick="openModal('{{ $song->title }}', '{{ $song->id }}')" 
                            class="bg-coral text-white font-black px-6 py-3 rounded-xl uppercase text-xs shadow-lg hover:brightness-110 transition-all">
                        Pedir
                    </button>
                </div>
            @endforeach
        </div>

        <div id="orderModal" class="hidden fixed inset-0 bg-black/90 backdrop-blur-sm flex items-center justify-center p-4 z-50">
            <div class="bg-[#111] border border-[#222] p-6 sm:p-8 rounded-[32px] w-full max-w-md relative shadow-2xl overflow-y-auto max-h-[95vh]">
                
                <div class="text-center mb-6">
                    <h2 id="modalTitle" class="text-2xl font-black uppercase italic text-white"></h2>
                    <p class="text-coral text-[10px] font-bold uppercase tracking-widest">Confirme seu pedido e contribua</p>
                </div>
                
                <form id="orderForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="musician_id" value="{{ $musician->id }}">
                    <input type="hidden" name="song_id" id="songIdInput">
                    
                    <div class="mb-6 bg-white p-3 rounded-2xl border-[6px] border-coral w-44 mx-auto text-center">
                      <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=COLOQUE_AQUI_SEU_PIX_REAL" 
     alt="QR Code Pix" class="w-full h-auto">
                    </div>

                   <div class="grid grid-cols-2 gap-3 mb-4">
    <div>
        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-2 tracking-widest">Seu Nome/Mesa</label>
        <input type="text" id="client_name_input" name="client_name" required placeholder="Ex: Mesa 4" 
               class="w-full bg-[#000] border border-[#333] rounded-xl px-4 py-3 text-white focus:border-coral outline-none text-sm">
    </div>
    <div>
        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-2 tracking-widest">Valor Doado (R$)</label>
        <input type="number" id="amount_input" name="amount" required step="0.01" min="1" placeholder="10,00" 
               class="w-full bg-[#000] border border-[#333] rounded-xl px-4 py-3 text-white focus:border-coral outline-none text-sm">
    </div>
</div>

<div class="mb-6">
    <div class="flex justify-between items-center mb-2 ml-2">
        <label class="block text-[10px] font-black uppercase text-gray-500 tracking-widest">Dedicatória / Mensagem</label>
        <span class="text-[8px] bg-[#222] text-gray-400 px-2 py-0.5 rounded-full uppercase">Opcional</span>
    </div>
    <textarea id="message_input" name="message" rows="3" 
              placeholder="Ex: Ofereço para a galera da mesa 10! Toca aí!" 
              class="w-full bg-[#000] border border-[#333] rounded-xl px-4 py-3 text-white focus:border-coral outline-none text-sm resize-none"></textarea>
    <p class="text-[9px] text-gray-600 mt-2 italic px-2">* Sua mensagem será lida pela Voz AI no palco!</p>
</div>

                    <div class="bg-[#161616] p-4 rounded-2xl border border-[#222] mb-6 text-center">
                        <span class="text-[9px] text-gray-500 font-bold uppercase block mb-1">Chave PIX do Artista</span>
                        <code class="text-coral font-mono text-xs block mb-3 truncate">{{ $musician->pix_key }}</code>
                        <button type="button" onclick="copyPix('{{ $musician->pix_key }}')" id="copyBtn" class="text-[10px] font-black uppercase text-white bg-[#333] px-4 py-2 rounded-lg hover:bg-white hover:text-black transition-all">
                            Copiar Chave
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-2 tracking-widest">Anexar Comprovante</label>
                        <input type="file" name="receipt" id="receiptInput" required onchange="validateForm()"
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-coral file:text-white cursor-pointer">
                    </div>

                    <div class="mb-6 flex items-center gap-3 bg-white/5 p-4 rounded-xl">
                        <input type="checkbox" id="confirmPayment" onchange="validateForm()" class="w-5 h-5 accent-coral">
                        <label for="confirmPayment" class="text-[10px] font-bold text-gray-400 uppercase">Já realizei o pagamento</label>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeModal()" class="flex-1 text-gray-500 font-black uppercase text-[10px] hover:text-white transition-all">Sair</button>
                        <button type="button" id="submitBtn" onclick="handleOrderSubmit()" disabled 
                                class="flex-[2] bg-gray-800 text-gray-500 font-black py-4 rounded-xl uppercase italic cursor-not-allowed transition-all shadow-lg">
                            Enviar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filterSongs() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let items = document.getElementsByClassName('song-item');
            for (let i = 0; i < items.length; i++) {
                let title = items[i].querySelector('.song-title').innerText.toLowerCase();
                let artist = items[i].querySelector('.song-artist').innerText.toLowerCase();
                items[i].style.display = (title.includes(input) || artist.includes(input)) ? "flex" : "none";
            }
        }

        function copyPix(value) {
            const btn = document.getElementById('copyBtn');
            navigator.clipboard.writeText(value).then(() => {
                btn.innerText = 'COPIADO!';
                btn.classList.add('bg-green-600');
                setTimeout(() => { btn.innerText = 'Copiar Chave'; btn.classList.remove('bg-green-600'); }, 2000);
            });
        }

        function validateForm() {
            const checkbox = document.getElementById('confirmPayment');
            const file = document.getElementById('receiptInput');
            const btn = document.getElementById('submitBtn');
            if(checkbox.checked && file.files.length > 0) {
                btn.disabled = false;
                btn.classList.remove('bg-gray-800', 'text-gray-500', 'cursor-not-allowed');
                btn.classList.add('bg-coral', 'text-white');
            } else {
                btn.disabled = true;
                btn.classList.add('bg-gray-800', 'text-gray-500', 'cursor-not-allowed');
                btn.classList.remove('bg-coral', 'text-white');
            }
        }

        function handleOrderSubmit() {
            const name = document.getElementById('client_name_input').value;
            const amount = document.getElementById('amount_input').value;
            const form = document.getElementById('orderForm');
            const formData = new FormData(form);

            // Tenta disparar a voz antes do fetch
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const utterance = new SpeechSynthesisUtterance(`Novo pedido de ${name}. Valor: ${amount} reais.`);
                utterance.lang = 'pt-BR';
                window.speechSynthesis.speak(utterance);
            }

            fetch("{{ route('order.store') }}", {
                method: "POST",
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(() => {
                alert('Pedido enviado com sucesso!');
                closeModal();
                form.reset();
                validateForm();
            });
        }

        function openModal(title, id) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('songIdInput').value = id;
            document.getElementById('orderModal').classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal() {
            document.getElementById('orderModal').classList.add('hidden');
            document.body.classList.remove('modal-open');
            document.getElementById('orderForm').reset();
            validateForm();
        }
    </script>
</body>
</html>
