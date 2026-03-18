<nav class="bg-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/dashboard" class="text-yellow-500 font-black italic uppercase text-xl">TocaAí</a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="/dashboard" class="text-white hover:text-yellow-500 font-bold text-sm uppercase transition-colors">
                        Painel
                    </a>

                    @php
                        $musician = \App\Models\Musician::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
                    @endphp

                    @if($musician)
                        <a href="/dashboard/{{ $musician->slug }}/repertorio" class="text-white hover:text-yellow-500 font-bold text-sm uppercase transition-colors">
                            Repertório
                        </a>
                    @endif
                </div>
            </div>

            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 text-[10px] font-black uppercase hover:text-white transition-colors">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
