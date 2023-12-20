<?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
          $mysqli = new mysqli("localhost", "root", "");

          // Buat database "test" (jika belum ada)
          $query = "CREATE DATABASE IF NOT EXISTS test";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
           echo "<li>Database 'test' berhasil di buat / sudah tersedia</li>";
          };

          // Pilih database "ilkoom"
          $mysqli->select_db("test");
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
            echo "<li>Database 'test' berhasil di pilih</li>";
          };

          // Hapus tabel "penduduk" (jika ada)
          $query = "DROP TABLE IF EXISTS penduduk";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }

          // Buat tabel "penduduk"
          $query = "CREATE TABLE `penduduk` (
                `id` int(11) NOT NULL auto_increment,
                `name` varchar(100) NOT NULL,
                `umur` int(3) NOT NULL,
                `asal_kota` varchar(100) NOT NULL,
                PRIMARY KEY  (`id`))";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
            echo "<li>Tabel 'penduduk' berhasil di buat</li>";
          };

          $query ="INSERT INTO penduduk (name, umur, asal_kota) VALUES ('FATUR', 25, 'JOMBANG')";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
            echo "<li>Tabel 'penduduk' berhasil di isi ".$mysqli->affected_rows."
                baris data</li>";
          };

          // Hapus tabel "user" (jika ada)
          $query = "DROP TABLE IF EXISTS user";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }

          // Buat tabel "user"
          $query = "CREATE TABLE user (
                  username VARCHAR(50) PRIMARY KEY,
                  password VARCHAR(255),
                  email VARCHAR(100)
                  )";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
            echo "<li>Tabel 'user' berhasil di buat</li>";
          };

          // Isi tabel "user"
          $passwordAdmin = password_hash('rahasia',PASSWORD_DEFAULT);

          $query = "INSERT INTO user
            (username, password, email) VALUES
              ('admin','$passwordAdmin','admin@gmail.com')
            ;";
          $mysqli->query($query);
          if ($mysqli->error){
            throw new Exception($mysqli->error, $mysqli->errno);
          }
          else {
            echo "<li>Tabel 'user' berhasil di isi ".$mysqli->affected_rows."
                baris data</li>";
          };

        ?>
        </ul>

        <hr class="w-50 mx-auto">
        <p class="lead">Database berhasil dibuat, silahkan <a href="login.php">
        Login</a> dengan username: <code>admin</code>, password: 
        <code>rahasia</code><br>Atau <a href="regist.php">Register</a> 
        untuk membuat user baru</p>

        <?php
        }
        catch (Exception $e) {
          echo "<p>Koneksi / Query bermasalah: ".$e->getMessage().
              " (".$e->getCode().")</p>";
        }
        finally {
          if (isset($mysqli)) {
            $mysqli->close();
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.js"></script>
</body>
</html>
