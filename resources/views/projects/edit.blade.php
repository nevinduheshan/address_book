<x-layout>


    <div class="container mx-auto py-4">
        <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

        <form method="POST" action="{{ route('projects.update', $project->id) }}">
            @csrf
            @method('PUT')

            <!-- Project Name -->
            <div class="mb-4">
                <label for="name" class="block font-semibold">Project Name</label>
                <input type="text" name="name" id="name" class="border w-full p-2 rounded"
                    value="{{ old('name', $project->name) }}" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Project Description -->
            <div class="mb-4">
                <label for="description" class="block font-semibold">Project Description</label>
                <textarea name="description" id="description" class="border w-full p-2 rounded">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Select Customers -->
            <div class="mb-4">
                <label for="customers" class="block font-semibold">Select Customers</label>
                <select name="customers[]" id="customers" class="border w-full p-2 rounded" multiple required>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ in_array($customer->id, $project->customers->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customers')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Project</button>
            </div>
        </form>
    </div>
</x-layout>
