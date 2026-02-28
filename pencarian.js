const searchInput = document.getElementById('search-input');
const listPengumuman = document.querySelectorAll('.pengumuman');

searchInput.addEventListener('input', () => {
    const filter = searchInput.value.toLowerCase();
    
    listPengumuman.forEach(item => {
        const judul = item.querySelector('.judul').innerText.toLowerCase();
        if (judul.includes(filter)) {
            item.style.display = ""; // Tampilkan
        } else {
            item.style.display = "none"; // Sembunyikan
        }
    });
});