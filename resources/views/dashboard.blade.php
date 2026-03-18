<x-app-layout>
    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-gray-900 p-6 rounded-3xl border border-gray-800 h-fit">
                    <h3 class="text-yellow-500 font-black uppercase mb-4 text-sm italic">Configurar Pix</h3>
                    <form action="{{ route("musician.pix.update", $musician->slug) }}" method="POST">
                        @csrf
                        <input type="text" name="pix_key" value="{{ $musician->pix_key }}" 
                               class="w-full bg-black border-gray-800 rounded-xl px-4 py-3 text-white mb-4 outline-none focus:border-yellow-500" placeholder="Sua chave Pix">
                        <button type="submit" class="w-full bg-yellow-500 text-black font-bold py-3 rounded-xl uppercase text-xs hover:scale-105 transition-transform">
                            Salvar Chave
                        </button>
                    </form>
                    
                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <a href="{{ route("musician.songs.index", $musician->slug) }}" 
                           class="block w-full text-center bg-gray-800 text-white font-bold py-3 rounded-xl uppercase text-xs hover:bg-gray-700">
                            Gerenciar Repertório
                        </a>
                        <a href="{{ route("musician.show", $musician->slug) }}" target="_blank"
                           class="block w-full text-center mt-3 text-gray-500 text-[10px] uppercase font-bold hover:text-yellow-500">
                            Ver meu link público
                        </a>
                    </div>
                </div>

                <div class="md:col-span-2 bg-gray-900 p-6 rounded-3xl border border-gray-800">
                    <h3 class="text-white font-black uppercase mb-4 text-xl italic">Pedidos Recentes</h3>
                    @forelse($orders as $order)
                        <div class="flex justify-between items-center bg-black p-4 rounded-2xl mb-3 border border-gray-800">
                            <div>
                                <p class="text-yellow-500 font-bold">{{ $order->song->title }}</p>
                                <p class="text-gray-500 text-xs">Para: {{ $order->customer_name }}</p>
                            </div>
                            <span class="text-[10px] bg-gray-800 px-3 py-1 rounded-full text-gray-400 uppercase font-bold">{{ $order->status }}</span>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-600 italic">Nenhum pedido recebido ainda.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
