<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Item | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">

        <?php include('layout/sidebar_admin.php'); ?>

        <div class="content">

            <div class="topbar">
            <h1>Manajemen Item</h1>
            </div>
            
            <!-- header tabel -->
            <div class="table-responsive">
                <table>
                    <tr>
                        <th>No</th>
                        <th>ID Item</th>
                        <th>Nama Item</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>

                    <!-- looping data item-->
                    <?php $no = 1; foreach ($items as $item): ?>

                    <tr>
                        <td><?= $no++; ?></td> 
                        <td><?= $item['id_item']; ?></td> 
                        <td><?= esc($item['nama_item']); ?></td>
                        <td><?= esc($item['lokasi']); ?></td>
                        <td><?= esc($item['deskripsi']); ?></td>
                        <td>
                            <img src="<?= base_url('uploads/items/' . $item['foto']); ?>" width="80">
                        </td>

                        <td>
                            <a href="javascript:void(0);" 
                            class="btn-edit"
                            onclick='openEditPopup(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, "UTF-8"); ?>)'>
                            <i class="fa fa-pen"></i> Edit
                            </a>

                            <a href="/item/delete/<?= $item['id_item']; ?>" 
                            class="btn-hapus" 
                            onclick="return confirm('Yakin ingin menghapus item ini?')">
                            <i class="fa fa-trash"></i> Hapus
                            </a>

                        </td>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>

                    <div class="tambah-container">
                        <a href="javascript:void(0);" class="btn-tambah" onclick="openAddPopup()">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>

                    <!-- pop up tambah data -->
                    <div id="addPopup" class="popup-overlay">
                        <div class="popup-content">
                            <h3>Tambah Data Item</h3>
                            <form id="addForm" enctype="multipart/form-data">
                                <label for="add_id_item">ID Item</label>
                                <input type="text" id="add_id_item" name="id_item">

                                <label for="add_nama_item">Nama Item</label>
                                <input type="text" id="add_nama_item" name="nama_item" required>

                                <label for="add_lokasi">Lokasi</label>
                                <input type="text" id="add_lokasi" name="lokasi" required>

                                <label for="add_deskripsi">Deskripsi</label>
                                <input type="text" id="add_deskripsi" name="deskripsi" required>

                                <label for="add_foto">Foto</label>
                                <input type="file" id="add_foto" name="foto" accept="image/*" required>
                                </select>

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
                        const id_item = document.getElementById("add_id_item").value.trim();
                        const nama_item = document.getElementById("add_nama_item").value.trim();
                        const lokasi = document.getElementById("add_lokasi").value.trim();
                        const deskripsi = document.getElementById("add_deskripsi").value.trim();

                        // validasi kosong
                        if (nama_item === "" || lokasi === "" || deskripsi === "") {
                            addErrorMsg.style.display = "block";
                            return;
                        }

                        addErrorMsg.style.display = "none";

                        const formData = new FormData(addForm);

                    fetch("/item/simpan", {
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

    <script>
        function openEditPopup(item) {
        document.getElementById("editPopup").style.display = "flex";
        document.getElementById("edit_id_item").value = item.id_item;
        document.getElementById("nama_item").value = item.nama_item;
        document.getElementById("lokasi").value = item.lokasi;
        document.getElementById("deskripsi").value = item.deskripsi;
        document.getElementById("foto").value = item.foto;
        }

        function closePopup() {
        document.getElementById("editPopup").style.display = "none";
        }
    </script>

        <!-- pop up edit -->
        <div id="editPopup" class="popup-overlay">
            <div class="popup-content">
                <h3>Edit Data Item</h3>

                <form id="editForm" 
                    method="post" 
                    action="/item/update" 
                    enctype="multipart/form-data"> 

                    <label for="id_item">ID Item</label>
                    <input type="text" id="edit_id_item" name="id_item" readonly>

                    <label for="nama_item">Nama Item</label>
                    <input type="text" id="nama_item" name="nama_item" required>

                    <label for="lokasi">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" required>

                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi">

                    <label for="foto">Foto Baru (opsional)</label>
                    <input type="file" id="foto" name="foto" accept="image/*">

                    <div class="btn-container">
                        <button type="submit" class="btn-update">Update</button>
                        <button type="button" class="btn-cancel" onclick="closePopup()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            <?php if(session()->getFlashdata('success')): ?>
                alert("<?= session()->getFlashdata('success') ?>");
            <?php endif; ?>
        </script>      
</body>
</html>