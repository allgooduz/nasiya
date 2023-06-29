@extends('layouts.merchantapp')
    @section('content')
        <div class="content">
            <div class="sidebar_opener">
                <h2>Финансы</h2>
                <div class="for_sidebar">
                    <p>Sidebar</p>
                </div>
            </div>

            <div class="line"></div>

            <div class="container" style="margin-top: 30px;">
                <div class="box-1">
                  <h4 class="header">Оборот:</h4>
                  <p class="content">{{ App\Helpers\Helper::formatPrice($revenue) }}</p>
                </div>
                <div class="box-2">
                  <h4 class="header">Комиссия:</h4>
                  <p class="content">{{ App\Helpers\Helper::formatPrice($percentage) }}</p>
                </div>
                <div class="box-3">
                  <h4 class="header">Прибыль:</h4>
                  <p class="content">{{ App\Helpers\Helper::formatPrice($profit) }}</p>
                </div>
                <div class="box-4">
                  <h4 class="header">Количество заказов:</h4>
                  <p class="content">{{ $ordersCount }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
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

        .header {
            margin: 0;
        }

        .content {
            margin: 0;
        }
    </style>
@endsection
