<style>
    .tieu_de_lienket {
        font-weight: bold;
        font-size: 17px;
        color: #333;
        text-decoration: none;
    }
    .arrow {
        display: inline-block;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 15px solid #333;
        animation: bounce 1s infinite;
        margin-left: 10px;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
</style>

<div class="bg-body p-3">
    <label for="" class="form-label tieu_de_lienket">LIÊN KẾT WEBSITE</label>
    <div class="arrow"></div>

    <!-- Các mã khác -->
</div>




