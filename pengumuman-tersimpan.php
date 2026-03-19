<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mading Digital FT UNMUL: Pengumuman Tersimpan</title>
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <header>
      <h1>Pengumuman <span>Tersimpan</span></h1>
      <nav>
        <ul>
          <li><a href="index.html">Kembali ke Beranda</a></li>
        </ul>
      </nav>
    </header>

    <main id="arsip-container"></main>

    <script>
      const container = document.getElementById("arsip-container");
      const dataArsip = JSON.parse(localStorage.getItem("arsip_mading")) || [];

      if (dataArsip.length === 0) {
        container.innerHTML = "<p>Belum ada pengumuman yang disimpan.</p>";
      } else {
        dataArsip.forEach((item) => {
          const article = document.createElement("article");
          article.className = "pengumuman";
          article.innerHTML = `
                  <h2>${item.judul}</h2>
                  <p class="tanggal">${item.tanggal}</p>
                  <p>${item.deskripsi}</p>
              `;
          container.appendChild(article);
        });
      }
    </script>
  </body>
</html>
