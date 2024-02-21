<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form method="POST" enctype="multipart/form-data" action="{{route('admin.product.store')}}">
                    @csrf
                    <ul>
                        <li class="flex my-2">
                            <x-text-input id="name" name="name" placeholder="name" type="text" class="mt-1 block w-full"    autocomplete="name" />
                        </li>
                        <li class="flex my-2">
                            <x-text-input id="stock" name="stock" placeholder="stock" type="number" class="mt-1 block w-full"    autocomplete="name" />
                        </li>
                        <li class="flex my-2">
                            <x-text-input id="price" name="price" placeholder="price" type="number" class="mt-1 block w-full"    autocomplete="name" />
                        </li>
                        <li>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
