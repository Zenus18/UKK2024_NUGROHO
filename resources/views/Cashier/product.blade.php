<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between my-2">
                <form method="POST" enctype="multipart/form-data" action="{{route('cashier.product.find')}}">
                    @csrf
                    @method('post')
                    <div class="join">
                        <input type="text" name="query" placeholder="search here ..." class="input form-control form-input join-item bg-white"/>
                        <button type="submit" class="btn bg-info border-none text-white rounded-l-none">
                            search
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-white overflow-y-scroll shadow-sm sm:rounded-lg p-4">
                <table class="table text-black">
                    <thead>
                        <tr class="border-collapse border-none text-black text-center text-md">
                            <th>No</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Product as $p)
                            <tr  @class(['border-collapse border-none text-center', 'bg-gray-100' => $loop->iteration % 2==1, 'bg-white' => $loop->iteration % 2==0, 'bg-red-100'=>!$p->is_active])>
                            <td>{{$loop->iteration}}</td></th>
                            <td>{{$p->name}}</td>
                            <td>{{$p->stock}}</td>
                            <td>{{$p->price}}</td>
                            <td class="flex justify-center gap-2">
                                <a  class="btn btn-accent text-white" href="{{route('cashier.cart.store', ["id"=>$p->id])}}">Tambah</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
