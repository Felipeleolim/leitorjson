<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Conversor Texto para JSON</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-3xl">
        <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">Conversor Texto ➔ JSON</h1>

        <form method="POST" class="space-y-4">
            <textarea name="textInput" rows="8" placeholder="Cole o texto aqui..." class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-blue-400 resize-none"><?php echo isset($_POST['textInput']) ? htmlspecialchars($_POST['textInput']) : '' ?></textarea>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300">
                    Converter
                </button>
            </div>
        </form>

        <h2 class="text-xl font-semibold mt-8 mb-2 text-gray-700">Resultado:</h2>
        <pre id="output" class="bg-gray-100 p-4 rounded-lg border overflow-x-auto min-h-[100px]"><?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["textInput"])) {
            $input = trim($_POST["textInput"]);
            $obj = [];

            if (strpos($input, '=') === false) {
                echo "Formato inválido. Não encontrei \"=\" no texto.";
            } else {
                $pares = explode('&', $input);

                foreach ($pares as $par) {
                    list($chave, $valor) = array_map('trim', explode('=', $par, 2));

                    if ($valor === "null") {
                        $valor = null;
                    } elseif ($valor === "true") {
                        $valor = true;
                    } elseif ($valor === "false") {
                        $valor = false;
                    } elseif (is_numeric($valor)) {
                        $valor = (float) $valor;
                    }

                    $obj[$chave] = $valor;
                }

                echo json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        }
        ?></pre>

        <div class="flex justify-end mt-4">
            <button onclick="copiarTexto()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                Copiar JSON
            </button>
        </div>
    </div>

    <script>
    function copiarTexto() {
        const output = document.getElementById('output').textContent;
        navigator.clipboard.writeText(output)
            .then(() => alert('JSON copiado para a área de transferência!'))
            .catch(() => alert('Erro ao copiar.'));
    }
    </script>

</body>
</html>