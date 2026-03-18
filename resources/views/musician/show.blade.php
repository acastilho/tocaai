<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $musician->name }} // TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal-open { overflow: hidden; }
    </style>
</head>
<body class="bg-black text-white p-4 sm:p-8">
    <div class="max-w-xl mx-auto">
        
        <header class="text-center mb-8">
            <h1 class="text-5xl font-black uppercase italic text-yellow-500 tracking-tighter mb-2">{{ $musician->name }}</h1>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-[0.3em]">Peça sua música e apoie o artista</p>
        </header>

        <div class="mb-8">
            <input type="text" id="searchInput" onkeyup="filterSongs()" placeholder="Buscar música ou artista..." 
                   class="w-full bg-gray-900 border-2 border-gray-800 rounded-2xl px-6 py-4 text-white focus:border-yellow-500 outline-none shadow-xl text-sm">
        </div>

        <div id="songList" class="space-y-4 mb-20">
            @foreach($musician->songs as $song)
                <div class="song-item bg-gray-900/50 p-5 rounded-[24px] border border-gray-800 flex justify-between items-center group active:scale-95 transition-all">
                    <div class="flex-1 pr-4">
                        <h3 class="font-bold text-lg text-white leading-tight song-title">{{ $song->title }}</h3>
                        <p class="text-gray-500 text-xs uppercase font-bold song-artist">{{ $song->artist_original }}</p>
                    </div>
                    <button onclick="openModal('{{ $song->title }}', '{{ $song->id }}')" 
                            class="bg-yellow-500 text-black font-black px-6 py-4 rounded-2xl uppercase text-xs shadow-lg active:bg-white transition-all">
                        Pedir
                    </button>
                </div>
            @endforeach
        </div>

        <div id="orderModal" class="hidden fixed inset-0 bg-black/95 backdrop-blur-md flex items-center justify-center p-4 z-50">
            <div class="bg-gray-900 border border-gray-800 p-6 sm:p-8 rounded-[40px] w-full max-w-md relative shadow-2xl overflow-y-auto max-h-[90vh]">
                <h2 id="modalTitle" class="text-xl font-black uppercase italic text-yellow-500 mb-6 text-center"></h2>
                
                <form action="{{ route('order.store') }}" method="POST" id="orderForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="song_id" id="songIdInput">
                    
                    <div class="flex flex-col items-center mb-6 bg-white p-4 rounded-3xl border-4 border-yellow-500 w-48 mx-auto">
                        <img id="pixQRCode" src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($musician->pix_key) }}" 
                             alt="QR Code Pix" class="w-full h-auto">
                        <span class="text-[9px] text-black font-black uppercase mt-2">Escaneie para pagar</span>
                    </div>

                    <div class="mb-4">
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-4">Seu Nome / Mesa</label>
                        <input type="text" name="customer_name" required placeholder="Ex: Mesa 04" 
                               class="w-full bg-black border-2 border-gray-800 rounded-2xl px-5 py-3 text-white focus:border-yellow-500 outline-none text-sm">
                    </div>

                    <div class="bg-black p-4 rounded-3xl border border-gray-800 mb-4">
                        <span class="text-[10px] text-gray-500 font-bold uppercase block mb-2 text-center">Ou copie a chave</span>
                        <div class="flex items-center justify-between bg-gray-900/50 p-3 rounded-xl border border-gray-800">
                            <span id="pixValue" class="font-mono text-yellow-500 text-[11px] font-bold truncate flex-1">{{ $musician->pix_key }}</span>
                            <button type="button" onclick="copyPix()" id="copyBtnText" class="ml-2 text-[10px] font-black uppercase text-white bg-gray-800 px-3 py-1 rounded-lg hover:bg-yellow-500 hover:text-black transition-colors">
                                Copiar
                            </button>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-[10px] font-black uppercase text-gray-500 mb-2 ml-4 tracking-widest">Anexar Comprovante</label>
                        <input type="file" name="receipt" id="receiptInput" required onchange="validateForm()"
                               class="w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-white file:text-black">
                    </div>

                    <div class="mb-6 flex items-center gap-3 bg-white/5 p-4 rounded-2xl border border-white/5">
                        <input type="checkbox" id="confirmPayment" onchange="validateForm()" class="w-5 h-5 accent-yellow-500">
                        <label for="confirmPayment" class="text-[10px] font-black text-gray-400 uppercase leading-none">Confirmo o pagamento</label>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" onclick="closeModal()" class="flex-1 text-gray-500 font-black uppercase text-[10px]">Sair</button>
                        <button type="submit" id="submitBtn" disabled 
                                class="flex-[2] bg-gray-800 text-gray-600 font-black py-4 rounded-2xl uppercase italic cursor-not-allowed transition-all">
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

        function copyPix() {
            const pix = document.getElementById('pixValue').innerText;
            const btn = document.getElementById('copyBtnText');
            navigator.clipboard.writeText(pix).then(() => {
                const originalText = btn.innerText;
                btn.innerText = 'COPIADO!';
                btn.classList.add('bg-green-600');
                setTimeout(() => {
                    btn.innerText = originalText;
                    btn.classList.remove('bg-green-600');
                }, 2000);
            });
        }

        function validateForm() {
            const checkbox = document.getElementById('confirmPayment');
            const file = document.getElementById('receiptInput');
            const btn = document.getElementById('submitBtn');
            
            if(checkbox.checked && file.files.length > 0) {
                btn.disabled = false;
                btn.classList.remove('bg-gray-800', 'text-gray-600', 'cursor-not-allowed');
                btn.classList.add('bg-yellow-500', 'text-black');
            } else {
                btn.disabled = true;
                btn.classList.add('bg-gray-800', 'text-gray-600', 'cursor-not-allowed');
                btn.classList.remove('bg-yellow-500', 'text-black');
            }
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
