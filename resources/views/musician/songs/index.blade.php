<x-app-layout>
    <div class="py-12 bg-black min-h-screen text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-black uppercase italic text-yellow-500">Minhas Músicas</h1>
                <a href="{{ route('musician.dashboard') }}" class="text-xs font-bold text-gray-500 uppercase hover:text-white">Voltar ao Painel</a>
            </div>

            <div class="bg-gray-900 p-8 rounded-[32px] border border-gray-800 mb-8 shadow-2xl">
                <h2 class="text-[10px] font-black uppercase mb-6 text-gray-500 tracking-widest">Cadastrar Nova Música</h2>
                <form action="{{ route('musician.songs.store', $musician->slug) }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @csrf
                    <div class="md:col-span-2">
                        <input type="text" name="title" placeholder="Nome da Música" required 
                               class="w-full bg-black border-2 border-gray-800 rounded-2xl px-6 py-4 text-white focus:border-yellow-500 outline-none transition-all">
                    </div>
                    <div class="md:col-span-2">
                        <input type="text" name="artist_original" placeholder="Compositor / Artista" required
                               class="w-full bg-black border-2 border-gray-800 rounded-2xl px-6 py-4 text-white focus:border-yellow-500 outline-none transition-all">
                    </div>
                    <button type="submit" class="bg-yellow-500 text-black font-black rounded-2xl uppercase italic hover:scale-105 transition-transform shadow-lg shadow-yellow-500/20">
                        Add
                    </button>
                </form>
            </div>

            <div class="bg-gray-900 rounded-[32px] border border-gray-800 overflow-hidden shadow-xl">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-black/50 text-[10px] uppercase text-gray-500 font-black">
                            <th class="px-8 py-5">Música / Artista</th>
                            <th class="px-8 py-5 text-right">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($songs as $song)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-8 py-5">
                                <p class="font-bold text-white">{{ $song->title }}</p>
                                <p class="text-[10px] text-gray-500 uppercase font-bold">{{ $song->artist_original }}</p>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <form action="{{ route('musician.songs.destroy', [$musician->slug, $song->id]) }}" method="POST" onsubmit="return confirm('Excluir esta música?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-[10px] font-black uppercase hover:text-red-400">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($songs->isEmpty())
                    <div class="p-12 text-center">
                        <p class="text-gray-600 italic font-medium">Sua lista está vazia. Adicione músicas acima!</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
