<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Tasks - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="p-6">

        <!-- Filter -->
        <div class="mb-4 space-x-2">
            <a href="{{ route('tasks.index', $project->id) }}">All</a>

        </div>

        <!-- Create Task -->
        <form action="{{ route('tasks.store', $project->id) }}" method="POST" class="mb-6 space-y-2">
            @csrf

            <input type="text" name="title" placeholder="Title" class="border p-2 rounded w-full" required>

            <textarea name="description" placeholder="Description" class="border p-2 rounded w-full"></textarea>

            <select name="status" class="border p-2 rounded w-full" required>
                <option value="">Select Status</option>
                <option>To Do</option>
                <option>In Progress</option>
                <option>Done</option>
            </select>

            <input type="date" name="due_date" class="border p-2 rounded w-full">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Add Task
            </button>
        </form>

        <!-- Task List -->
        @foreach ($tasks as $task)
            <div class="border p-4 mb-3 rounded">

                <h3 class="font-bold">{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>

                <p class="text-sm">
                    Status: <b>{{ $task->status }}</b>
                </p>

                <p class="text-sm">
                    Due: {{ $task->due_date ?? 'N/A' }}
                </p>

                <div class="flex gap-2 mt-2">

                    <!-- Edit -->
                    <a href="{{ route('tasks.edit', [$project->id, $task->id]) }}"
                        class="bg-yellow-400 px-3 py-1 rounded">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('tasks.destroy', [$project->id, $task->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @endforeach

    </div>
</x-app-layout>
