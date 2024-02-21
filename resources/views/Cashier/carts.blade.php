<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(count($cart) > 0)
                <div class="bg-white overflow-y-scroll shadow-sm sm:rounded-lg p-4">
                <ul>
                   @foreach ($cart as $c)
                     <li  @class(['flex justify-between  text-black font-bold my-2 p-2', 'bg-gray-100' => $loop->iteration % 2==1, 'bg-white' => $loop->iteration % 2==0])>
                        <div class="block flex-1">
                            {{$c->product->name." ".$c->qty." x"}}
                            <br>
                            {{$c->price}}
                        </div>
                        <div class="flex-1 text-center my-auto">
                            {{$c->sub_total}}
                        </div>
                        <div class="flex-1 flex justify-end">
                            <form method="POST" enctype="multipart/form-data" action="{{route('cashier.cart.update', ['id'=>$c->id])}}">
                                @csrf
                                @method('post')
                                <div class="join">
                                    <input type="number" name="qty" placeholder="qty" value="{{$c->qty}}" class="input form-control input-bordered max-w-32 form-input join-item bg-white text-center"/>
                                    <button type="submit" class="btn bg-info border-none text-white rounded-l-none">
                                        Tambah
                                    </button>
                                </div>
                            </form>
                        </div>   
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="bg-white overflow-y-scroll shadow-sm sm:rounded-lg p-4 my-2 flex justify-between">
                <div class="flex-1 text-black font-bold text-xl my-auto">
                        Total
                </div>
                <div class="flex-1 my-auto text-center text-black text-xl font-bold">
                    {{$total}}
                </div>
                <div class="text-black flex-1 flex justify-end">
                    <form method="POST" enctype="multipart/form-data" action="{{route('cashier.transaction.checkout')}}">
                                @csrf
                                @method('post')
                                <div class="join">
                                    <input type="number" name="paid" placeholder="Jumlah uang" class="input form-control input-bordered max-w-32 form-input join-item bg-white text-center"/>
                                    <button type="submit" class="btn bg-accent border-none text-white rounded-l-none">
                                        Checkout
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
            @else
            <div class="bg-white overflow-y-scroll shadow-sm sm:rounded-lg p-4 my-2 flex justify-between">
                <h2 class="text-black text-xl text-center font-bold">
                    Anda belum melakukan transaksi apapun
                </h2>
            </div>
            @endif
            
        </div>
    </div>
</x-app-layout>
