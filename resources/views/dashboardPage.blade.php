<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Kanban</title>
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
      <h1 class="text-center mb-4">📊 Dashboard de Tarefas</h1>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5 class="text-primary">A Fazer</h5>
            <h2 id="count-todo">0</h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5 class="text-warning">Em Progresso</h5>
            <h2 id="count-inprogress">0</h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card text-center p-4 shadow-sm">
            <h5 class="text-success">Concluído</h5>
            <h2 id="count-done">0</h2>
          </div>
        </div>
      </div>
      <div class="mt-4 text-center">
        <a href="kanban.html" class="btn btn-primary">⬅ Voltar ao Kanban</a>
      </div>
    </div>

    <script>
      // Ler tarefas do localStorage e contar por coluna
      const tasks = JSON.parse(localStorage.getItem('kanbanTasks') || '[]');
      const counts = { todo: 0, 'in-progress': 0, done: 0 };

      tasks.forEach(t => {
        counts[t.column]++;
      });

      document.getElementById('count-todo').innerText = counts.todo;
      document.getElementById('count-inprogress').innerText = counts['in-progress'];
      document.getElementById('count-done').innerText = counts.done;
    </script>
  </body>
</html>
