<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tambah Data</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Data</h2>
        <form action="addAction.php" method="post" name="add">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="umur" id=	"umur">
                </div>
            </div>
            <div class="form-group row">
                <label for="asalKota" class="col-sm-2 col-form-label">Asal Kota</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="asal_kota" id="asal_kota">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional: Add Bootstrap's JavaScript and Popper.js for enhanced functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
