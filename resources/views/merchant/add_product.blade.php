@extends('layouts.merchantapp')
@section('content')
<div class="content">
    <div class="sidebar_opener" style="margin-bottom: 10px;">
        <div class="for_sidebar">
            <p>Sidebar</p>
        </div>
    </div>
    <section class="nav_top">
        <h2>Tovar haqida ma'lumotlar
        </h2>
        <div class="Sozlama">
            Sozlamalar ↙️
        </div>
        <div class="delete_tavarr">
            <a href="">O'chirish</a>
        </div>
    </section>
    <section>
        <form action="">
            <div class="f_form">
                <h3 class="about_shopify">Tovar haqida ma'lumotlar</h3>
                <div class="inps">
                    <br>
                    <label for="MXIK">MXIK</label> <br>
                    <input type="text" id="MXIK" name=""> <br>

                    <label for="Nomi">Nomi</label> <br>
                    <input type="text" id="Nomi" name=""> <br>

                    <label for="Narxi">Narxi</label> <br>
                    <input type="text" id="Narxi" name=""> <br>

                    <label for="SKU">SKU</label> <br>
                    <input type="text" id="SKU" name=""> <br>

                    <label for="Miqdor">Miqdor</label> <br>
                    <input type="text" id="Miqdor" name=""> <br>

                    <label for="Toifa">Toifa</label> <br>
                    <input type="text" id="Toifa" name=""> <br>

                </div>
                <div class="btns">
                    <button>Bekor qilish</button>
                    <button>Saqlash</button>
                </div>
            </div>

            <!-- Boshqa tovarni tanlang -->
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

        </form>
    </section>

</div>
@endsection
