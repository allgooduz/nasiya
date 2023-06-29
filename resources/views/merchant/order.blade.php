@extends('layouts.merchantapp')
    @section('content')
        <div class="content">
            <div class="sidebar_opener" style="margin-bottom: 10px;">
                <div class="for_sidebar">
                    <p>Sidebar</p>
                </div>
            </div>
            <section class="name_inner">
                <h2>{{ $order->name }} - №{{ $order->id }}</h2>
                <ul>
                    <!-- There should be a icon here instead of star -->
                    <li>⭐
                        @if ($order->status == '7')
                            <td class="holati"><span>Одобрено</span></td>
                        @elseif ($order->status == '-1')
                            <td class="holati">Отказано</td>
                        @elseif ($order->status == '0')
                            <td class="holati">Рассматривается</td>
                        @endif
                    </li>
                    <li>📱 {{ $order->phone_number }}</li>
                    {{--
                        <li>💲 Boshlang'ich to'lov: <span>0</span> so'm</li>
                    --}}
                </ul>
            </section>
            <ul class="application_top_filter">
                <li><a href="" class="act">О заявке
                </a></li>
            </ul>

            <section class="tavarlar scroller">

                <h3>Товары</h3>
                <table>
                    <thead>
                        <tr>
                            <th>НАИМЕНОВАНИЕ</th>
                            <th>ЦЕНА</th>
                            <th>КОЛ-ВО</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr>
                                <td>
                                    <h4>{{ $item->name }}</h4>
                                    {{-- <p>Ноутбуки</p> --}}
                                </td>
                                <td class="price_">{{ App\Helpers\Helper::formatPrice($item->total) }}</td>
                                <td class="number_">{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Общая сумма:</th>
                            <th>{{ App\Helpers\Helper::formatPrice($order->total) }}</th>
                            <th>{{ $totalNumber }}</th>
                        </tr>
                    </tfoot>
                </table>
            </section>
            {{--
            <section class="sharh_section">
                <h3>Sharhlar</h3>
                <div class="sharhlar">
                    <h4>Алиф Комплаенс</h4>
                    <p>rasmiy daromad yo'q / нет официального дохода</p>
                    <p>tahminan 5 soat oldin</p>
                </div>
                <div class="sharhlar">
                    <h4>Алиф Комплаенс</h4>
                    <p>rasmiy daromad yo'q / нет официального дохода</p>
                    <p>tahminan 5 soat oldin</p>
                </div>
            </section>
            --}}
        </div>
@endsection
