<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: #f8f9fa;
      }
      .card {
        border-radius: 12px;
      }
    </style>
  </head>
  <body>
    <div class="container py-5">
      <h1 class="text-center mb-4">➕ Criar Nova Tarefa</h1>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card p-4 shadow-sm">
            <form id="taskForm">
              <div class="mb-3">
                <label for="taskTitle" class="form-label">Título</label>
                <input type="text" class="form-control" id="taskTitle" required>
              </div>
              <div class="mb-3">
                <label for="taskDescription" class="form-label">Descrição</label>
                <textarea class="form-control" id="taskDescription" rows="4" required></textarea>
              </div>
              <div class="mb-3">
                <label for="taskColumn" class="form-label">Coluna</label>
                <select class="form-select" id="taskColumn">
                  <option value="todo">A Fazer</option>
                  <option value="in-progress">Em Progresso</option>
                  <option value="done">Concluído</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary w-100">Salvar Tarefa</button>
            </form>
            <div class="mt-3 text-center">
              <a href="kanban.html" class="btn btn-link">⬅ Voltar ao Kanban</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Função para salvar tarefa
      const form = document.getElementById('taskForm');
      form.addEventListener('submit', function(e){
        e.preventDefault();
        const title = document.getElementById('taskTitle').value;
        const desc = document.getElementById('taskDescription').value;
        const column = document.getElementById('taskColumn').value;

        const task = { title, desc, column };

        // Simulando "salvar" no localStorage
        const tasks = JSON.parse(localStorage.getItem('kanbanTasks') || '[]');
        tasks.push(task);
        localStorage.setItem('kanbanTasks', JSON.stringify(tasks));

        alert('Tarefa salva com sucesso!');
        form.reset();
      });
    </script>
  </body>
</html>
