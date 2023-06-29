@extends('layouts.merchantapp')
    @section('content')
        <div class="content">

            <section class="ombor_navbar">
                <div class="sidebar_opener" style="margin-bottom: 10px;">
                    <h2>Склад</h2>
                    <div class="for_sidebar">
                        <p>Sidebar</p>
                    </div>
                </div>
                <ul class="top_navbar">
                    <li class="activer_from_checkbox">
                        <button type="button" class="droper">
                            ✅
                            Выбранные товары
                        </button>
                        <!-- AFTER ACTIVED -->
                        <div class="dropdown-menu">
                            <button class="shadow-none dropdown-item" id="deleteButton" data-route="{{ route('product.delete') }}" type="button">Удалить</button>
                            <button class="shadow-none dropdown-item" id="activeButton" data-route="{{ route('product.update.active') }}" type="button">Выставить на продажу</button>
                            <button class="shadow-none dropdown-item" id="unactiveButton" data-route="{{ route('product.update.unactive') }}" type="button">Скрыть товары</button>
                        </div>
                    </li>
                    <li>
                        <form action="{{ route('excel.products') }}" id="products" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <label>
                                <input type="file" name="products" id="productExcel"/>
                                <i class="fa fa-file"></i> Продукция
                            </label>
                        </form>
                    </li>
                    <li>
                        <button class="download_chooser" id="productExcelButton" onclick="document.getElementById('products').submit();">
                            <i class="fa fa-download"></i> Загрузить
                        </button>
                    </li>
                    <li>
                        |
                    </li>
                    <li class="download_section">
                        <div class="download_chooser accepte_">
                            <i class="fa fa-file-text"></i> Экспорт
                        </div>
                        <div class="type_download">
                            <ul>
                                <li>
                                    <a href="javascript:;" onclick="document.getElementById('productsget').submit();">Скачать товары всех магазинов (excel)</a>
                                    <form action="{{ route('excelget.productsget') }}" id="productsget" method="post" enctype="multipart/form-data">
                                        @csrf
                                    </form>
                                </li>
                                {{--
                                    <li>
                                        <a href="javascript:;">Shablon yuklab olish (excel)</a>
                                    </li>
                                --}}
                            </ul>
                        </div>
                    </li>
                </ul>
            </section>


            <ul>
                <div class="inps_filter_in_sklad">
                    <input type="text" id="myInput" placeholder="Поиск...">
                    <div class="filter"><p>Фильтр</p></div>
                </div>

            </ul>
            {{--
                <div class="filtered_section">
                    <div class="dalolatnoma">
                        <label for="dalolatnoma_l">Dalolatnoma</label> <br>
                        <select name="" id="dalolatnoma_l">
                            <option value="">Hammasi</option>
                            <option value="">........</option>
                        </select>
                    </div>
                    <div class="manba">
                        <label for="manba_l">Manba</label> <br>
                        <select name="" id="manba_l">
                            <option value="">Hammasi</option>
                            <option value="">........</option>
                        </select>
                    </div>
                    <div class="sababi">
                        <label for="sababi_l">Bekor qilish sababi</label> <br>
                        <select name="" id="sababi_l">
                            <option value="">Hammasi</option>
                            <option value="">........</option>
                        </select>
                    </div>
                    <div class="rad">
                        <label for="rad_l">Rad etish sababi</label> <br>
                        <select name="" id="rad_l">
                            <option value="">Hammasi</option>
                            <option value="">........</option>
                        </select>
                    </div>
                </div>
            --}}
            <div class="table_section">
                <div class="assolute_section scroller">
                    <table class="table-fill">
                        <thead class="table_head">
                            <tr>
                                <th class="main">

                                        <input type="checkbox"  id="option-all" class="main_checkbox" onchange="checkAll(this)">

                                </th>
                                <th class="main">Имя</th>
                                <th class="main">Фамилия</th>
                                <th class="main">Номер</th>
                                <th class="main">Сумма Лимита</th>
                                <th class="main">Пол</th>
                                <th class="main">Статус</th>
                                <th class="main">Предыдущие покупки (кол-во раз)</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                                <form method="POST" id="productCheck" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="route" id="route" value="">
                                        <tr>
                                            <td style="text-align: center;"> 1 </td>
                                            <td style="text-align: center;"> Жасур </td>
                                            <td style="text-align: center;"> Рузикулов </td>
                                            <td style="text-align: center;"> +998993987700 </td>
                                            <td style="text-align: center;"> 10 млн </td>
                                            <td style="text-align: center;"> Муж </td>
                                            <td style="text-align: center;"> Регистрируется Зарегистрирован </td>
                                            <td style="text-align: center;"> </td>
                                        </tr>
                                </form>

                        </tbody>
                    </table>
                </div>
                {{--
                <div class="pagnigation pag">
                    <select name="" id="">
                        <option value="">10</option>
                        <option value="">65</option>
                        <option value="">150</option>
                        <option value="">200</option>
                    </select>
                    {{ $products->links() }}
                </div>
                --}}
                <div class="pagnigation pag">
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        /*
        function test() {
            console.log('test');
        }

        function setRouteAndSubmit(route) {
            console.log("working");
            setRoute(route);
            document.getElementById('productCheck').submit();
        }

        function setRoute(route) {
            console.log("working setRoute");
            document.getElementById('route').value = route;
            document.getElementById('productCheck').setAttribute('action', route);
        }*/

        $(function(){

            $('#deleteButton').click(function() {
                var route = $(this).data('route');
                setRouteAndSubmit(route);
            });

            $('#activeButton').click(function() {
                var route = $(this).data('route');
                setRouteAndSubmit(route);
            });

            $('#unactiveButton').click(function() {
                var route = $(this).data('route');
                setRouteAndSubmit(route);
            });

            function setRouteAndSubmit(route) {
                console.log("working");
                setRoute(route);
                $('#productCheck').submit();
            }

            function setRoute(route) {
                console.log("working setRoute");
                $('#route').val(route);
                $('#productCheck').attr('action', route);
            }

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $( function(){/*
            $("#productExcel").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#productExcelButton");
                    dvPreview.html("");
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "width: 150px; height:100px; padding: 10px");
                                img.attr("src", e.target.result);
                                dvPreview.removeClass("bg-danger");
                                dvPreview.addClass("bg-success text-white");
                                dvPreview.text("Some text");
                            }
                            reader.readAsDataURL(file[0]);
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });*/
        });
    </script>
@endsection
