﻿<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Чёрная пятница - Юлия Власова">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Чёрная пятница - Юлия Власова</title>
    <link href="images/favicon-1.ico" rel="shortcut icon" type="image/x-icon" />

    <link rel="stylesheet" href="style/normalize.css" type="text/css" />
    <link rel="stylesheet" href="style/main.css" type="text/css" />
    <link rel="stylesheet" href="style/suisse-intl-font.css" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=block" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/popup.js" type="text/javascript"></script>
    <script src="js/form.js" type="text/javascript"></script>
    <script src="js/mobile-menu.js" type="text/javascript"></script>
</head>

<body>
    <?php
        // define variables and set to empty values
        $nameErr = $siteErr = $telErr = $checkboxErr = "";
        $name = $site = $tel = $checkbox = "";
        $send = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Имя обязательно";
                $send = false;
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $nameErr = "Допустимы только буквы и пробелы";
                    $send = false;
                } else {
                    $nameErr = "";
                    $send = true;
                }
            }
            
            if (empty($_POST["tel"])) {
                $telErr = "Телефон обязателен";
                $send = false;
            } else {
                $tel = test_input($_POST["tel"]);
                // check if tel number is well-formed
                if (!preg_match("/\+7 (\d\d\d) \d\d\d-\d\d-\d\d/",$tel)) {
                    $telErr = "Неверный номер";
                    $send = false;
                } else {
                    $telErr = "";
                    $send = true;
                }
            } 
                
            if (empty($_POST["site"])) {
                $site = "";
            } else {
                $site = test_input($_POST["site"]);
                // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site)) {
                    $siteErr = "Неверный URL";
                    $send = false;
                } else {
                    $siteErr = "";
                    $send = true;
                }
            }

            if (empty($_POST["checkbox"])) {
                $checkboxErr = "Поле должно быть отмечено";
                $send = false;
            } else {
                $checkbox = test_input($_POST["checkbox"]);
                $send = true;
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
    <div id="results">
        <svg class="results__close">
            <use xlink:href="#close-popup"></use>
        </svg>
        <h2>Регистрация прошла успешно</h2>
        <p>На ваш телефон должен прийти номер</p>
    </div>
    <?php } ?>

    <div class="popup-overlay">
        <div class="popup-window relative">
            <svg class="popup-window__close">
                <use xlink:href="#close-popup"></use>
            </svg>
            <div class="popup-form">
                <div class="popup-form__title">Регистрация</div>
                <div class="popup-form__form">
                    <form id="register-form" class="register-form" method="POST"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="register-form__group">
                            <div class="register-form__container">
                                <input id="register-form-name" class="register-form__field" type="text" name="name"
                                    placeholder="Имя" value="<?php echo $name;?>">
                            </div>

                            <div class="hidden">
                                <span class="register-form__help-block"></span>
                            </div>
                        </div>

                        <div class="register-form__group">
                            <div class="register-form__container">
                                <input id="register-form-site" class="register-form__field" name="site"
                                    placeholder="Сайт компании" value="<?php echo $site;?>" type="url">
                            </div>
                            <div class="hidden">
                                <span class="register-form__help-block"></span>
                            </div>
                        </div>

                        <div class="register-form__group">
                            <div class="register-form__container">
                                <input id="register-form-tel" class="register-form__field" name="tel"
                                    placeholder="Телефон" value="<?php echo $tel;?>" type="tel">
                            </div>
                            <div class="hidden">
                                <span class="register-form__help-block"></span>
                            </div>
                        </div>

                        <input type="submit" name="submit"
                            class="register-form__button r-button register-form__button_disabled" value="Получить код"
                            id="register-form-button">

                        <label for="register-form-input" class="register-form-agree">
                            <input type="checkbox" id="register-form-input" name="agreement"
                                value="<?php echo $checkbox;?>" class="register-form-agree__checkbox">
                            <span class="register-form-agree__checkmark"></span>
                            <span class="register-form-agree__text">
                                Отправляя сведения через электронную форму, вы даете согласие на обработку персональных
                                данных, в том числе сбор, хранение и передачу третьим лицам представленной вами
                                информации на условиях <a class="register-form-agree__link" href="#">Политики обработки
                                    персональных данных</a>.
                            </span>
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="r-wrapper">
        <nav>
            <a href="#">
                <!-- Тут обычно стоит ссылка на домашнюю страницу -->
                <svg class="r-logo">
                    <use xlink:href="#logo"></use>
                </svg>
            </a>

            <div class="nav-buttons">
                <a href="#" class="nav-buttons__link nav-buttons__link_active">Наши предложения</a>
                <a href="#" class="nav-buttons__link">Цены</a>
            </div>
            <svg class="nav-mobile-burger">
                <use xlink:href="#nav-mobile-burger"></use>
            </svg>
            <svg class="nav-mobile-menu-close">
                <use xlink:href="#close-popup"></use>
            </svg>
        </nav>
        <main>
            <div class="main-title-container">
                <svg class="pink-line">
                    <use xlink:href="#pink-line"></use>
                </svg>
                <svg class="violet-line">
                    <use xlink:href="#violet-line"></use>
                </svg>
                <h1 class="main-title">
                    <span class="main-title__top">черная</span>
                    <span class="main-title__bottom">пятница</span>
                </h1>
                <svg class="sale-label">
                    <use xlink:href="#sale-label"></use>
                </svg>
            </div>

            <div class="button-block">
                <div class="button-block__text">
                    Воспользуйтесь выгодными предложениями от Roistat в ноябре*
                </div>
                <div class="button-block__button r-button popup-opener">
                    <span>
                        Получить выгоду
                    </span>
                    <svg class="arrow-right">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </div>
            </div>
        </main>
        <div class="main-ellipse"></div>
        <svg class="star">
            <use xlink:href="#star"></use>
        </svg>

        <img src="images/ribbon-yellow@2x.png" width="1440" height="241" alt="" class="ribbon-yellow">
        <img src="images/ribbon-viola@2x.png" width="1440" height="482" alt="" class="ribbon-viola">

        <div class="info-block_mobile">
            *Акция не распространяется на подключение опций, лимитов, которые были подключены ранее до 1.11.2023
            Количество предложений ограничено
        </div>
    </div>


    <svg width="0" height="0" class="hidden">
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112 48" fill="none" id="logo">
            <mask id="mask0_832_28" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="10" width="111"
                height="26">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.8889H110.25V35.3889H0V10.8889Z" fill="white" />
            </mask>
            <g mask="url(#mask0_832_28)">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.42649 22.6653C10.0414 22.6653 11.7152 22.2256 12.9359 21.2441C14.0166 20.3641 14.5394 19.1799 14.5394 17.7249C14.5394 15.9311 13.738 14.7131 12.4829 13.9009C11.1225 13.0209 9.44925 12.7844 6.62501 12.7844H2.12749L2.12695 22.6653H7.42649ZM0.000536826 10.8889L6.76454 10.8894C9.69346 10.8894 11.9599 11.2281 13.7384 12.345C15.4466 13.4276 16.6668 15.187 16.6668 17.6236C16.6674 19.857 15.6211 21.6841 14.0171 22.8005C12.8666 23.6133 11.5069 24.0191 9.93771 24.2562L18.375 35.3884L15.795 35.3889L7.56602 24.4249H2.12744L2.1269 35.3884H0L0.000536826 10.8889Z"
                    fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M42.8754 18.5452H44.4062L44.4059 35.3889H42.875L42.8754 18.5452Z" fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M50.9518 31.9152C52.8108 33.0292 55.195 33.6195 57.474 33.6195C60.3846 33.6195 62.2436 32.669 62.2441 30.7356C62.2436 28.3109 59.368 28.0485 56.6684 27.655C53.7929 27.2291 50.5312 26.4426 50.5312 23.1657C50.5318 20.1178 53.3015 18.5452 57.2294 18.5452C59.4733 18.5452 61.7533 19.0694 63.4368 19.9215L63.4362 21.9533C61.6129 20.8721 59.2983 20.3151 57.1597 20.3151C54.4591 20.3151 52.6007 21.1995 52.6002 23.035C52.6007 25.2958 55.4061 25.5253 58.0004 25.9189C61.1216 26.3775 64.3125 27.1636 64.3125 30.5717C64.3125 33.7507 61.5422 35.3889 57.3692 35.3889C55.0897 35.3889 52.7049 34.897 50.9518 33.9798V31.9152Z"
                    fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M70.699 29.494L70.6995 20.5374H67.375L67.3755 18.8247H70.6995V14.2805L72.7007 13.9514V18.8252H78.0938V20.5374H72.7007V29.165C72.7007 31.6016 73.073 33.6104 75.7192 33.6109C76.6007 33.6104 77.4488 33.3802 78.0938 33.0177L78.0932 34.8621C77.4488 35.1582 76.4654 35.3889 75.4476 35.3889C74.2266 35.3889 72.8359 35.0594 71.886 34.0053C71.0379 33.0506 70.699 31.6016 70.699 29.494Z"
                    fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M91.8261 31.7583V28.1282C90.5743 27.7687 89.1259 27.5396 87.8082 27.5396C85.5035 27.5396 83.1323 28.2586 83.1328 30.6465C83.1323 32.7397 84.9432 33.6552 86.919 33.6557C88.7634 33.6557 90.5414 32.8707 91.8261 31.7583ZM82.8354 34.2766C81.7819 33.492 81.1562 32.3147 81.1562 30.8101C81.1562 29.1091 81.9466 27.8991 83.1979 27.0813C84.4167 26.2968 86.0629 26.0027 87.6436 26.0022C89.1256 26.0022 90.4752 26.2314 91.8258 26.5914V24.7273C91.8258 23.1572 91.5292 22.1435 90.6404 21.3585C89.8825 20.7044 88.7636 20.3444 87.3141 20.3444C85.4048 20.3444 83.6592 20.9657 82.3421 21.9144V19.9848C83.6592 19.1665 85.4702 18.5457 87.5123 18.5452C89.4551 18.5457 91.0354 19.0361 92.1224 19.9521C93.2083 20.868 93.7685 22.3067 93.7685 24.2695V31.2356C93.768 32.6093 94.0971 33.6235 95.4147 33.623C95.8097 33.623 96.1722 33.5253 96.4688 33.3616L96.4682 35.0299C96.1063 35.193 95.6125 35.2912 95.0522 35.2912C93.6692 35.2912 92.5827 34.6371 92.1219 33.3939H92.0559C90.8377 34.4407 88.8619 35.3889 86.6555 35.3889C85.2725 35.3889 83.8894 35.0621 82.8354 34.2766Z"
                    fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M102.855 29.4945L102.856 20.5374H99.5312L99.5318 18.8252H102.856V14.281L104.857 13.9514V18.8252H110.25V20.5374H104.857V29.165C104.857 31.6021 105.229 33.6109 107.875 33.6109C108.757 33.6109 109.605 33.3802 110.25 33.0182L110.249 34.8621C109.605 35.1587 108.622 35.3889 107.604 35.3889C106.383 35.3889 104.992 35.0599 104.042 34.0058C103.194 33.0511 102.855 31.6021 102.855 29.4945Z"
                    fill="white" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M32.4409 24.5718C32.9102 25.2463 33.1848 26.0707 33.1848 26.9673C33.1848 29.2614 31.4079 31.0964 29.094 31.0964C26.7807 31.0964 25.0032 29.2609 25.0032 26.9673C25.0032 24.6737 26.7807 22.8382 29.0945 22.8382C30.1265 22.8382 31.0501 23.2055 31.7584 23.814L34.7656 20.2555C33.2276 19.1778 31.2772 18.5457 29.0945 18.5452C23.8298 18.5452 19.9068 22.2156 19.9062 26.9673C19.9062 31.719 23.8298 35.3889 29.094 35.3889C34.3582 35.3894 38.2812 31.7195 38.2812 26.9678C38.2812 24.9936 37.6029 23.208 36.4341 21.7928L32.4409 24.5718Z"
                    fill="#2589FF" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M43.5456 15.4827L47.4688 12.5251C46.999 11.9086 46.4486 11.3588 45.8293 10.8889L42.875 14.6756C43.1291 14.9119 43.3533 15.1836 43.5456 15.4827Z"
                    fill="#2589FF" />
            </g>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 318" fill="none" id="violet-line">
            <circle cx="3" cy="315" r="3" fill="#151515" />
            <path
                d="M2.00002 315C2.00002 315.552 2.44773 316 3.00002 316C3.5523 316 4.00002 315.552 4.00002 315H2.00002ZM4.00002 315L4 -62L2 -62L2.00002 315H4.00002Z"
                fill="#8F8FFF" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 216" fill="none" id="pink-line">
            <circle cx="3" cy="213" r="3" fill="#151515" />
            <path
                d="M2.00002 213C2.00002 213.552 2.44773 214 3.00002 214C3.5523 214 4.00002 213.552 4.00002 213H2.00002ZM4.00002 213L4 -164L2 -164L2.00002 213H4.00002Z"
                fill="#FE64FA" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 327 333" fill="none" id="star">
            <path
                d="M219.902 194.299L309.186 167.433L209.436 152.555L232.053 42.2781L168.06 124.184L88.1461 27.8374L128.543 146.332L17.5679 161.979L136.145 200.251L107.681 323.193L181.679 220.774L255.291 289.224L219.902 194.299Z"
                stroke="white" stroke-width="23.9667" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 16" fill="none" id="arrow-right">
            <path d="M4 8L22 8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M16 1L23 8L16 15" stroke="white" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 189 138" fill="none" id="sale-label">
            <rect y="97.9536" width="187" height="46" rx="23" transform="rotate(-29.4544 0 97.9536)" fill="#FFEB1C" />
            <path
                d="M57.96 95.1644L63.4352 92.0724C63.664 92.3474 63.9737 92.5216 64.3643 92.595C64.7471 92.6545 65.2037 92.6172 65.7343 92.4829C66.257 92.3347 66.8387 92.0797 67.4796 91.7178C68.3155 91.2457 68.9162 90.7963 69.2815 90.3695C69.6608 89.9348 69.7442 89.5293 69.5318 89.1532C69.3902 88.9024 69.1398 88.7682 68.7807 88.7505C68.4137 88.7188 67.8035 88.9073 66.95 89.3157L64.2642 90.6119C61.8232 91.7883 59.8403 92.2466 58.3154 91.9869C56.7906 91.7271 55.6348 90.9006 54.848 89.5074C54.1872 88.3371 53.9708 87.1731 54.1989 86.0152C54.4271 84.8574 55.0301 83.7451 56.0079 82.6784C56.9997 81.6038 58.3037 80.6102 59.9198 79.6975C61.4941 78.8085 63.0132 78.2446 64.477 78.006C65.9469 77.7455 67.2614 77.8117 68.4203 78.2046C69.5933 78.5896 70.5135 79.2918 71.1811 80.3113L65.7059 83.4033C65.5225 83.1761 65.2612 83.0389 64.9221 82.9915C64.5969 82.9363 64.1978 82.9779 63.7247 83.1164C63.2517 83.2549 62.7156 83.4933 62.1166 83.8316C61.3503 84.2644 60.7875 84.6832 60.4283 85.0883C60.0829 85.4854 60.0086 85.8581 60.2053 86.2064C60.339 86.4433 60.5785 86.5745 60.9237 86.6C61.2828 86.6177 61.8473 86.446 62.6172 86.0847L65.6491 84.6206C67.2367 83.8526 68.6064 83.3823 69.7584 83.2095C70.9024 83.0228 71.8674 83.121 72.6534 83.504C73.4533 83.8792 74.1128 84.5265 74.6321 85.446C75.2851 86.6024 75.5142 87.8052 75.3193 89.0545C75.1244 90.3038 74.5447 91.5224 73.5801 92.7102C72.6216 93.8763 71.3204 94.9235 69.6764 95.8519C67.9767 96.8117 66.3562 97.4237 64.8148 97.6878C63.2734 97.9519 61.9045 97.8705 60.708 97.4437C59.5254 97.009 58.6094 96.2492 57.96 95.1644ZM81.6449 85.124L79.2256 80.8399L89.9044 74.8093L92.3237 79.0934L81.6449 85.124ZM83.3087 66.9854L99.0352 78.7762L93.2883 82.0216L80.3699 71.7871L81.7492 71.0082L83.8424 87.3559L78.0955 90.6013L76.1198 71.0452L83.3087 66.9854ZM97.3958 59.0301L104.902 72.3212L101.108 71.266L112.77 64.6807L115.484 69.4873L100.855 77.7483L92.0041 62.0749L97.3958 59.0301ZM126.314 50.5825L128.414 54.3023L116.607 60.9702L114.506 57.2503L126.314 50.5825ZM119.256 57.0214L121.587 63.3948L118.264 62.2943L130.155 55.5793L132.563 59.8424L117.391 68.4104L114.115 59.9246L108.54 52.7369L123.607 44.228L126.015 48.4912L114.228 55.1472L115.002 51.7337L119.256 57.0214Z"
                fill="#151515" />
            <circle cx="163" cy="31" r="3" fill="#151515" />
            <circle cx="182" cy="5" r="3" fill="#151515" />
            <path
                d="M182.389 3.59114C185.892 6.45234 188.21 10.7144 188.832 15.4398C189.455 20.1651 188.331 24.9667 185.708 28.7882C183.085 32.6096 179.178 35.138 174.847 35.817C170.515 36.496 166.114 35.2701 162.611 32.4089L163.923 30.4964C166.961 32.9779 170.779 34.0411 174.535 33.4522C178.292 32.8633 181.68 30.6705 183.955 27.3563C186.23 24.042 187.204 19.8778 186.665 15.7796C186.125 11.6814 184.115 7.98502 181.077 5.50358L182.389 3.59114Z"
                fill="white" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" id="close-popup">
            <path
                d="M22.0014 8L16 14L10 8L8 10L14 16L8 22L10 24L16 18L22.0014 24L24.0014 22L18.0014 16L24.0014 10L22.0014 8Z"
                fill="#F0F0F0" />
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" id="nav-mobile-burger">
            <path d="M15 19H47" stroke="#E0EAFF" stroke-width="2" stroke-linecap="round" />
            <path d="M31 29H47" stroke="#E0EAFF" stroke-width="2" stroke-linecap="round" />
        </symbol>
    </svg>
</body>

</html>