<x-app-layout>
    <x-slot name="header">
        <h2>Edit Project</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $project->name }}" class="border p-2 rounded w-1/3">

            <button class="bg-green-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
