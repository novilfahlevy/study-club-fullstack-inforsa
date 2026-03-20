<?php require './layouts/header.php'; ?>

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

<?php require './layouts/footer.php'; ?>