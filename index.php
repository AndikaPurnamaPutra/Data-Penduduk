<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Buku</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: #0b486b;
      }
      .tombol {
        margin-right: 62%;       
      }
      .tombol2 {
        margin-left: 62%;        
      }
    table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: #0b486b;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
          border-radius: 3px;
    }
    </style>
  </head>
  <body>
    <div>
    
    </div>
    <center>
    <img src="gambar/buku.png" alt="" width="150" height="150">
    <h1>Daftar Buku</h1>
    <center>
    <div class="tombol">
	  <a href="logout.php">LOGOUT</a>
    </div>
    <div class="tombol2">
    <a class="tambah" href="tambah_produk.php">+ &nbsp; Tambah Buku</a></div>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Pengarang</th>
          <th>Penerbit</th>
          <th>Persediaan</th>
          <th>Gambar</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM table_buku ORDER BY id_buku ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['judul']; ?></td>
          <td><?php echo $row['pengarang']; ?></td>
          <td><?php echo $row['penerbit']; ?></td>
          <td><?php echo $row['persediaan']; ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
          <td>
              <a href="edit_produk.php?id=<?php echo $row['id_buku']; ?>">Edit</a> |
              <a href="proses_hapus.php?id=<?php echo $row['id_buku']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>

      <?php 
      //memulai session yang disimpan pada browser
      session_start();

      //cek apakah sesuai status sudah login? kalau belum akan kembali ke form login
      if($_SESSION['status']!="sudah_login"){
      //melakukan pengalihan
      header("location:login.php");
      } 
      ?>
    </tbody>
    </table>
    
  </body>
</html>