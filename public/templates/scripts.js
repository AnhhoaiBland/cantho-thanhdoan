const chonNgonNgu = document.getElementById('chonNgonNgu');
const optNgonNgu = document.getElementById('optNgonNgu');
const chonTiengViet = document.getElementById('chonTiengViet');
const chonTiengAnh = document.getElementById('chonTiengAnh');
const rootNgonNgu = document.getElementById('rootNgonNgu');
// chonNgonNgu.addEventListener('click',()=>{
//     // alert('cc')
    
//     optNgonNgu.style.display = "block";
// })

// chonTiengViet.addEventListener('click',()=>{
//     // alert('cc')
//     rootNgonNgu.setAttribute('src','./icons/vietnam.png');
//     optNgonNgu.style.display = "none";
// })

// chonTiengAnh.addEventListener('click',()=>{
//     // alert('cc')
//     rootNgonNgu.setAttribute('src','./icons/united-kingdom.png');
//     optNgonNgu.style.display = "none";
// })


function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Thay thế dấu cách bằng dấu gạch ngang
        .replace(/[^\w\-]+/g, '')       // Loại bỏ các ký tự không phải chữ cái, số, hoặc gạch ngang
        .replace(/\-\-+/g, '-')         // Loại bỏ các gạch ngang kéo dài
        .replace(/^-+/, '')             // Loại bỏ gạch ngang ở đầu chuỗi
        .replace(/-+$/, '');            // Loại bỏ gạch ngang ở cuối chuỗi
}
 