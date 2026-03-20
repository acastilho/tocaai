@extends('layouts.tocaai')

@section('title', 'Novo Cadastro de Cantor')

@section('content')
<div class="container d-flex align-items-center justify-content-center py-5">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold text-white">Toca<span style="color: #FF4757;">Aí</span> <small class="text-muted" style="font-size: 0.5em;">v2</small></h1>
            <p class="text-secondary">Nova tabela de cadastro (Singer)</p>
        </div>
        
        <div class="card p-4 shadow border-0" style="background: #161616; border-radius: 20px;">
            <form action="{{ route('singer.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label text-secondary small">E-mail de Acesso</label>
                    <input type="email" name="email" class="form-control bg-dark border-secondary text-white" required placeholder="seu@email.com">
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary small">Senha</label>
                    <input type="password" name="password" class="form-control bg-dark border-secondary text-white" required placeholder="Mínimo 8 caracteres">
                </div>

                <hr class="border-secondary my-4">
                
                <div class="mb-3">
                    <label class="form-label text-secondary small">Nome do Cantor (Singer Name)</label>
                    <input type="text" name="name" class="form-control bg-dark border-secondary text-white" required placeholder="Ex: André Singer">
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary small">Chave PIX</label>
                    <input type="text" name="pix_key" class="form-control bg-dark border-secondary text-white" required placeholder="Sua chave para receber">
                </div>

                <button type="submit" class="btn w-100 py-3 fw-bold" style="background: #FF4757; color: white; border-radius: 50px;">
                    CADASTRAR NOVO CANTOR
                </button>
            </form>
        </div>
        
        <div class="text-center mt-3">
            <a href="/" class="text-secondary small">Voltar para Home</a>
        </div>
    </div>
</div>
@endsection
