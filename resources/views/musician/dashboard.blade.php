<x-app-layout :musician="$musician">
    <div class="max-w-2xl mx-auto p-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Pedidos na Fila</h2>
            <div class="bg-red-950/30 px-3 py-1 rounded-full border border-red-900/50 flex items-center gap-2">
                <span class="w-2 h-2 bg-red-600 rounded-full animate-ping"></span>
                <span class="text-[10px] font-black uppercase text-red-500">Ao Vivo</span>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($orders->where("status", "pending") as $order)
                <div class="bg-gray-900 border-l-4 border-yellow-500 p-5 rounded-r-2xl flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-black uppercase">{{ $order->song->title }}</h2>
                        <p class="text-yellow-500">Por: {{ $order->customer_name }}</p>
                    </div>
                    <form action="{{ route("order.complete", $order->id) }}" method="POST">
                        @csrf @method("PATCH")
                        <button class="bg-green-600 p-3 rounded-xl">✓</button>
                    </form>
                </div>
            @empty
                <p class="text-center text-gray-600 py-10">Nenhum pedido agora.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
