<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        // Se você ver uma tela preta com esses dados, a SESSÃO ESTÁ OK.
        // Se a página apenas recarregar, o problema é o CSRF/Sessão (Middleware).
        dd('Dados recebidos com sucesso!', $request->all());
    }
}
