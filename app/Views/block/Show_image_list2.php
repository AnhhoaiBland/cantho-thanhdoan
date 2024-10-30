<style>
    * {
        box-sizing: border-box;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 40%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .numbertext {
        color: black;
        font-weight: bold;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    .caption-container {
        text-align: center;
        background-color: #222;
        padding: 2px 16px;
        color: white;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 16.66%;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    .mySlides {
        /* border: 10px solid #ccc;
        border-radius: 5px; */
    }

    .mySlides img {
        padding: 10px;
        width: 600px;
        height: 500px;
        object-fit: contain;
    }

    .mota{
        margin: 10px;
    }

    .title {
        background-color: #f2f2f2;
        padding: 20px;
        margin: 10px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
<!-- Container for the image gallery -->
<div class="p-5 bg-body">

    <div class="container position-relative" style="height: 800px;">
        <!-- Full-width images with number text -->
        <div class="mySlides">
            <div class="numbertext">1 / 6</div>
            <img src="https://www.w3schools.com/howto/img_5terre_wide.jpg" style="width:100%">
        </div>
        <div class="mySlides">
            <div class="numbertext">2 / 6</div>
            <img src="https://hoilhpn.org.vn/documents/20182/22745/01261303032024_z5212245805983_36af8434b118f47e635af573efaa8767.jpg/ba3402b6-605c-4478-9504-68a8add10aeb" style="width:100%">
        </div>
        <div class="mySlides">
            <div class="numbertext">3 / 6</div>
            <img src="https://hoilhpn.org.vn/documents/20182/22745/01334703032024_IMG_0726.JPG/7b5ccbb4-e3c5-46a1-a824-c93167711f00" style="width:100%">
        </div>
        <div class="mySlides">
            <div class="numbertext">4 / 6</div>
            <img src="https://hoilhpn.org.vn/documents/20182/22745/01342403032024_IMG_0671.JPG/5c4e97e1-7d26-4d45-8c34-b939c5e12929" style="width:100%">
        </div>
        <div class="mySlides">
            <div class="numbertext">5 / 6</div>
            <img src="https://hoilhpn.org.vn/documents/20182/22745/01345603032024_IMG_0653.JPG/5f4e7e89-4fd0-43b4-82e8-4c49d35b3846" style="width:100%">
        </div>
        <div class="mySlides">
            <div class="numbertext">6 / 6</div>
            <img src="https://hoilhpn.org.vn/documents/20182/22745/01352803032024_IMG_0623.JPG/470d2482-137e-47c3-8eef-d2676778725b" style="width:100%">
        </div>
        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <!-- Image text -->
        <div class="caption-container">
            <p id="caption"></p>
        </div>
        <!-- Thumbnail images -->
        <div class="row">
            <div class="column">
                <img class="demo cursor" src="https://www.w3schools.com/howto/img_5terre_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
            </div>
            <div class="column">
                <img class="demo cursor" src="https://hoilhpn.org.vn/documents/20182/22745/01261303032024_z5212245805983_36af8434b118f47e635af573efaa8767.jpg/ba3402b6-605c-4478-9504-68a8add10aeb" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
            </div>
            <div class="column">
                <img class="demo cursor" src="https://hoilhpn.org.vn/documents/20182/22745/01334703032024_IMG_0726.JPG/7b5ccbb4-e3c5-46a1-a824-c93167711f00" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
            </div>
            <div class="column">
                <img class="demo cursor" src="https://hoilhpn.org.vn/documents/20182/22745/01342403032024_IMG_0671.JPG/5c4e97e1-7d26-4d45-8c34-b939c5e12929" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
            </div>
            <div class="column">
                <img class="demo cursor" src="https://hoilhpn.org.vn/documents/20182/22745/01345603032024_IMG_0653.JPG/5f4e7e89-4fd0-43b4-82e8-4c49d35b3846" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
            </div>
            <div class="column">
                <img class="demo cursor" src="https://hoilhpn.org.vn/documents/20182/22745/01352803032024_IMG_0623.JPG/470d2482-137e-47c3-8eef-d2676778725b" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
            </div>
        </div>
        <div class="mota">
            dfdf
        </div>
    </div>
</div>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);
    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }
    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }
    setInterval(() => {
        plusSlides(1);
    }, 3000);

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        // let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        // captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>