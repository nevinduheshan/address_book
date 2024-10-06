<x-layout>


    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Projects</h1>
            <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Project</a>
        </div>

        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Customers</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $project->name }}</td>
                        <td class="py-2 px-4">{{ $project->description }}</td>
                        <td class="py-2 px-4">
                            @foreach ($project->customers as $customer)
                                <span>{{ $customer->name }}</span>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td class="py-2 px-4 flex space-x-2">
                            <a href="{{ route('projects.edit', $project->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
</x-layout>
