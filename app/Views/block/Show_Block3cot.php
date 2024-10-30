<style>
/* Container for each post item */
.show_baiviet_hinh_3cot_khung {
    margin-top: 15px;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    
}

/* Increase size and make it more responsive */
.show_baiviet_hinh_3cot_khung:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

/* Image section */
.show_baiviet_hinh_3cot_image {
    height: 250px; /* Larger image */
    position: relative;
    overflow: hidden;
}

/* Ensure images cover their container */
.show_baiviet_hinh_3cot_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

/* Image hover effect */
.show_baiviet_hinh_3cot_image:hover img {
    transform: scale(1.1);
}

/* Title overlay */
.show_baiviet_hinh_3cot_title {
    width: 100%;
    bottom: 0;
    padding: 15px;
    position: absolute;
    background: rgba(0, 0, 0, 0.6); /* Darker background for contrast */
    color: #ffffff;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    transition: background 0.3s ease;
}

.show_baiviet_hinh_3cot_title a {
    color: #ffffff;
    text-decoration: none;
}

.show_baiviet_hinh_3cot_title:hover {
    background: rgba(0, 0, 0, 0.8); /* Darker on hover */
}

/* Responsive layout adjustments */
@media (max-width: 1024px) {
    .show_baiviet_hinh_3cot_image {
        height: 200px;
    }

    .show_baiviet_hinh_3cot_title {
        font-size: 16px;
    }
}

@media (max-width: 768px) {
    .show_baiviet_hinh_3cot_image {
        height: 180px;
    }

    .show_baiviet_hinh_3cot_title {
        font-size: 14px;
    }
}

</style>

<div class="pb-3 pt-5 block_ditich_hinh">
    <div class="block_ditich_hinh_header block_title">
        <a href="page/CAT_ALIAS_NAME_SAMPLE">CAT_NAME_SAMPLE</a>
    </div>
    <div class="block_ditich_hinh_content">
        <div class="row">
            <div class="col-md-4">
                <div class="show_baiviet_hinh_3cot_khung">
                    <div class="show_baiviet_hinh_3cot_image">
                        <img src="media/images/BV_HINH_ANH_SAMPLE" alt="Sample Image">
                    </div>
                    <div class="show_baiviet_hinh_3cot_title">
                        <a href="baiviet/BV_ID_SAMPLE">BV_TIEU_DE_SAMPLE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="show_baiviet_hinh_3cot_khung">
                    <div class="show_baiviet_hinh_3cot_image">
                        <img src="media/images/BV_HINH_ANH_SAMPLE" alt="Sample Image">
                    </div>
                    <div class="show_baiviet_hinh_3cot_title">
                        <a href="baiviet/BV_ID_SAMPLE">BV_TIEU_DE_SAMPLE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="show_baiviet_hinh_3cot_khung">
                    <div class="show_baiviet_hinh_3cot_image">
                        <img src="media/images/BV_HINH_ANH_SAMPLE" alt="Sample Image">
                    </div>
                    <div class="show_baiviet_hinh_3cot_title">
                        <a href="baiviet/BV_ID_SAMPLE">BV_TIEU_DE_SAMPLE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
