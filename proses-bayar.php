<?php
    require "koneksi.php";

    date_default_timezone_set('Asia/Jakarta');

    require 'vendor/autoload.php';

    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;

    Configuration::instance([
        'cloud' => [
            'cloud_name' => 'dmmwfystc',
            'api_key' => '465954757295179',
            'api_secret' => 'N0ZQidT7ZtCIrygzbi4fBkaVnD8',
        ],
        'url' => [
            'secure' => true
        ]
    ]);

    if(isset($_POST['submit'])) {
        $userId = $_POST['userId'];
        $produkId = $_POST['produkId'];
        $jumlah = $_POST['jumlah'];
        $produkHarga = $_POST['produkHarga'];
        $totalHarga = $produkHarga * $jumlah;
        $catatan = $_POST['catatan'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $metode = $_POST['metode'];
        $bankTujuan = $_POST['bank_tujuan'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_nama = $_FILES['gambar']['name'];

        try {
            $response = (new UploadApi())->upload($gambar_tmp, ['folder' => 'djogja-publisher']);

            $gambar_url = $response['secure_url'];

            $sql = "INSERT INTO pesanan (user_id, produk_id, jumlah, total_harga, catatan, metode, bank_tujuan, nomor_wa, bukti, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $result = $connection->prepare($sql);
            $result->execute([$userId, $produkId, $jumlah, $totalHarga, $catatan, $metode, $bankTujuan, $telepon, $gambar_url, date('Y-m-d H:i:s')]);

            echo '<script>alert("Berhasil melakukan pesanan");</script>';

            header("Location: dashboard.php");
        } catch (Exception $e) {
            echo '<script>alert("Gagal upload gambar karena ' . $e->getMessage() . '");</script>';
        }
    }