<style>
.banner {
    position: relative;
    /* Đặt vị trí tương đối cho phần banner */
    max-height: 695px;
    overflow: hidden;
    /* Ẩn phần dư thừa nếu có */
}

.banner img {
    width: 100%;
    height: auto;
    /* Giữ tỷ lệ của ảnh */
    object-fit: cover;
    /* Điều chỉnh ảnh để phù hợp với khung */
    object-position: center;
    /* Căn giữa ảnh */
}

.banner-video {
    position: absolute;
    /* Đặt video ở vị trí tuyệt đối */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Để video chiếm toàn bộ banner */
    object-fit: cover;
    /* Điều chỉnh video để phù hợp với khung */
    z-index: 1;
    /* Đảm bảo video nằm dưới ảnh */
    opacity: 0.5;
    /* Đặt độ mờ cho video */
}
</style>

<!-- Banner tĩnh -->
<div class="banner" id="banner">
    <video class="banner-video" autoplay muted loop>
    <source src="/public/upload/media/videos/bg-demo.mp4" type="video/mp4">
    </video>
  
</div>







<!-- HTML cho khu vực banner -->
<div id="banner"></div>

<!-- Yêu cầu Bootstrap CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* CSS cho banner */
    #banner {
        position: relative;
        max-width: 100%;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .carousel-inner {
        border-radius: 10px;
    }

    .carousel-item img {
        max-height: 100rem;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .carousel-item {
        margin-right: 5px;
    }

    .carousel-item:hover img {
        transform: scale(1.05);
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #666;
    }

    .carousel-indicators .active {
        background-color: #fff;
    }

    /* CSS cho nút next và prev thêm vào */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
    }
    
    .custom-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .custom-button:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
</style>

<script>
    const banner = document.getElementById('banner');

    // Lấy dữ liệu từ AJAX và tạo slide cho các ảnh
    $.ajax({
        url: 'home/ajax_getpaneltop',
        type: 'get',
        dataType: 'JSON',
        success: function(result) {
            if (result.length > 0) {
                let bannerHTML = '<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"><div class="carousel-inner">';

                result.forEach((element, index) => {
                    bannerHTML += `
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            ${element.urlBaiViet ? `
                                <a href="${element.urlBaiViet}">
                                    <img src="upload/media/images/${element.imageURL}" class="d-block w-100" alt="Banner Image">
                                </a>
                            ` : `
                                <img src="upload/media/images/${element.imageURL}" class="d-block w-100" alt="Banner Image">
                            `}
                        </div>
                    `;
                });

                bannerHTML += `
                    </div>
                    <div class="carousel-indicators">
                        ${result.map((_, index) => `
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="${index}" class="${index === 0 ? 'active' : ''}" aria-current="${index === 0 ? 'true' : 'false'}" aria-label="Slide ${index + 1}"></button>
                        `).join('')}
                    </div>
                </div>`;

                banner.innerHTML = bannerHTML;

                // Thêm sự kiện cho các nút điều khiển next và prev
                const nextButton = document.querySelector('.next');
                const prevButton = document.querySelector('.prev');

                nextButton.addEventListener('click', function() {
                    let items = document.querySelectorAll('.carousel-item');
                    document.querySelector('.carousel-inner').appendChild(items[0]);
                });

                prevButton.addEventListener('click', function() {
                    let items = document.querySelectorAll('.carousel-item');
                    document.querySelector('.carousel-inner').prepend(items[items.length - 1]);
                });

                // Thêm sự kiện kéo banner qua lại
                const carouselInner = document.querySelector('.carousel-inner');
                let isDragging = false;
                let startPos = 0;
                let currentTranslate = 0;
                let prevTranslate = 0;
                let animationID;

                // Sự kiện chuột
                carouselInner.addEventListener('mousedown', startDragging);
                carouselInner.addEventListener('mousemove', onDragging);
                carouselInner.addEventListener('mouseup', stopDragging);
                carouselInner.addEventListener('mouseleave', stopDragging);

                // Sự kiện cảm ứng
                carouselInner.addEventListener('touchstart', startDragging);
                carouselInner.addEventListener('touchmove', onDragging);
                carouselInner.addEventListener('touchend', stopDragging);

                function startDragging(event) {
                    isDragging = true;
                    startPos = getPositionX(event);
                    animationID = requestAnimationFrame(animation);
                }

                function onDragging(event) {
                    if (!isDragging) return;
                    const currentPosition = getPositionX(event);
                    currentTranslate = prevTranslate + currentPosition - startPos;
                }

                function stopDragging() {
                    isDragging = false;
                    cancelAnimationFrame(animationID);
                    const movedBy = currentTranslate - prevTranslate;

                    // Nếu kéo xa quá thì chuyển slide
                    if (movedBy < -100) {
                        document.querySelector('#carouselExample').carousel('next');
                    } else if (movedBy > 100) {
                        document.querySelector('#carouselExample').carousel('prev');
                    }

                    prevTranslate = 0;
                    currentTranslate = 0;
                }

                function getPositionX(event) {
                    return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
                }

                function animation() {
                    setSliderPosition();
                    if (isDragging) requestAnimationFrame(animation);
                }

                function setSliderPosition() {
                    carouselInner.style.transform = `translateX(${currentTranslate}px)`;
                }
            }
        }
    });
</script>