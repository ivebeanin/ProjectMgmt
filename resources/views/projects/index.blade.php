<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Projects</h2>
    </x-slot>

    <div class="p-6">

        <!-- Create Project -->
        <form action="{{ route('projects.store') }}" method="POST" class="mb-6">
            @csrf
            <input type="text" name="name" placeholder="Project name" class="border p-2 rounded w-1/3" required>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Create
            </button>
        </form>

        <!-- Project List -->
        @foreach ($projects as $project)
            <div class="border p-4 mb-3 rounded flex justify-between">

                <div>
                    <h3 class="font-bold">{{ $project->name }}</h3>

                    <a href="{{ route('tasks.index', $project->id) }}" class="text-blue-500 text-sm">
                        View Tasks
                    </a>
                </div>

                <div class="flex gap-2">

                    <!-- Edit -->
                    <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-400 px-3 py-1 rounded">
                        Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
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
