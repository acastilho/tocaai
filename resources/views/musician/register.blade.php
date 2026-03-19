@extends('layouts.tocaai')

@section('title', 'Cadastro de Cantor - TocaAí')

@section('content')
<div class="container d-flex align-items-center justify-content-center py-5">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold text-white">Toca<span style="color: #FF4757;">Aí</span></h1>
            <p class="text-secondary">Crie seu perfil e sua conta de acesso</p>
        </div>
        
        <div class="card card-tocaai p-4 shadow border-0" style="background: #161616; border-radius: 20px;">
            <form action="{{ route('musician.register.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-secondary small">E-mail de Acesso</label>
                    <input type="email" name="email" class="form-control bg-dark border-secondary text-white" placeholder="seu@email.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-secondary small">Senha</label>
                    <input type="password" name="password" class="form-control bg-dark border-secondary text-white" placeholder="Mínimo 8 caracteres" required>
                </div>

                <hr class="border-secondary my-4">
                
                <div class="mb-3">
                    <label class="form-label text-secondary small">Nome Artístico</label>
                    <input type="text" name="name" class="form-control bg-dark border-secondary text-white" placeholder="Ex: André Tonal" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-secondary small">Chave PIX</label>
                    <input type="text" name="pix_key" class="form-control bg-dark border-secondary text-white" placeholder="Sua chave para receber" required>
                </div>

                <button type="submit" class="btn btn-coral w-100 py-3 fw-bold" style="background: #FF4757; color: white; border-radius: 50px;">
                    Finalizar Cadastro
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
