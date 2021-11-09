<?php
    //koneksi database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "dbtriy";

    $koneksi = mysqli_connect ($server, $user, $pass, $database)or die(mysqli_error($koneksi));

    //jika simpan di klik 
    if(isset($_POST['bsimpan']))
    {
        if($_GET['hal']=="edit")
        {
            $edit = mysqli_query($koneksi, "UPDATE tikan set
                                    id_ikan = '$_POST[tid]',
                                    nama = '$_POST[tnama]',
                                    filum = '$_POST[tfilum]',
                                    kelas = '$_POST[tkelas]',
                                    ordo = '$_POST[tordo]',
                                    famili = '$_POST[tfamili]',
                                    genus = '$_POST[tgenus]',
                                    spesies = '$_POST[tspesies]',
                                    deskripsi = '$_POST[tdes]'
                                    WHERE id_ikan = '$_GET[id]'");
        if($edit)
            {
                echo    "<script>
                            alert('Edit data sukses:)');
                            document.location='index.php';
                        </script>";
            }
        else
            {
                echo    "<script>
                            alert('Edit data gagal!');
                            document.location='index.php';
                        </script>";
            }
        }
        else
            {
                $simpan = mysqli_query($koneksi, "INSERT INTO tikan (nama, filum, kelas, ordo, famili, genus, spesies, deskripsi)
            VALUES  ('$_POST[tnama]',
                    '$_POST[tfilum]',
                    '$_POST[tkelas]',
                    '$_POST[tordo]',
                    '$_POST[tfamili]',
                    '$_POST[tgenus]',
                    '$_POST[tspesies]',
                    '$_POST[tdes]')");
            if($simpan)
                {
                    echo    "<script>
                                alert('Simpan data sukses:)');
                                document.location='index.php';
                            </script>";
                }
            else
                {
                    echo    "<script>
                                alert('Simpan data gagal!');
                                document.location='index.php';
                            </script>";
                }
        }
    }

    //pengujian jika edit atau hapus diklik
    if(isset($_GET['hal']))
    {
        if($_GET['hal']=="edit")
        {
            $tampil= mysqli_query($koneksi, "SELECT * FROM tikan WHERE id_ikan='$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                $vid_ikan = $data['id_ikan'];
                $vnama= $data['nama'];
                $vfilum = $data['filum'];
                $vkelas = $data['kelas'];
                $vordo = $data['ordo'];
                $vfamili = $data['famili'];
                $vgenus = $data['genus'];
                $vspesies = $data['spesies'];
                $vdeskripsi = $data['deskripsi'];
            }
        }
        else if ($_GET['hal']== "hapus")
        {
            $hapus = mysqli_query($koneksi, "DELETE FROM tikan WHERE id_ikan = '$_GET[ID]'");
            if($hapus){
                echo    "<script>
                            alert('Hapus data sukses :)');
                            document.location='index.php';
                        </script>";}
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aplikasi Sederhana Menggunakan CRUD</title>
    <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.min.css">
</head>
<body>

    <h1 class="text-center">Database Aplikasi Ikan Endemik Indonesia</h1>
    <h2 class= "text-center">Oleh: Tri Yanti (2009021)</h1>
    <hr>

<!-- Awal card form-->
<div class ="container">
    <div class="card mt-5">
        <div class="card-header bg-primary text-white">Form Input Data Ikan</div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>ID Ikan:</label>
                        <input type="text" name="tid" value= "<?=@$vid_ikan?>"class="form-control" placeholder="Input ID Ikan disini"required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ikan:</label>
                        <input type="text" name="tnama" value= "<?=@$vnama?>" class="form-control" placeholder="Input nama ikan disini"required>
                    </div>
                    <div class="form-group">
                        <label>Filum:</label>
                        <input type="text" name="tfilum" value= "<?=@$vfilum?>"class="form-control" placeholder="Input filum disini"required>
                    </div>
                    <div class="form-group">
                        <label>Kelas:</label>
                        <input type="text" name="tkelas" value= "<?=@$vkelas?>"class="form-control" placeholder="Input kelas disini"required>
                    </div>
                    <div class="form-group">
                        <label>Ordo:</label>
                        <input type="text" name="tordo" value= "<?=@$vordo?>"class="form-control" placeholder="Input ordo disini"required>
                    </div>
                    <div class="form-group">
                        <label>Famili:</label>
                        <input type="text" name="tfamili" value= "<?=@$vfamili?>"class="form-control" placeholder="Input famili disini"required>
                    </div>
                    <div class="form-group">
                        <label>Genus:</label>
                        <input type="text" name="tgenus" value= "<?=@$vgenus?>"class="form-control" placeholder="Input genus disini"required>
                    </div>
                    <div class="form-group">
                        <label>Spesies:</label>
                        <input type="text" name="tspesies" value= "<?=@$vspesies?>"class="form-control" placeholder="Input spesies disini"required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi singkat:</label>
                        <textarea class="form-control" name="tdes" placeholder="Input deskripsi singkat ikan disini"><?=@$vdeskripsi?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                    <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

                </form>
            </div>
    </div>
<!--Akhir card form-->

<!-- Awal card tabel-->
<div class ="container">
    <div class="card mt-5">
        <div class="card-header bg-success text-white">Data Ika Endemik Indonesia</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>ID_ikan</th>
                        <th>Nama Ikan</th>
                        <th>Filum</th>
                        <th>Kelas</th>
                        <th>Ordo</th>
                        <th>Famili</th>
                        <th>Genus</th>
                        <th>Spesies</th>
                        <th>Deskripsi singkat</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi,"SELECT*from tikan order by id_ikan desc");
                        while($data=mysqli_fetch_array($tampil)) :
                    ?>

                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$data['id_ikan']?></td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['filum']?></td>
                        <td><?=$data['kelas']?></td>
                        <td><?=$data['ordo']?></td>
                        <td><?=$data['famili']?></td>
                        <td><?=$data['genus']?></td>
                        <td><?=$data['spesies']?></td>
                        <td><?=$data['deskripsi']?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?=$data['id_ikan']?>" class="btn btn-warning"> Edit </a>
                            <a href="index.php?hal=hapus&id=<?=$data['id_ikan']?>"onclick="return confirm('Yakin mau dihapus?')" class="btn btn-danger"> Hapus </a>
                        </td>
                    </tr>
                    <?php endwhile; //penutup perulangan ?>
                </table>
            </div>
    </div>
<!--Akhir card tabel-->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>