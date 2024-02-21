<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Transaction') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-auto shadow-sm sm:rounded-lg p-4 ">
                <table class="table text-black">
                    <thead>
                        <tr class="border-collapse border-none text-black text-center text-md">
                            <th>No</th>
                            <th>Serial Number</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $t)
                            <tr  @class(['border-collapse border-none text-center', 'bg-gray-100' => $loop->iteration % 2==1, 'bg-white' => $loop->iteration % 2==0])>
                            <td>{{$loop->iteration}}</td></th>
                            <td>{{$t->serial_number}}</td>
                            <td>{{count($t->cart)}}</td>
                            <td>{{$t->total}}</td>
                            <td class="flex justify-center gap-2">
                                <a  class="btn btn-accent text-white" href="{{route('cashier.transaction.show', ["id"=>$t->id])}}">detail</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
