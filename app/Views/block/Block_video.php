<style>
    .video-container {
        margin: 0 auto;
        max-width: 100%;
        width: 1040px;
        height: 590px;
        position: relative;
    }

    /* Show the first slide by default */
    .video-slide {
        display: none;
        position: relative;
        margin: 0 auto;
    }

    .video-slide.active {
        display: block;
    }

    /* Video */
    .video-slide video {
        width: 100%;
        height: 590px;
    }

    /* Navigation buttons */
    .video-slider-btn {
        border: none;
        color: #fff;
        font-size: 50px;
        padding: 10px;
        background-color: transparent;
        text-align: center;
        cursor: pointer;
        z-index: 99999;
        opacity: .7;
        transition: all 350ms ease-in-out;
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
    }

    .video-slider-btn.left-side {
        left: 0;
    }

    .video-slider-btn.right-side {
        right: 0;
    }

    .video-slider-btn:hover {
        opacity: 1;
    }
</style>

<div class="video-container">
    <?php foreach ($item_bst as $key => $vido) { ?>
        <div class="video-slide <?= $key === 0 ? 'active' : '' ?>">
            <video controls>
                <source src="<?= base_url("upload/media/videos/{$vido['urlFile']}") ?>" type="video/mp4">
            </video>
        </div>
    <?php } ?>

    <button class="video-slider-btn left-side" onclick="plusDivs(-1)">&#10094;</button>
    <button class="video-slider-btn right-side" onclick="plusDivs(1)">&#10095;</button>
</div>



<script>
    var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var slides = document.getElementsByClassName("video-slide");
    var videos = document.getElementsByTagName("video");

    if (n > slides.length) { 
        slideIndex = 1; 
    }
    if (n < 1) { 
        slideIndex = slides.length; 
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
        videos[i].pause(); // Pause previous videos
    }

    slides[slideIndex - 1].classList.add("active");
}

</script>