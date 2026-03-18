<x-app-layout :musician="$musician">
    <div class="max-w-2xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Configurações do Perfil</h2>

        <form action="{{ route("musician.pix.update", $musician->slug) }}" method="POST" class="mb-10 bg-gray-900 p-6 rounded-3xl border border-gray-800">
            @csrf
            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Chave Pix para Recebimento</label>
            <div class="flex gap-2">
                <input type="text" name="pix_key" value="{{ $musician->pix_key }}" placeholder="E-mail, CPF ou Chave Aleatória" 
                    class="flex-1 bg-black border-gray-800 rounded-xl px-4 text-white focus:ring-yellow-500">
                <button type="submit" class="bg-green-600 text-white font-black px-6 py-2 rounded-xl text-xs uppercase hover:bg-green-500">
                    Guardar
                </button>
            </div>
        </form>

        <hr class="border-gray-800 mb-10">

        <h2 class="text-2xl font-bold mb-6">Gerenciar Repertório</h2>
        <form action="{{ route("musician.songs.store", $musician->slug) }}" method="POST" class="mb-10 bg-gray-900 p-6 rounded-3xl border border-gray-800">
            @csrf
            <div class="flex gap-2">
                <input type="text" name="title" placeholder="Nome da música..." required class="flex-1 bg-black border-gray-800 rounded-xl px-4 text-white">
                <button type="submit" class="bg-yellow-500 text-black font-black px-6 py-2 rounded-xl text-xs uppercase">ADD</button>
            </div>
        </form>

        <div class="space-y-2">
            @foreach($songs as $song)
                <div class="flex justify-between items-center bg-gray-900/50 p-4 rounded-2xl border border-gray-800">
                    <span>{{ $song->title }}</span>
                    <form action="{{ route("musician.songs.destroy", [$musician->slug, $song->id]) }}" method="POST">
                        @csrf @method("DELETE")
                        <button class="text-gray-600 hover:text-red-500 text-xs font-bold uppercase">Excluir</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
