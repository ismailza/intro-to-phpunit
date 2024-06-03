<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <p class="text-lg font-semibold">{{ $product->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->created_at->diffForHumans() }}</p>
                    </div>
                    @if($product->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-96 object-cover" />
                    </div>
                    @endif
                    <div class="mb-4">
                        <span class="text-lg font-semibold text-gray-500 dark:text-gray-400">Price:</span>
                        <span class="text-lg font-semibold">{{ $product->price }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-lg font-semibold text-gray-500 dark:text-gray-400">Stock:</span>
                        <span class="text-lg font-semibold">{{ $product->stock }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-lg font-semibold text-gray-500 dark:text-gray-400">Description:</span>
                        <p class="text-lg font-semibold">{{ $product->description }}</p>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded me-2">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
