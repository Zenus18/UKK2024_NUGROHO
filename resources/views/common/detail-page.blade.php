<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cashier Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <ul>
                    <li class="flex justify-between text-black">
                        <h1 class="font-bold ">Transaction Number</h1>
                        <h1 >NM-{{$transaction->serial_number}}</h1>
                    </li>
                    <li class="flex justify-between text-black">
                        <h1 class="font-bold ">Cashier</h1>
                        <h1 >{{$transaction->user->name}}</h1>
                    </li>
                    <li class="border-2 border-dashed border-black my-4">
                       
                    </li>
                    <li class="text-black font-bold my-2">
                        <h1> Product: </h1>
                    </li>
                    @foreach ($transaction->cart as $c)
                        <li   @class(['flex justify-between text-black p-2', 'bg-gray-100' => $loop->iteration % 2==1, 'bg-white' => $loop->iteration % 2==0])>
                            <div class="block">
                                <h1 class="font-bold">{{$c->product->name."   ".$c->qty."x"}} </h1>
                                <p>
                                    {{$c->price}}
                                </p>
                            </div>
                            <div>
                                <h1 class="font-bold my-auto">
                                    {{$c->sub_total}}
                                </h1>
                            </div>
                        </li>
                    @endforeach
                    <li class="border-black border-2 border-dashed my-4">

                    </li>
                    <li class="flex justify-between text-black">
                        <h1 class="font-bold ">Total</h1>
                        <h1 >{{$transaction->total}}</h1>
                    </li>
                    <li class="flex justify-between text-black">
                        <h1 class="font-bold ">Dibayar</h1>
                        <h1 >{{$transaction->paid}}</h1>
                    </li>
                    <li class="flex justify-between text-black">
                        <h1 class="font-bold ">Kembalian</h1>
                        <h1 >{{$transaction->change}}</h1>
                    </li>
                </ul>
                
            </div>
            <div class="flex justify-end w-full mt-4">
                <a  class="btn btn-info text-white " href="{{Auth::user()->role == 1? route('admin.dashboard'):route('cashier.transaction')}}">
                    kembali
                </a>
            </div>  
        </div>
    </div>
</x-app-layout>
