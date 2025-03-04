<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-4">

            <!-- Show All Tasks Checkbox -->
            <div class="flex items-center space-x-2 mb-4">
                <input type="checkbox" id="showAllTasks" class="w-5 h-5 text-blue-500 rounded cursor-pointer"
                    onchange="window.location.href='?showAll=' + (this.checked ? 1 : 0)" {{ $showAll ? 'checked' : '' }}>
                <label for="showAllTasks" class="text-gray-700 font-medium">Show All Tasks</label>
            </div>

            <!-- Add Task Form -->
            <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-2 mb-4">
                @csrf
                <input type="text" name="title" class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Project # To Do" required>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Add
                </button>
            </form>

            <!-- Task List -->
            <ul>
                @foreach($tasks as $task)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-lg shadow-sm mb-2">
                        <div class="flex items-center gap-2">
                            <!-- Toggle Completion -->
                            <form method="POST" action="{{ route('tasks.toggleComplete', $task->id) }}">
                                @csrf
                                <input type="checkbox" onchange="this.form.submit()" class="w-5 h-5 cursor-pointer"
                                    {{ $task->is_completed ? 'checked' : '' }}>
                            </form>

                            <!-- Task Title -->
                            <span class="text-gray-800 {{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                                {{ $task->title }}
                            </span>

                            <!-- Time -->
                            <small class="text-gray-400">a few seconds ago</small>
                        </div>

                        <div class="flex items-center space-x-2">
                            <!-- User Avatar -->
                            <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="User" class="w-8 h-8 rounded-full">

                            <!-- Delete Task -->
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    🗑
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            
        </div>
    </body>
</html>
