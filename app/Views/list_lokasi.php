<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen List Lokasi | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="container">

        <?php include('layout/sidebar_admin.php'); ?>

        <div class="content">
            
            <div class="topbar">
            <h1>Manajemen List Lokasi</h1>
            </div>

            <!-- header tabel -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID List</th>
                        <th>ID Lokasi</th>
                        <th>ID Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- looping data -->
                    <?php $no = 1; foreach ($list_lokasi as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td> 
                            <td><?= $row['id_list']; ?></td> 
                            <td><?= esc($row['id_lokasi']); ?></td>
                            <td><?= esc($row['id_item']); ?></td>
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
                </tbody>
            </table>

            <div class="tambah-container">
                <a href="#" class="btn-tambah" onclick="openAddPopup(); return false;">Tambah Data</a>
            </div>
        </div>

    <!-- Popup Form Edit -->
        <div id="editPopup" class="popup-overlay">
            <div class="popup-content">
                <h3>Edit Data List Lokasi</h3>
                <form id="editForm" method="post" action="/list_lokasi/update">
                    <label for="id_list">ID List</label>
                    <input type="text" id="id_list" name="id_list" readonly>

                    <label for="id_lokasi">ID Lokasi</label>
                    <input type="text" id="id_lokasi" name="id_lokasi" required>

                    <label for="id_item">ID Item</label>
                    <input type="text" id="id_item" name="id_item" required>

                    <div class="btn-container">
                        <button type="submit" class="btn-update">Update</button>
                        <button type="button" class="btn-cancel" onclick="closePopup()">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- notif sukses -->
        <?php if(session()->getFlashdata('success')): ?>
            <script>
                alert("<?= session()->getFlashdata('success') ?>");
                window.location.reload();
            </script>
        <?php endif; ?>

        <script>
            function openEditPopup(data) {
                document.getElementById("editPopup").style.display = "flex";
                document.getElementById("id_list").value = data.id_list;
                document.getElementById("id_lokasi").value = data.id_lokasi;
                document.getElementById("id_item").value = data.id_item;
            }

            function closePopup() {
                document.getElementById("editPopup").style.display = "none";
            }
        </script>

        <!-- pop up tambah -->
        <div id="addPopup" class="popup-overlay">
            <div class="popup-content">
                <h3>Tambah Data List Lokasi</h3>
                <form id="addForm">
                    <label for="add_id_list">ID List</label>
                    <input type="text" id="add_id_list" name="id_list">

                    <label for="add_id_lokasi">ID Lokasi</label>
                    <input type="text" id="add_id_lokasi" name="id_lokasi" required>

                    <label for="add_id_item">ID Item</label>
                    <input type="text" id="add_id_item" name="id_item" required>
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
                    const id_list = document.getElementById("add_id_list").value.trim();
                    const id_lokasi = document.getElementById("add_id_lokasi").value.trim();
                    const id_item = document.getElementById("add_id_item").value.trim();

                    // validasi kosong
                    if (id_list === "" || id_lokasi === "" || id_item === "") {
                        addErrorMsg.style.display = "block";
                        return;
                    }

                    addErrorMsg.style.display = "none";

                    const formData = new FormData(addForm);

                fetch("/list_lokasi/simpan", {
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

        <script>
            function openEditPopup(user) {
            document.getElementById("editPopup").style.display = "flex";
            document.getElementById("id_list").value = user.id_list;
            document.getElementById("id_lokasi").value = user.id_lokasi;
            document.getElementById("id_item").value = user.id_item;
            }

            function closePopup() {
            document.getElementById("editPopup").style.display = "none";
            }
        </script>

</body>
</html>