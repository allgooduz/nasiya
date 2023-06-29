@extends('layouts.merchantapp')
@section('content')
<div class="content">
    <div class="sidebar_opener">
        <h2>Новая заявка</h2>
        <div class="for_sidebar">
            <p>Sidebar</p>
        </div>
    </div>

    <div class="container_">
        <div class="table_section">
            <div class="assolute_section scroller">
                <table class="table-fill">
                    <tbody>
                        <tr>
                            <!-- THIS IS MAIN ID LINK -->
                            <td>
                                <a href="">
                                    Klient
                                </a>
                            </td>
                            <td class="apper_name">
                                <h5>Sadovnichiy Aleksandr Olegovich</h5>
                                <p>+998 (90) 999-82-55</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="creating_new_products" onclick="creating_new_products()">new product</div>
            <div class="poppup_exit_background" onclick="poppup_exit_background()"></div>
            <div class="poppup_new_products">
                <div class="form_section">
                    <form action="">
                        <h2>Some Text</h2>
                        <input type="text" placeholder="Some text">
                        <div class="btns_section">
                            <button onclick="closer_btn()" class="closer_btn">Close</button>
                            <button onclick="adder_btn()" class="adder_btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table_section mini_table">
                <div class="assolute_section scroller">
                    <table class="table-fill" style="max-width: 600px;">
                        <thead class="table_head">
                            <tr>
                                <th class="main">#</th>
                                <th class="main">Product</th>
                                <th class="main">Price</th>
                                <th class="main">setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- THIS IS MAIN ID LINK -->
                                <td><a href="./ID_application.html"> #1538972 </a></td>
                                <td class="apper_name">
                                    <h5 style="text-align: center;">Product</h5>
                                </td>
                                <td class="holat_narxi">21 420 000 so'm</td>
                                <td class="edit_delete">
                                    <button>Edit</button>
                                    <button>Delete</button>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="products_infos">
                <a href="#" class="products_link">Lorem, ipsum dolor.</a>
                <section class="info">
                    <div class="section_deadline">
                        <label for="deadline_product">Muddatli to'lov <span>oylik</span>
                        </label>
                        <br>
                        <select name="" id="deadline_product">
                            <option value="12">12</option>
                            <option value="">24</option>
                        </select>
                        <h3>Oyiga <span>10 000</span> so'm</h3>
                    </div>

                    <div class="section_prices">
                        <ul>
                            <li>
                                <p>Product</p>
                                <h3>100 000 000 sum</h3>
                                <div class="lineX"></div>
                            </li>
                            <li>
                                <p>Itogo</p>
                                <h3>100 000 000 sum</h3>
                                <div class="lineX"></div>
                            </li>
                            <li>
                                <p>Muddatli to'lov</p>
                                <h3>150 000 000 sum</h3>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        let poppup_new_products = document.querySelector(".poppup_new_products")
        let poppup_exit_background = document.querySelector(".poppup_exit_background")
        let creating_new_products = document.querySelector(".creating_new_products")

        creating_new_products.onclick = () => {
            poppup_exit_background.style.display = "flex"
            poppup_new_products.style.display = "flex"
        }
        poppup_exit_background.onclick = () => {
            poppup_exit_background.style.display = "none"
            poppup_new_products.style.display = "none"
        }

        function closer_btn() {
            poppup_exit_background.style.display = "none"
            poppup_new_products.style.display = "none"
        }
    </script>
@endsection
