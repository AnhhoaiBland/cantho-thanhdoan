<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap");







    ::-webkit-scrollbar {
        width: 1rem;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 1rem;
        background: #797979;
        transition: all 0.5s ease-in-out;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #222224;
    }

    ::-webkit-scrollbar-track {
        background: #f9f9f9;
    }



    .container-doitac {
        max-width: 100rem;
        padding: 0 1rem;
        margin: 0 auto;
    }

    .text-center {
        text-align: center;
    }

    .section-heading-doitac {
        font-size: 1rem;
        color: var(--primary);
        padding: 2rem 0;
    }

    #tranding {
        padding-top: 3rem;
    }

    @media (max-width:1440px) {
        #tranding {
            padding-top: 1rem;
        }
    }

    #tranding .tranding-slider {
        height: 52rem;
        padding-top: 1rem;
        position: relative;
    }

    @media (max-width:500px) {
        #tranding .tranding-slider {
            height: 400rem;
        }
    }

    .tranding-slide {
        width: 35rem;
        height: 42rem;
        position: relative;
        overflow: hidden;
        border-radius: 2rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2), 0 20px 40px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease-in-out;
    }

    .tranding-slide:hover {
        transform: scale(1.05);
        /* Slightly enlarge the slide */
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.3), 0 30px 60px rgba(0, 0, 0, 0.5);
    }

    @media (max-width:500px) {
        .tranding-slide {
            width: 28rem !important;
            height: 36rem !important;
        }

        .tranding-slide .tranding-slide-img-doitac img {
            width: 28rem !important;
            height: 36rem !important;

        }
    }

    .tranding-slide .tranding-slide-img-doitac img {
        width: 40rem;
        height: 45rem;
        border-radius: 2rem;
        transition: all 0.3s ease;
        object-fit: cover;

    }

    .tranding-slide:hover .tranding-slide-img-doitac img {
        filter: brightness(0.5);
        border-radius: 2rem;
    }

    .tranding-slide .tranding-slide-content {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
    }

    .tranding-slide-content .food-price {
        position: absolute;
        top: 2rem;
        right: 2rem;
        color: var(--white);
    }

    .tranding-slide-content .tranding-slide-content-bottom {
        position: absolute;
        bottom: 2rem;
        left: 2rem;
        color: var(--white);
    }

    .food-rating {
        padding-top: 1rem;
        display: flex;
        gap: 1rem;
    }

    .rating ion-icon {
        color: var(--primary);
    }

    .swiper-slide-shadow-left,
    .swiper-slide-shadow-right {
        display: none;
    }

    .tranding-slider-control {
        position: relative;
        bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tranding-slider-control .swiper-button-next {
        left: 58% !important;
        transform: translateX(-58%) !important;
    }

    @media (max-width:990px) {
        .tranding-slider-control .swiper-button-next {
            left: 70% !important;
            transform: translateX(-70%) !important;
        }
    }

    @media (max-width:450px) {
        .tranding-slider-control .swiper-button-next {
            left: 80% !important;
            transform: translateX(-80%) !important;
        }
    }

    @media (max-width:990px) {
        .tranding-slider-control .swiper-button-prev {
            left: 30% !important;
            transform: translateX(-30%) !important;
        }
    }

    @media (max-width:450px) {
        .tranding-slider-control .swiper-button-prev {
            left: 20% !important;
            transform: translateX(-20%) !important;
        }
    }

    .tranding-slider-control .slider-arrow {
        background: var(--white);
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 50%;
        left: 42%;
        transform: translateX(-42%);
        filter: drop-shadow(0px 8px 24px rgba(18, 28, 53, 0.1));
    }

    .tranding-slider-control .slider-arrow ion-icon {
        font-size: 2rem;
        color: #222224;
    }

    .tranding-slider-control .slider-arrow::after {
        content: '';
    }

    .tranding-slider-control .swiper-pagination {
        position: relative;
        width: 15rem;
        bottom: 1rem;
    }

    .tranding-slider-control .swiper-pagination .swiper-pagination-bullet {
        filter: drop-shadow(0px 8px 24px rgba(18, 28, 53, 0.1));
    }

    .tranding-slider-control .swiper-pagination .swiper-pagination-bullet-active {
        background: var(--primary);
    }

    .tranding-slide-content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        background: rgba(1, 1, 50, 0.2);
        color: #fff;
        text-align: center;
        transition: opacity 0.3s ease;
        border-radius: 2rem;
    }

    .tranding-slide:hover .tranding-slide-content {
        opacity: 1;
    }
    </style>

</head>

<body>
    <section id="tranding">

        <h3 class="title-dv">CÁC ĐỐI TÁC</h3>

        <div class="container-doitac">
            <div class="swiper tranding-slider">
                <div class="swiper-wrapper">
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/1.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">
                                <p>Description or details about the partner.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/2.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/3.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/4.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/5.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/6.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">

                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                    <!-- Slide-start -->
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img-doitac">
                            <img src="public/media/images/7.png" alt="Tranding">
                        </div>
                        <div class="tranding-slide-content">

                            <div class="tranding-slide-content-bottom">


                            </div>
                        </div>
                    </div>
                    <!-- Slide-end -->
                </div>

                <div class="tranding-slider-control">
                    <!-- <div class="swiper-button-prev slider-arrow">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </div>
                    <div class="swiper-button-next slider-arrow">
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </div> -->
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
    var TrandingSlider = new Swiper('.tranding-slider', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2.5,
        },
        autoplay: {
            delay: 1000, // Delay of 0.5 seconds (500 milliseconds)
            disableOnInteraction: false, // Continue autoplay even after user interactions
            pauseOnMouseEnter: true, // Pause autoplay when hovered
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });
    </script>
</body>