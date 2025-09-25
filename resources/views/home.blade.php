<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kanban Board</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fa; }
    .kanban-board { display: flex; gap: 1rem; padding: 1rem; flex-wrap: wrap; }
    .kanban-column { flex: 1; min-width: 280px; background: #fff; border-radius: 12px; padding: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    .kanban-card { background: #f1f3f5; border-radius: 10px; padding: 0.75rem; margin-bottom: 0.75rem; box-shadow: 0 2px 4px rgba(0,0,0,0.08); cursor: grab; }
    .done-task { text-decoration: line-through; color: #6c757d; }
  </style>
</head>
<body>
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">📌 My Kanban</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">➕ Create Task</a>
  </div>

  <div class="kanban-board">
    <div class="kanban-column" id="todo">
      <h5 class="text-primary text-center">To Do</h5>
      @foreach ($tasks_todo as $task)
        <a href="{{ route('tasks.edit', $task->id) }}" class="kanban-card d-block text-dark text-decoration-none" data-id="{{ $task->id }}">
          {{ $task->title }}
        </a>
      @endforeach
    </div>

    <div class="kanban-column" id="in_progress">
      <h5 class="text-warning text-center">In Progress</h5>
      @foreach ($tasks_in_progress as $task)
        <a href="{{ route('tasks.edit', $task->id) }}" class="kanban-card d-block text-dark text-decoration-none" data-id="{{ $task->id }}">
          {{ $task->title }}
        </a>
      @endforeach
    </div>

    <div class="kanban-column" id="done">
      <h5 class="text-success text-center">Done</h5>
      @foreach ($tasks_done as $task)
        <a href="{{ route('tasks.edit', $task->id) }}" class="kanban-card d-block text-dark text-decoration-none {{ $task->status === 'done' ? 'done-task' : '' }}" data-id="{{ $task->id }}">
          {{ $task->title }}
        </a>
      @endforeach
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
  document.querySelectorAll('.kanban-column').forEach(column => {
    new Sortable(column, {
      group: 'kanban',
      animation: 150,
      ghostClass: 'bg-light',
      draggable: '.kanban-card',
      onEnd: function(evt) {
        const card = evt.item;
        const taskId = card.getAttribute('data-id');
        const newStatus = evt.to.id;

        fetch("{{ route('tasks.updateStatus') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ id: taskId, status: newStatus })
        });
      }
    });
  });
</script>
</body>
</html>
