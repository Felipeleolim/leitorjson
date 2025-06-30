document.getElementById('parse-button').addEventListener('click', function () {
  const input = document.getElementById('input-area').value.trim();
  const table = document.getElementById('info-table');
  const tbody = document.getElementById('table-body');

  tbody.innerHTML = '';
  if (!input) {
    alert('Por favor, cole os dados no campo de texto.');
    table.classList.add('hidden');
    return;
  }

  let data = {};

  try {
    // Tenta interpretar como JSON
    data = JSON.parse(input);
  } catch (jsonError) {
    // Se falhar, tenta interpretar como query string
    try {
      const params = new URLSearchParams(input);
      for (const [key, value] of params.entries()) {
        data[key] = value;
      }
    } catch (queryError) {
      alert('Entrada inválida. Cole um JSON válido ou uma string de parâmetros.');
      table.classList.add('hidden');
      return;
    }
  }

  // Preencher tabela com os dados
  for (const [key, value] of Object.entries(data)) {
    const row = document.createElement('tr');

    const keyCell = document.createElement('td');
    keyCell.textContent = key;

    const valueCell = document.createElement('td');
    valueCell.textContent = value === null || value === '' ? '(vazio)' : value;

    row.appendChild(keyCell);
    row.appendChild(valueCell);
    tbody.appendChild(row);
  }

  table.classList.remove('hidden');
});
