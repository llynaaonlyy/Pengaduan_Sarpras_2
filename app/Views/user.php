<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | InfrastrukturKu</title>
    <link rel="stylesheet" href="/css/stylee2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">

        <?php include('layout/sidebar_admin.php'); ?>

            <div class="content">

                <div class="topbar">
                    <h1>Manajemen User</h1>
                </div>

                <!-- header tabel -->
                <table>
                    <tr>
                        <th>No</th>
                        <th>ID User</th>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    <?php if (!empty($users)): ?>

                        <!-- looping data user-->
                        <?php $no = 1; foreach ($users as $user): ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($user['id_user']); ?></td>
                                <td><?= esc($user['nama_pengguna']); ?></td>
                                <td><?= esc($user['username']); ?></td>
                                <td><?= esc($user['role']); ?></td>
                                <td class="aksi">
                                <a href="javascript:void(0);" 
                                    class="btn-edit" 
                                    onclick='openEditPopup(<?= json_encode($user); ?>)'>
                                    <i class="fa fa-pen"></i> Edit</a>
                                    <a href="/user/delete/<?= $user['id_user']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" style="text-align:center;">Belum ada data user.</td></tr>
                            <?php endif; ?>
                    </table>

                    <div class="tambah-container">
                        <a href="javascript:void(0);" class="btn-tambah" onclick="openAddPopup()">
                            <i class="fa fa-plus"></i> Tambah Data</a>
                    </div>

                    <!-- pop up tambah -->
                    <div id="addPopup" class="popup-overlay">
                        <div class="popup-content">
                            <h3>Tambah Data User</h3>
                            <form id="addForm">
                                <label for="add_id_user">ID User</label>
                                <input type="text" id="add_id_user" name="id_user">

                                <label for="add_nama_pengguna">Nama Pengguna</label>
                                <input type="text" id="add_nama_pengguna" name="nama_pengguna" required>

                                <label for="add_username">Username</label>
                                <input type="text" id="add_username" name="username" required>

                                <label for="add_password">Password</label>
                                <input type="password" id="add_password" name="password" required>

                                <label for="add_role">Role</label>
                                <select id="add_role" name="role" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Petugas">Petugas</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Siswa">Siswa</option>
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
                                const id_user = document.getElementById("add_id_user").value.trim();
                                const nama = document.getElementById("add_nama_pengguna").value.trim();
                                const username = document.getElementById("add_username").value.trim();
                                const password = document.getElementById("add_password").value.trim();
                                const role = document.getElementById("add_role").value.trim();

                                // validasi kosong
                                if (nama === "" || username === "" || password === "" || role === "") {
                                    addErrorMsg.style.display = "block";
                                    return;
                                }

                                addErrorMsg.style.display = "none";

                                const formData = new FormData(addForm);

                            //nyimpen data dan ngasih notif 
                            fetch("/user/simpan", {
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
                            function openEditPopup(user) {
                            document.getElementById("editPopup").style.display = "flex";
                            document.getElementById("id_user").value = user.id_user;
                            document.getElementById("nama_pengguna").value = user.nama_pengguna;
                            document.getElementById("username").value = user.username;
                            document.getElementById("role").value = user.role;
                            }

                            function closePopup() {
                              document.getElementById("editPopup").style.display = "none";
                            }
                        </script>

                        <!-- pop up edit -->
                        <div id="editPopup" class="popup-overlay">
                            <div class="popup-content">
                                <h3>Edit Data User</h3>
                                <form id="editForm" method="post" action="/user/update">

                                <label for="id_user">ID User</label>
                                <input type="text" id="id_user" name="id_user" readonly>

                                <label for="nama_pengguna">Nama Pengguna</label>
                                <input type="text" id="nama_pengguna" name="nama_pengguna" required>

                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required>

                                <label for="password">Password</label>
                                <input type="password" id="password" name="password">

                                <label for="role">Role</label>
                                <select id="role" name="role" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Petugas">Petugas</option>
                                    <option value="Guru">Guru</option>
                                    <option value="Siswa">Siswa</option>
                                </select>

                                <div class="btn-container">
                                    <button type="submit" class="btn-update">Update</button>
                                    <button type="button" class="btn-cancel" onclick="closePopup()">Batal</button>
                                </div>
                                </form>
                            </div>
                        </div>

                            <?php if(session()->getFlashdata('success')): ?>
                                alert("<?= session()->getFlashdata('success') ?>");
                            <?php endif; ?>
                            
</body>
</html>
