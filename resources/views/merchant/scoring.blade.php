@extends('layouts.merchantapp')
    @section('content')
        <div class="content">
            <div class="sidebar_opener">
                <h2>Скоринг</h2>
                <div class="for_sidebar">
                    <p>Sidebar</p>
                </div>
            </div>

            <div class="line"></div>

            <div class="container" style="margin-top: 30px;">
                <form action="{{ route('createUserCard') }}" method="GET">
                    @csrf 
                    @method('GET')
                
                    <div class="row form-group p-2 shadow border rounded mt-4">
                        <div class="col-md-4">
                            <h4 class="mb-3">Номер карты</h4>
                            <input type="text" class="form-control card-input-mask" id="card_number" placeholder="0000 0000 0000 0000" name="card_number" value="@if(session()->has('successCard')) {{ session()->get('successCard') }} @endif">
                            <span id="card_validation_text"></span>
                            <span id="card_validation_text2"></span>
                        </div>
                        <div class="col-md-2">
                            <h4 class="mb-3">Срок</h4>
                            <input type="text" class="form-control card-available-input-mask" id="expiry_date" placeholder="02/26" name="card_validation_date" value="@if(session()->has('successCardExpiry')) {{ session()->get('successCardExpiry') }} @endif">
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Номер телефона</h4>
                            <input type="text" class="form-control card-available-input-mask" placeholder="998901234567" name="phone_number" value="@if(session()->has('successPhoneNumber')) {{ session()->get('successPhoneNumber') }} @endif">
                        </div>
                        {{-- 
                            <div class="col-2">
                                <h4 class="mb-3">Сумма</h4>
                                <input type="text" class="form-control card-available-input-mask" placeholder="7000000" name="amount" value="@if(session()->has('successAmount')) {{ session()->get('successAmount') }} @endif">
                            </div>
                        --}}
                    </div>
                    @if (!empty(session()->has("askOtp")))
                    <div class="row">
                        <div class="col-4">
                            <h4 class="mb-3" class="mb-2">Код</h4>
                            <input type="text" class="form-control" placeholder="xxxxxx" name="otp">
                        </div>
                        <div class="col-8">
                            <h4 class="mb-2">Cообщение</h4>
                            <div class="alert alert-primary p-1" id="card_validation_ask_otp" role="alert">
                                {{ session()->get("askOtp") }}
                            </div>
                            {{--
                                <span style="color: #A80F4C;" id="card_validation_ask_otp" class="mt-3">
                                    {{ session()->get("askOtp") }}
                                </span>
                            --}}
                        </div>
                    </div>
                    @endif
                    @if (session()->has("errorCode"))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-primary p-1" id="card_validation_ask_otp" role="alert">
                                    <b>Код ошибки:</b> {{ session()->get("errorCode") }}: <br>
                                    <b>Текст ошибки:</b> {{ session()->get("errorMessage") }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-3">Результат</button>
                </form>
            </div>
            @if (session()->has('result'))
                @if(session()->has('resultFrom') && session()->get('resultFrom') == "UZCARD")
                    <div class="container" style="margin-top: 30px;">
                        <div class="row bg-white p-2 shadow rounded">
                            <div class="col-md-4 p-2 rounded">
                                <h4>Макс баллов</h4>
                                <span class="badge bg-success text-white" style="font-size: 20px;">{{ session()->get('maxPoint') }}</span>
                            </div>
                            <div class="col-md-4 p-2 rounded">
                                <h4>Балл клиента</h4>
                                <span class="badge bg-primary text-white" style="font-size: 20px;">{{ session()->get('clientsPoint') }}</span>
                            </div>
                            <div class="col-md-4 p-2 rounded">
                                @php
                                    $percentage = (session()->get('clientsPoint') / session()->get('maxPoint')) * 100;
                                    $percentage = (int)$percentage;
                                @endphp
                                <h4>В процентах</h4>
                                <span class="badge bg-info text-white" style="font-size: 20px;">{{ $percentage }}%</span>
                            </div>
                        </div>

                        <div class="row bg-white p-2 mt-2 shadow rounded">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Template name</th>
                                    <th scope="col">Category name</th>
                                    <th scope="col">Ball</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach (session()->get('listPoint') as $item)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $item->templateName }}</td>
                                            <td>{{ $item->categoryName }}</td>
                                            <td><b>{{ $item->ball }}</b></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else 
                    <div class="container" style="margin-top: 30px;">
                        <div class="row bg-white p-2 shadow rounded">
                            <div class="col-md-6 p-2 rounded">
                                <h4>Терминология</h4>
                                <p><b>totalDebitScore</b> - Балл общего расхода</p>
                                <p><b>totalDebitCount</b> - Количество транзакций по расходам</p>
                                <p><b>replenishmentScore</b> - Балл пополнения со счета</p>
                            </div>
                            <div class="col-md-6 p-2 rounded">
                                <br>
                                <p><b>replenishmentCount</b> - Количество пополнений карты со счета</p>
                                <p><b>creditScore</b> - Балл поступлений на карту (переводы, пополнения через АТМ)</p>
                                <p><b>creditCount</b> - Количество поступлений на карту (переводов, пополнений через АТМ)</p>
                            </div>
                        </div>
                        <div class="row bg-white p-2 mt-2 shadow rounded">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Месяц</th>
                                    <th scope="col">totalDebitScore</th>
                                    <th scope="col">totalDebitCount</th>
                                    <th scope="col">replenishmentScore</th>
                                    <th scope="col">replenishmentCount</th>
                                    <th scope="col">creditScore</th>
                                    <th scope="col">creditCount</th>
                                    <th scope="col">Общий балл</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach (session()->get('listPoint') as $item)
                                        <tr>
                                            @php
                                            $totalResult = $item->totalDebitScore + $item->totalDebitCount + $item->replenishmentScore + $item->replenishmentCount + $item->creditScore + $item->creditCount;
                                            @endphp
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->totalDebitScore }}</td>
                                            <td>{{ $item->totalDebitCount }}</td>
                                            <td>{{ $item->replenishmentScore }}</td>
                                            <td>{{ $item->replenishmentCount }}</td>
                                            <td>{{ $item->creditScore }}</td>
                                            <td>{{ $item->creditCount }}</td>
                                            <td><b>{{ $totalResult }}</b></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif
        </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#card_number').inputmask("9999 9999 9999 9999");
            $('#expiry_date').inputmask("99/99");
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        /*
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .box-1,
        .box-2,
        .box-3,
        .box-4 {
            width: calc(25% - 10px);
            height: 200px;
            background-color: #f2f2f2;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        */

        .header {
            margin: 0;
        }

        .content {
            margin: 0;
        }
    </style>
@endsection
