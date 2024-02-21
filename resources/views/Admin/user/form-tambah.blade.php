<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form method="POST" action="{{ route('admin.user.store') }}">
                    @csrf
                    <ul class="text-black">
                        <li class="flex my-2">
                            <x-text-input id="name" name="name" placeholder="name" type="text" class="mt-1 block w-full"  required  autocomplete="name" />
                        </li>
                        <li class="flex my-2">
                            <x-text-input id="email" name="email" placeholder="email" type="email" class="mt-1 block w-full"  required  autocomplete="email" />
                        </li>
                        <li class="flex my-2">
                            <select class="form-select w-full input input-bordered focus:border-info bg-white border-gray-300" name="role" >
                                <option value="0" selected disabled>pilih role</option>
                                <option value="1" >admin</option>
                                <option value="0" >cashier</option>
                            </select>
                        </li>
                        <li class="flex my-2">
                            <x-text-input id="password" name="password" placeholder="password" type="text" class="mt-1 block w-full"  required  autocomplete="name" />
                        </li>
                        <li class="flex justify-end">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
