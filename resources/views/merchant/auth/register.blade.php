<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('assets/css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/arizalar.css') }}">
</head>
<body>

    <div class="registration_container">
        <section>
            <nav class="registration_navbar">

                <button>Hamkorlik</button>
                <select>
                    <option value="">Kunduzgi</option>
                    <option value="">Qorong'u</option>
                </select>
                <select>
                    <option value="">O'zbek tili</option>
                    <option value="">Rus tili</option>
                </select>

            </nav>

            <div class="registration_section_and_img">
                <div class="register">
                    <h3>Hisobingizga kiring</h3>
                    <p>yoki <a href=" ">Ro'yxatdan o'tish</a></p>
                    <form action="">
                        <div class="login">
                            <label for="login">Telefon raqam</label>
                            <!-- =====---- LOOKING NAME ----===== -->
                            <span>
                                <select name=" " id="login">
                                    <!-- LOOKING VALUE ----===== -->
                                    <option value="">(+998)</option>
                                    <option value="">(+992)</option>
                                </select>
                                <input type="text" id="login"  placeholder="(9*)-999-99-99">
                            </span>

                            <!-- =====---- FOR ERRORS ----===== -->
                            <p class="errors_form"></p>
                        </div>
                        <div class="password_sect">
                            <label for="password">Telefon raqam</label> <br>
                            <!-- =====---- LOOKING NAME ----=====  -->
                            <input name=" " value="" type="password" id="password" placeholder="**********">

                            <!-- =====---- FOR ERRORS ----=====  -->
                            <p class="errors_form">Testing</p>
                        </div>

                        <div class="requester">
                            <div class="flexed">
                                <input type="checkbox" class="main_checkbox" name="" id="remember"> <label for="remember">
                                Meni eslab qolish</label>
                            </div>

                            <div class="forgot">
                                <a href="./forgetpass.html">Parolni unutdingizmi?</a>
                            </div>
                        </div>
                        <button class="btn_enter">Kirish</button>
                        <!-- DELETE -->
                        <a href="./page_1_arizalar.html">(Next page - >)</a>
                    </form>
                </div>
                <div class="login_image">
                    <img src="{{ asset('assets/img/login.png') }}" alt="">
                </div>
            </div>
            <!-- FOOTER -->
            <div class="as_footer">
                <ul>
                    <li>
                        <h4>Savollaringiz bormi?</h4>
                        <p>+998 9* *** ** **</p>
                    </li>
                    <li>
                        <h4>Bizga qo'ng'iroq qiling:</h4>
                        <p>+998 9* *** ** **</p>
                    </li>
                </ul>
            </div>
        </section>
    </div>

</body>
</html>
