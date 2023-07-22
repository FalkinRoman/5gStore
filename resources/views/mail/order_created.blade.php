<p>Уважаемый {{ $name }}</p>

<p>Ваш заказ на сумму {{ $fullSum}} создан</p>

<table>
    <tbody>
        @foreach($order->products as $product)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div style="margin-left: 10px">
                                    <h6 class="my-0">{{ $product->name }}</h6>
                                    <small class="text-muted">{{ $product->description }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex ml-3">

                                        <div style="background-color: darkgrey; width: 30px;"
                                             class="d-flex ml-2 rounded-circle align-items-center justify-content-center text-white">{{ $product->pivot->count }}</div>
                                    </div>
                                    <div style="width: 90px; margin-left: 10px" class="d-flex ml-3 flex-column ">
                                        <span class="text-muted">Цена:</span>
                                        <span class="font-weight-bold">{{ $product->price }} руб.</span>
                                    </div>
                                    <div style="width: 100px;" class="d-flex ml-3 flex-column">
                                        <span class="text-muted">Стоимость:</span>
                                        <span class="font-weight-bold">{{ $product->getPriceForCount() }} руб.</span>
                                    </div>
                                </div>
                            </li>
        @endforeach
    </tbody>
</table>
