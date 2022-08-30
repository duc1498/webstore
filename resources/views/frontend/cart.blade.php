@extends('frontend.sub-layouts.main')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ ucwords('Giỏ hàng') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Tên SP</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr class="shopping__list_{{ $item->id }}">
                                        <td class="shoping__cart__item">
                                            <img width="100"
                                                src="
                                        @if ($item->attributes->image && file_exists(public_path($item->attributes->imag))) {{ asset($item->attributes->image) }}
                                        @else
                                        {{ asset('upload/404.jpg') }} @endif
                                    "
                                                alt="">
                                            <h5>{{ $item->name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format($item->price, 0, ',', '.') }} đ
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $item->quantity }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close remove-from-cart" data-id="{{ $item->id }}"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        {{-- <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        {{-- <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Thanh toán</h5>
                        <ul>
                            <li>Tổng <span id="total">{{ number_format($total, 0, ',', '.') }} đ</span></li>
                            {{-- <li>VAT <span>10%</span></li> --}}
                        </ul>
                        <form action="{{ route('getPayment') }}" method="POST">
                            @csrf
                            <button type="submit" name="redirect" href="" class="primary-btn">THANH TOÁN
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".remove-from-cart", function(e) {
                var id = $(this).data("id");
                var token = "{{ csrf_token() }}";
                $.ajax({
                    url: "{{ route('cartRemove') }}",
                    method: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },

                    success: function(data) {
                        if (data.success) {
                            $(".shopping__list_" + id).empty().html(data);
                            const number = data.total;
                            const formated = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND'
                                }).format(
                                    number,
                                );
                                $("#total").text(formated )
                        } else {
                            console.log('Xoá không thành công');
                        }
                    },
                    error: function(xhr, status, error) {
                        // console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
