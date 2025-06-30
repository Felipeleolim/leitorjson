document.getElementById('parse-button').addEventListener('click', function () {
    const input = document.getElementById('input-area').value.trim();
    const table = document.getElementById('info-table');
    const tbody = document.getElementById('table-body');

    // Limpa tabela anterior
    tbody.innerHTML = '';

    if (!input) {
        alert('Por favor, cole os parâmetros no campo de texto.');
        table.classList.add('hidden');
        return;
    }

    const params = new URLSearchParams(input);

    for (const [key, value] of params.entries()) {
        const row = document.createElement('tr');

        const keyCell = document.createElement('td');
        keyCell.textContent = key;

        const valueCell = document.createElement('td');
        valueCell.textContent = value || '(vazio)';

        row.appendChild(keyCell);
        row.appendChild(valueCell);
        tbody.appendChild(row);
    }

    table.classList.remove('hidden');
});
