<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan | InfrastrukturKu</title>
  <link rel="stylesheet" href="/css/coba.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <div class="container">

    <?php include('layout/sidebar.php'); ?>

      <div class="content">

          <!-- ngambil session dan ngasih notif -->
          <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success"><?= esc(session()->getFlashdata('success')); ?></div>
          <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert error"><?= esc(session()->getFlashdata('error')); ?></div>
          <?php endif; ?>

          <div class="topbar">
            <h1>Form Pengaduan</h1>
          </div>

        <div class="pengaduan-container"> 
        
          <div class="form-card">

            <!-- form pengaduan -->
            <form action="/dashboard/simpan_pengaduan" method="post" enctype="multipart/form-data">
              <?= csrf_field(); ?>  <!-- security token -->

              <div class="form-group">
                <label for="nama_pengaduan"><i class="fa-solid fa-clipboard-list"></i> Nama Pengaduan</label>
                <input type="text" id="nama_pengaduan" name="nama_pengaduan" required>
              </div>

              <div class="form-group">
                <label for="deskripsi"><i class="fa-solid fa-align-left"></i> Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>
              </div>

              <div class="form-group">
                <label for="id_lokasi"><i class="fa-solid fa-location-dot"></i> Lokasi</label>
                <select id="id_lokasi" name="id_lokasi" required>
                  <option value="">-- Pilih Lokasi --</option>

                  <?php foreach ($lokasi as $l): ?>
                    <option value="<?= $l['id_lokasi']; ?>"><?= esc($l['nama_lokasi']); ?></option>
                  <?php endforeach; ?>

                </select>
              </div>

              <!-- dropdown item  -->
              <div class="form-group">
                <label for="id_item"><i class="fa-solid fa-box"></i> Kategori</label>
                <select id="id_item" name="id_item" required>
                  <option value="">-- Pilih Item --</option>
                </select>
              </div>

            <!-- kalau milih kategori lain -->
            <div id="kategoriLain" style="display:none;">
              <div class="form-group">
                <label for="nama_item_baru"><i class="fa-solid fa-pen"></i> Nama Item Baru</label>
                <input type="text" id="nama_item_baru" name="nama_item_baru" placeholder="Nama item baru">
              </div>

              <div class="form-group">
                <label for="lokasi_item_baru"><i class="fa-solid fa-location-crosshairs"></i> Lokasi Item Baru</label>
                <input type="text" id="lokasi_item_baru" name="lokasi_item_baru" placeholder="Lokasi item baru">
              </div>
            </div>

              <div class="form-group upload-section">
                <label for="foto"><i class="fa-solid fa-camera"></i> Upload Foto</label>
                <input type="file" id="foto" name="foto" accept="image/*" required>

                <div class="preview">
                  <img id="previewImg" src="#" alt="Preview Foto" style="display:none;">
                </div>
              </div>

              <button type="submit" class="submit-btn">
                <i class="fa-solid fa-paper-plane"></i> Kirim Pengaduan
              </button>

            </form>
          </div>

      </div>
    </div>
</div>

          <!-- jQuery -->
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <!-- ngecek foto -->
        <script>
          document.getElementById('foto').addEventListener('change', function(event) {
            const reader = new FileReader();

            reader.onload = function(){
              const output = document.getElementById('previewImg');
              output.src = reader.result;       
              output.style.display = 'block';   
            };

            reader.readAsDataURL(event.target.files[0]);
          });

          // load item/kategori
          $(document).ready(function(){

            $('#id_lokasi').on('change', function(){
              var id_lokasi = $(this).val();

              $('#id_item').html('<option value="">Memuat item...</option>'); // loading

              if(id_lokasi){
                $.ajax({
                  url: '/dashboard/getItems/' + id_lokasi,
                  type: 'GET',
                  dataType: 'json',

                  success: function(data){
                    $('#id_item').html('<option value="">-- Pilih Item --</option>');

                    $.each(data, function(index, item){
                      $('#id_item').append('<option value="'+ item.id_item +'">'+ item.nama_item +'</option>');
                    });

                    $('#id_item').append('<option value="lain">+ Kategori Lain</option>');
                  },

                  error: function(){
                    $('#id_item').html('<option value="">Gagal memuat data</option>');
                  }
                });
              } else {
                $('#id_item').html('<option value="">-- Pilih Lokasi Dahulu --</option>');
              }
            });

            // Menampilkan input kategori baru jika pilih "lain"
            $('#id_item').on('change', function(){
              if($(this).val() === 'lain'){
                $('#kategoriLain').slideDown();   
              } else {
                $('#kategoriLain').slideUp();     
              }
            });
          });
        </script>

        <script>
          // notif
          window.addEventListener('DOMContentLoaded', () => {

            document.querySelectorAll('.alert').forEach(alert => {
              setTimeout(() => {
                alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
              }, 4000); 
            });

          });

              // tombol buat close si notif
              function closeFlash(id) {
                const el = document.getElementById(id);
                if (el) {
                  el.style.transition = 'opacity 0.2s ease';
                  el.style.opacity = '0';
                  setTimeout(() => el.remove(), 200);
                }
              }
        </script>

</body>
</html>