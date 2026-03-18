<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Pix - TocaAí</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="max-w-sm w-full bg-gray-800 p-8 rounded-3xl text-center shadow-2xl border border-green-500">
        <h1 class="text-2xl font-bold mb-2 text-green-400">Sucesso!</h1>
        <p class="text-gray-400 mb-6">Pedido para {{ $order->customer_name }} registrado.</p>
        
        <div class="bg-white p-4 rounded-xl mb-6 inline-block">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=CHAVE_PIX_EXEMPLO" alt="QR Code Pix">
        </div>

        <p class="text-sm mb-2 text-gray-300">Valor: <span class="font-bold text-white text-lg">R$ 5,00</span></p>

        <a href="/" class="block w-full bg-green-600 hover:bg-green-500 py-3 rounded-xl font-bold transition">
            Voltar ao Início
        </a>
    </div>
</body>
</html>
