const saveButtons = document.querySelectorAll('.btn-save');

saveButtons.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        const card = btn.closest('.pengumuman');
        const data = {
            id: index,
            judul: card.querySelector('.judul').innerText,
            tanggal: card.querySelector('.tanggal').innerText,
            deskripsi: card.querySelector('.deskripsi').innerText
        };

        // Ambil data lama dari localStorage
        let arsip = JSON.parse(localStorage.getItem('arsip_mading')) || [];
        
        // Cek apakah sudah ada agar tidak duplikat
        const isExist = arsip.some(item => item.judul === data.judul);
        
        if (!isExist) {
            arsip.push(data);
            localStorage.setItem('arsip_mading', JSON.stringify(arsip));
            alert('Berhasil disimpan ke arsip!');
        } else {
            alert('Pengumuman ini sudah ada di arsip.');
        }
    });
});