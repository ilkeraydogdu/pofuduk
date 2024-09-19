document.addEventListener('DOMContentLoaded', function() {
    // Tüm minus ve plus butonlarını seç
    var minusBtns = document.querySelectorAll('.minus');
    var plusBtns = document.querySelectorAll('.add');

    minusBtns.forEach(function(minusBtn) {
        minusBtn.addEventListener('click', function() {
            var urunId = this.id.split('_')[1]; // Buton ID'sinden ürün ID'sini çıkarıyoruz
            var miktarInput = document.getElementById('miktar_' + urunId);
            var miktar = parseInt(miktarInput.value, 10); // Sayıyı tam sayı olarak alıyoruz

            // Eğer miktar 1'den büyükse bir azaltıyoruz
            if (!isNaN(miktar) && miktar > 1) {
                miktarInput.value = miktar - 1;
            }
        });
    });

    plusBtns.forEach(function(plusBtn) {
        plusBtn.addEventListener('click', function() {
            var urunId = this.id.split('_')[1]; // Buton ID'sinden ürün ID'sini çıkarıyoruz
            var miktarInput = document.getElementById('miktar_' + urunId);
            var miktar = parseInt(miktarInput.value, 10); // Sayıyı tam sayı olarak alıyoruz

            // NaN kontrolü ve bir artırma
            if (!isNaN(miktar)) {
                miktarInput.value = miktar + 1;
            }
        });
    });
});
 