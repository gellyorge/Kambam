<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ isset($task) ? 'Edit Task' : 'Create Task' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <h1 class="text-center mb-4">{{ isset($task) ? '✏️ Edit Task' : '➕ Create New Task' }}</h1>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4 shadow-sm">
        <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
          @csrf
          @if(isset($task))
            @method('PUT')
          @endif

          <div class="mb-3">
            <label for="taskTitle" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="taskTitle" value="{{ $task->title ?? '' }}" required>
          </div>

          <div class="mb-3">
            <label for="taskDescription" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="taskDescription" rows="4">{{ $task->description ?? '' }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100 mb-2">
            {{ isset($task) ? 'Update Task' : 'Save Task' }}
          </button>
        </form>

        @if(isset($task))
          <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this task?')">
              🗑️ Delete Task
            </button>
          </form>
        @endif

        <div class="mt-3 text-center">
          <a href="{{ route('tasks.index') }}" class="btn btn-link">⬅ Back to Kanban</a>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
