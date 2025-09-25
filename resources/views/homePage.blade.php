<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kanban Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: #f8f9fa;
      }
      .kanban-board {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        flex-wrap: wrap; /* permite quebrar linha */
      }
      .kanban-column {
        flex: 1;
        min-width: 280px;
        max-width: 100%;
        background: #ffffff;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      }
      .kanban-column h5 {
        text-align: center;
        margin-bottom: 1rem;
      }
      .kanban-card {
        background: #f1f3f5;
        border-radius: 10px;
        padding: 0.75rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        cursor: grab;
        transition: all 0.2s ease-in-out;
        user-select: none; /* 🚀 evita selecionar texto ao arrastar */
        }
        .kanban-card:hover {
        background: #e9ecef;
        }

      /* Riscar card concluído */
      .done-task {
        text-decoration: line-through;
        color: #6c757d;
      }
      /* Responsividade */
      @media (max-width: 768px) {
        .kanban-board {
          flex-direction: column;
        }
        .kanban-column {
          width: 100%;
        }
        .kanban-board, 
        .kanban-column, 
        .kanban-card {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-fluid py-4">
      <h1 class="text-center mb-4">📌 Meu Kanban</h1>

      <div class="kanban-board">
        <!-- Coluna: A Fazer -->
        <div class="kanban-column" id="todo">
          <h5 class="text-primary">A Fazer</h5>
          <div class="kanban-card">Criar layout do projeto</div>
          <div class="kanban-card">Configurar autenticação</div>
          <div class="kanban-card">Definir banco de dados</div>
        </div>

        <!-- Coluna: Em Progresso -->
        <div class="kanban-column" id="in-progress">
          <h5 class="text-warning">Em Progresso</h5>
          <div class="kanban-card">Desenvolver componente Kanban</div>
        </div>

        <!-- Coluna: Concluído -->
        <div class="kanban-column" id="done">
          <h5 class="text-success">Concluído</h5>
          <div class="kanban-card done-task">Setup do Laravel</div>
          <div class="kanban-card done-task">Instalação do Bootstrap</div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
      // Função para atualizar estilo de concluído
      function updateTaskStyles() {
        document.querySelectorAll('.kanban-card').forEach(card => {
          const parent = card.closest('.kanban-column');
          if (parent && parent.id === 'done') {
            card.classList.add('done-task');
          } else {
            card.classList.remove('done-task');
          }
        });
      }

      // Drag & drop nos CARDS
      document.querySelectorAll('.kanban-column').forEach(column => {
        new Sortable(column, {
          group: 'kanban',
          animation: 150,
          ghostClass: 'bg-light',
          draggable: '.kanban-card',
          onEnd: updateTaskStyles
        });
      });

      // Rodar ao carregar
      updateTaskStyles();
    </script>
  </body>
</html>
