const darkModeBtn = document.getElementById('dark-mode-toggle');

// Cek status dark mode di localStorage saat halaman dimuat
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    darkModeBtn.innerText = '☀️';
}

darkModeBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        darkModeBtn.innerText = '☀️';
    } else {
        localStorage.setItem('theme', 'light');
        darkModeBtn.innerText = '🌙';
    }
});