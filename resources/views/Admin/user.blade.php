<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end my-2">
                <a class="btn btn-info text-white" href="{{route('admin.user.create')}}">
                    tambah
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <table class="table text-black">
                    <thead>
                        <tr class="border-collapse border-none text-black text-center text-md">
                            <th>No</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr  @class(['border-collapse border-none text-center', 'bg-gray-100' => $loop->iteration % 2==1, 'bg-white' => $loop->iteration % 2==0])>
                            <td>{{$loop->iteration}}</td></th>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->phone_number}}</td>
                            <td>{{$u->address}}</td>
                            <td class="flex justify-center gap-2">
                                {{$u->role == '1'? 'admin':'cashier'}}
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
