@extends('layouts.merchantapp')
@section('content')
<div class="content">
    <div class="sidebar_opener" style="margin-bottom: 10px;">
        <div class="for_sidebar">
            <p>Sidebar</p>
        </div>
    </div>
    <section class="nav_top">
        <h2>Данные о товаре
        </h2>
        {{--
        <div class="Sozlama">
            Sozlamalar ↙️
        </div>
        --}}
        <div class="delete_tavarr">
            <a href="">O'chirish</a>
        </div>
    </section>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="f_form">
                    <h3 class="about_shopify">Данные о товаре</h3>
                    <div class="inps">
                        <br>
                        {{--
                        <label for="MXIK">IKPU</label> <br>
                        <input type="text" id="MXIK" name=""> <br>
                        --}}

                        <label for="Nomi">Название</label> <br>
                        <input type="text" id="Nomi" name="name" value="{{ $product->name }}"> <br>

                        <label for="Narxi">Цена</label> <br>
                        <input type="text" id="Narxi" name="price" value="{{ $product->price }}"> <br>

                        <label for="SKU">SKU</label> <br>
                        <input type="text" id="SKU" name="sku" value="{{ $product->sku }}"> <br>

                        <label for="Miqdor">Количество</label> <br>
                        <input type="text" id="Miqdor" name="in_stock" value="{{ $product->in_stock }}"> <br>

                        <label for="Toifa">Категория</label> <br>
                        <select id="single" class="form-control" name="category" style="padding-top: 50px;">
                            @foreach ($categories as $item)
                                @if ($item->categorie_id)

                                @else

                                @endif
                                <option>{{ $item->name }}</option>
                            @endforeach
                        </select> <br>

                    </div>

                    <div class="inps shadow" id="photoDiv">
                        <hr>
                        <label for="Miqdor">Фотография</label> <br>
                        <input type="file" name="images[]" id="ImageMedias" multiple>
                        <div id="divImageMediaPreview">

                        </div>
                    </div>

                    <div class="btns">
                        <button type="button" id="photoDivButton">Закачать фото</button>
                        <button type="submit">Сохранить</button>
                    </div>
                </div>

                <!-- Boshqa tovarni tanlang -->
                {{--
                <div class="f_form">
                <h3 class="about_shopify">Boshqa tovarni tanlang</h3>
                <br>
                <div class="inps">
                    <label for="Mahsulot">Mahsulot nomi</label> <br>
                    <input type="text" id="Mahsulot" name=""> <br>

                <label for="Soni">Soni</label> <br>
                    <input type="text" id="Soni" name=""> <br>
                </div>

                    <div class="btns">
                        <button>Tavarni uzish</button>
                        <button>Tavarni ulash</button>
                    </div>
                </div>
                --}}

            </form>
        </div>
        @if (!empty($product_images))
            <div class="col-md-4">
                @foreach ($product_images as $item)
                    <img src="{{ $item }}" alt="image" class="img-fluid p-1">
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection


@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        select{
            border-color: red;
        }
    </style>
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#single").select2({
                placeholder: "Select a programming language",
                allowClear: true
            });

            $('#photoDiv').addClass('d-none');
            $('#photoDivButton').on('click', function(){
                $('#photoDiv').toggleClass('d-block d-none');
            });

            $("#ImageMedias").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#divImageMediaPreview");
                    dvPreview.html("");
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "width: 150px; height:100px; padding: 10px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script>
@endsection
