@extends('layouts.merchantapp')
    @section('content')
        <div class="content">
            <div class="sidebar_opener">
                <h2>Заявки</h2>
                <div class="for_sidebar">
                    <p>Sidebar</p>
                </div>
            </div>

            <ul class="application_top_filter scroller">
                <li><a href="{{ route('clientorder.phone') }}">Создать заявку</a></li>
                <li><a href="{{ route('orders') }}">Все</a></li>
                <li><a href="{{ route('orders', ['filterStatus'=>'new']) }}" class="@if(str_contains(url()->current(), '/orders/0')) act @endif">Рассматривается</a></li>
                <li><a href="{{ route('orders', ['filterStatus'=>'accepted']) }}" class="@if(str_contains(url()->current(), '/orders/7')) act @endif">Одобрено</a></li>
                <li><a href="{{ route('orders', ['filterStatus'=>'denied']) }}" class="@if(str_contains(url()->current(), '/orders/-1')) act @endif">Отказано</a></li>
                {{--
                <li><a href=""><div>Rad etildi</div></a></li>
                <li><a href="">Rasmiylashtirildi</a></li>
                <li><a href=""><div>Bekor qilindi</div></a></li>
                <li><a href="">O'chirildi</a></li>
                --}}
            </ul>
            <div class="line"></div>

            <div class="inps_filter" style="margin-top:35px;">
                <input type="text" id="myInput" placeholder="Поиск...">
                <form action="{{ route("ordersByDate") }}" id="bydate" method="POST">
                    @csrf
                    @method('POST')
                    <input type="date" name="bydate" value="<?php if(!empty($date)){ echo $date; } ?>">
                </form>
                <div class="filter" onclick="document.getElementById('bydate').submit();"><p>Фильтр</p></div>
            </div>

            <div class="table_section">
                <div class="assolute_section scroller">
                    <table  class="table-fill">
                        <thead class="table_head">
                            <tr>
                                <th class="main">ID</th>
                                <th class="main">Клиент</th>
                                <th class="main">Партнёра</th>
                                <th class="main">Стоимость товара</th>
                                <th class="main">Предоплата</th>
                                <th class="main">Стоимость в рассрочку</th>
                                <th class="main">Статус</th>
                                <th class="main">Дата и время создания</th>
                                <th class="main">Дата и время обновлнеия</th>
                                <th class="main">Credit ID</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                                <tr>
                                    <!-- THIS IS MAIN ID LINK -->
                                    <td><a href="#}"> #23 </a></td>
                                    <td class="apper_name" style="text-align: center;">
                                        <h5>John Doe</h5>
                                    </td>
                                    <td class="holat_narxi">Origin</td>
                                    <td class="holati" style="text-align: center;">3 343 200 сум</td>
                                    <td class="holati" style="text-align: center;">1 342 200 сум</td>
                                    <td class="holati" style="text-align: center;">4 342 200 сум</td>
                                    <td class="holati" style="text-align: center;">Оплачено</td>
                                    <td class="holati" style="text-align: center;">2021-21-12 23:23:00</td>
                                    <td class="holati" style="text-align: center;">2021-21-12 23:23:00</td>
                                    <td class="holati" style="text-align: center;">2232</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagnigation">
                    {{ $orders->links() }}
                    {{--
                    <ul>
                        <!-- PREVIOUS -->
                        <li><a href=""> < </a></li>
                        <!-- ENDPREVIOUS -->

                        <!-- MAIN -->
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <!-- ENDMAIN -->

                        <!-- NEXT -->
                        <li><a href=""> > </a></li>
                        <!-- ENDPNEXT -->
                    </ul> --}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
