<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" value="{{ old('name') }}" />
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Price</label>
                            <input type="number" name="price" id="price" class="form-input rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" value="{{ old('price') }}" />
                        </div>
                        <div class="mb-4 col-6">
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-input rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" value="{{ old('stock') }}" />
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                            <textarea name="description" id="description" class="form-textarea rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-gray-200">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Image</label>
                            <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm mt-1 block w-full dark:bg-gray-700 dark:text-gray-200" />
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
