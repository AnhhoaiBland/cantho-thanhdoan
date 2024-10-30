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
</style>

<script>
const banner = document.getElementById('banner');

// Lấy dữ liệu từ AJAX và chỉ hiển thị một ảnh duy nhất
$.ajax({
    url: 'home/ajax_getpaneltop',
    type: 'get',
    dataType: 'JSON',
    success: function(result) {
        if (result.length > 0) {
            const element = result[0]; // Chỉ lấy phần tử đầu tiên
            let bannerHTML = '';

            if (element.urlBaiViet) {
                bannerHTML = `
                    <a href="${element.urlBaiViet}">
                        <img src="upload/media/images/${element.imageURL}" class="d-block w-100" alt="Banner Image">
                    </a>
                    `;
            } else {
                bannerHTML = `
                    <img src="upload/media/images/${element.imageURL}" class="d-block w-100" alt="Banner Image">
                    `;
            }
            banner.innerHTML = bannerHTML; // Chỉ hiển thị một ảnh duy nhất
        }
    }
});
</script>