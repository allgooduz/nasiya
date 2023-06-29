<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('assetsmerchant/css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsmerchant/css/arizalar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

    <div class="registration_container">
        <section>
            <nav class="registration_navbar">

                {{--
                <a href="https://allgood.uz/seller/register_formxyz" target="_blank" class="btn btn-dark text-light">Стать партнером</a>


                <select>
                    <option value="">O'zbek tili</option>
                    <option value="">Русский язык</option>
                </select>
                --}}

            </nav>

            <div class="registration_section_and_img">
                <div class="register">
                    <h3>Войдите в свой аккаунт</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="login">
                            <label for="login">Номер телефона</label>
                            <!-- =====---- LOOKING NAME ----===== -->
                            <span>
                                <select>
                                    <!-- LOOKING VALUE ----===== -->
                                    <option value="">(+998)</option>
                                </select>
                                <input type="text" id="login" class="" name="phone_number" placeholder="901234567">
                            </span>
                        </div>
                        <div class="password">
                            <label for="password">Пароль</label> <br>
                            <!-- =====---- LOOKING NAME ----=====  -->
                            <input name="password" type="password" id="password" style="border: 1px solid var(--dark_border)!important;" placeholder="**********">
                        </div>
                        {{--
                        <div class="requester">
                            <div class="flexed">
                                <input type="checkbox" class="main_checkbox" name="" id="remember"> <label for="remember">
                                Qurilmani eslab qolish</label>
                            </div>

                            <div class="forgot">
                                <a href="./forgetpass.html">Parolni unutdingizmi?</a>
                            </div>
                        </div>
                        --}}
                        <button class="btn_enter" style="background-color: #F98329">Войти</button>
                    </form>
                </div>
                <div class="login_image">
                    <img src="{{ asset('assetsmerchant/img/laptopmain2.png') }}" width="700px" alt="">
                </div>
            </div>
            <!-- FOOTER -->
            <div class="as_footer">
                <ul>
                    <li>
                        <h4>Есть вопросы?</h4>
                        <p>+998 94 016 33 13</p>
                    </li>
                    <li>
                        <h4>Позвоните нам:</h4>
                        <p>+998 90 054 17 18</p>
                    </li>
                </ul>
            </div>
        </section>
    </div>

</body>
</html>
