<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                            {{ __('Add New Product') }}
                        </a>
                    </div>
                    <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">ID</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">Name</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">Stock</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">Price (MAD)</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">Price (USD)</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700">Created At</th>
                                <th class="px-4 py-2 border border-gray-200 dark:border-gray-700 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->id }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->name }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->stock }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->price }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->priceUSD }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700">{{ $product->created_at }}</td>
                                <td class="px-4 py-1 border border-gray-200 dark:border-gray-700 flex justify-end">
                                    <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded me-2">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded me-2">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-2 border border-gray-200 dark:border-gray-700 text-center" colspan="7">{{ __('No products found!') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
