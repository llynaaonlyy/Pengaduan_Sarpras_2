<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Lokasi | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="container">

        <?php include('layout/sidebar_admin.php'); ?>

        <div class="content">

            <div class="topbar">
            <h1>Manajemen Lokasi</h1>
            </div>

            <!-- header tabel -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Lokasi</th>
                        <th>Nama Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <!-- looping data -->
                <tbody>
                    <?php if (!empty($lokasi)): ?>
                        <?php $no = 1; foreach ($lokasi as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td> 
                                <td><?= esc($row['id_lokasi']); ?></td> 
                                <td><?= esc($row['nama_lokasi']); ?></td>
                                <td>
                                    <a href="javascript:void(0);" 
                                       class="btn-edit"
                                       onclick='openEditPopup(<?= json_encode($row); ?>)'>
                                       <i class="fa fa-pen"></i> Edit</a>
                                    <a href="/lokasi/delete/<?= $row['id_lokasi']; ?>" 
                                       class="btn-hapus" 
                                       onclick="return confirm('Yakin ingin menghapus lokasi ini?')">
                                       <i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- kalau tidak ada data -->
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align:center;">Belum ada data lokasi.</td></tr>
                        <?php endif; ?>
                </tbody>
            </table>

                    <a href="javascript:void(0);" onclick="openAddPopup()" class="btn-tambah">
                    <i class="fa fa-plus"></i> Tambah Data</a>

        </div>
    </div>

            <!-- pop up edit -->
            <div id="editPopup" class="popup-overlay">
                <div class="popup-content">
                    <h3>Edit Data Lokasi</h3>
                    <form id="editForm" method="post" action="/lokasi/update">
                        <label for="id_lokasi">ID Lokasi</label>
                        <input type="text" id="id_lokasi" name="id_lokasi" readonly>

                        <label for="nama_lokasi">Nama Lokasi</label>
                        <input type="text" id="nama_lokasi" name="nama_lokasi" required>

                        <div class="btn-container">
                            <button type="submit" class="btn-update">Update</button>
                            <button type="button" class="btn-cancel" onclick="closePopup()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openEditPopup(lokasi) {
                    document.getElementById("editPopup").style.display = "flex";
                    document.getElementById("id_lokasi").value = lokasi.id_lokasi;
                    document.getElementById("nama_lokasi").value = lokasi.nama_lokasi;
                }

                function closePopup() {
                    document.getElementById("editPopup").style.display = "none";
                }

                // ngehandle submit
                document.getElementById('editForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);

                    fetch('/lokasi/update', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(() => {
                        alert('Data lokasi berhasil diperbarui!');
                        closePopup();
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    })
                    .catch(error => console.error('Error:', error));
                });
            </script>

            <?php if(session()->getFlashdata('success')): ?>
                <script>alert("<?= session()->getFlashdata('success') ?>");</script>
            <?php endif; ?>

            <!-- pop up tambah -->
            <div id="addPopup" class="popup-overlay">
                <div class="popup-content">
                    <h3>Tambah Data Lokasi</h3>
                    <form id="addForm">
                        <label for="add_id_lokasi">ID Lokasi</label>
                        <input type="text" id="add_id_lokasi" name="id_lokasi">

                        <label for="add_nama_lokasi">Nama Lokasi</label>
                        <input type="text" id="add_nama_lokasi" name="nama_lokasi" required>

                        <!-- pesan error -->
                        <p id="addErrorMsg" style="color: #ff4d4d; display: none; font-weight: bold; margin-top: 10px;">Data belum lengkap!</p>

                        <div class="btn-container">
                            <button type="submit" class="btn-update">Simpan</button>
                            <button type="button" class="btn-cancel" onclick="closeAddPopup()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- script tambah data -->
            <script>
                function openAddPopup() {
                    document.getElementById("addPopup").style.display = "flex";
                }

                function closeAddPopup() {
                    document.getElementById("addPopup").style.display = "none";
                    document.getElementById("addForm").reset();
                    document.getElementById("addErrorMsg").style.display = "none";
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const addForm = document.getElementById("addForm");
                    const addErrorMsg = document.getElementById("addErrorMsg");

                    addForm.addEventListener("submit", function(e) {
                        e.preventDefault();

                        // ambil nilai input
                        const id_lokasi = document.getElementById("add_id_lokasi").value.trim();
                        const nama_lokasi = document.getElementById("add_nama_lokasi").value.trim();

                        // validasi kosong
                        if (nama_lokasi === "" ) {
                            addErrorMsg.style.display = "block";
                            return;
                        }

                        addErrorMsg.style.display = "none";

                        const formData = new FormData(addForm);

                    fetch("/lokasi/simpan", {
                    method: "POST",
                    body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            alert("✅ Data berhasil ditambahkan!");
                            closeAddPopup();
                            setTimeout(() => location.reload(), 500);
                        } else {
                            alert("❌ Gagal menambahkan data!");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                    });
                });
            </script>
  
                </div>
            </div>

            <!-- script edit -->
            <script>
               function openEditPopup(lokasi) {
                document.getElementById("editPopup").style.display = "flex";
                document.getElementById("id_lokasi").value = lokasi.id_lokasi;
                document.getElementById("nama_lokasi").value = lokasi.nama_lokasi;
            }

            function closePopup() {
                document.getElementById("editPopup").style.display = "none";
            }
            </script>

</body>
</html>