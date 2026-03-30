<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Edit Task - {{ $project->name }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">

        <form action="{{ route('tasks.update', [$project->id, $task->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $task->title) }}"
                    class="border p-2 rounded w-full" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block mb-1">Description</label>
                <textarea name="description" class="border p-2 rounded w-full">{{ old('description', $task->description) }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="status" class="border p-2 rounded w-full" required>
                    <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label class="block mb-1">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                    class="border p-2 rounded w-full">
            </div>

            <!-- Buttons -->
            <div class="flex gap-2">
                <button class="bg-green-500 text-white px-4 py-2 rounded">
                    Update Task
                </button>

                <a href="{{ route('tasks.index', $project->id) }}" class="bg-gray-400 text-white px-4 py-2 rounded">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</x-app-layout>
