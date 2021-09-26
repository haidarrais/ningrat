<div>
            <!-- Breadcrumb Area Start -->
            <div class="breadcrumb-area bg-12 text-center">
                <div class="container">
                    <h1>My Cart</h1>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Breadcrumb Area End -->
            <!-- Cart Area Start -->
            <div class="cart-area table-area pt-110 pb-95">
                <div class="container">
                    <div class="table-responsive">
                        @if (session()->has('message'))
                            <div class="alert alert-warning">
                                <strong>Gagal menambah pesanan</strong>
                                {{ session('message') }}
                            </div>
                        @endif
                        <table class="table product-table text-center">
                            <thead>
                                <tr>
                                    <th class="table-remove">remove</th>
                                    <th class="table-image">image</th>
                                    <th class="table-p-name">product</th>
                                    <th class="table-p-price">price</th>
                                    <th class="table-p-qty">quantity</th>
                                    <th class="table-total">total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success">
                                        <strong>Success </strong>{{Session::get('success_message')}}
                                    </div>
                                @endif
                                @if (Cart::count() >0)
                                @php
                                    $a = 0;
                                @endphp
                                    @foreach (Cart::content() as $item )
                                        <tr>
                                            <td class="table-remove"><button wire:click.prevert="destroyItem('{{$item->rowId}}')"><i class="fa fa-trash"></i></button></td>
                                            <td class="table-image"><a href="product-details.html"><img src="{{asset('upload/product/'. $item->options->stock->product->image)}}" alt=""></a></td>
                                            <td class="table-p-name"><a href="product-details.html">{{$item->name}}</a></td>
                                            <td class="table-p-price"><p>Rp.{{ number_format($item->price) }}</p></td>
                                            <td class="table-p-qty">
                                                <button wire:click.prevert="increaseQty('{{$item->rowId}}')">+</button>
                                                <input value="{{$item->qty}}" name="cart-qty" type="number" wire:model="itemQty.{{$item->rowId}}.qty" wire:change="show('{{$item->rowId}}')" max="{{$item->model->stock}}">
                                                <button wire:click.prevert="decreaseQty('{{$item->rowId}}')">-</button>
                                                <label for="cart-qty" class="label">Maks : {{$item->model->stock}}</label>
                                            </td>

                                            <td class="table-total">
                                                <p>Rp.{{ number_format($item->subtotal) }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                        <tr>
                                           <td colspan="6">
                                            @if (auth()->user() && auth()->user()->isCustomer())
                                            <a href="{{route('member.showc')}}" class="p-cart-btn btn">Go Shopping</a>
                                            @elseif (auth()->user() && auth()->user()->isReseller())
                                            <a href="{{route('member.showr')}}" class="p-cart-btn btn">Go Shopping</a>
                                            @endif
                                           </td>
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="table-bottom-wrapper">

                    </div>
                </div>
                <div class="container">
                    <div class="table-total-wrapper d-flex justify-content-end pt-60">
                        <div class="table-total-content">
                            <h2>Cart totals</h2>
                            <div class="table-total-amount">
                                <div class="single-total-content d-flex justify-content-between">
                                    <span>Subtotal</span>
                                    <span class="c-total-price">Rp.{{Cart::subtotal()}}</span>
                                </div>
                                <div class="single-total-content d-flex justify-content-end">
                                    <a href="#">Calculate shipping</a>
                                </div>
                                <div class="single-total-content d-flex justify-content-between">
                                    <span>Total</span>
                                    <span class="c-total-price">Rp.{{Cart::subtotal(2,'.','')}}</span>
                                </div>
                                @if (Auth::user()->isCustomer())
                                <a class="btn btn-default" href="{{route('checkout.customer')}}">Checkout</a>
                                @else
                                <a class="btn btn-default" href="{{route('checkout.reseller')}}">Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart Area End -->
            <script>
                $(function () {
                $("inputqty").keydown(function () {
                    // Save old value.
                    $(this).data("old", $(this).val());
                });
                $("inputqty").keyup(function () {
                    // Check correct, else revert back to old value.
                    if (parseInt($(this).val()) <= 99 && parseInt($(this).val()) >= 0)
                    ;
                    else
                    $(this).val($(this).data("old"));
                });
                });
            </script>
</div>
