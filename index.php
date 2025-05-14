<?php

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Asia/Jakarta');
}

require_once 'Configs/database.php';
require_once 'Configs/helpers.php';
require_once 'Controllers/BukuTamuController.php';

$bukuTamuController = new BukuTamuController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_tamu'])) {
    $bukuTamuController->createTamu($_POST['nama'], $_POST['instansi'], $_POST['tujuan']);
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_tamu_id'])) {
    $bukuTamuController->deleteTamu($_POST['delete_tamu_id']);
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_tamu_id'])) {
    $bukuTamuController->updateTamu(
        $_POST['edit_tamu_id'],
        $_POST['edit_nama'],
        $_POST['edit_instansi'],
        $_POST['edit_tujuan']
    );
    header("Location: index.php");
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : null;
$result = $bukuTamuController->getAllTamu($search);
$msg = $bukuTamuController->getMessage();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'Layouts/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital | UNIVERSITAS SIBER ASIA - Ridwan Mubarok - 230401010053</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light min-vh-100 d-flex flex-column">
    <div class="flex-grow-1">
        <div class="container py-5">
            <?php if ($msg): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?php echo e($msg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light text-dark d-flex justify-content-between align-items-center">
                            <div class="fw-bold"><i class="fas fa-list"></i> Daftar Tamu</div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addGuestModal">
                                <i class="fas fa-plus"></i> Tambah Tamu
                            </button>
                        </div>
                        <div class="card-body">
                            <?php require_once 'Components/guest-list.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addGuestModal" tabindex="-1" aria-labelledby="addGuestModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addGuestModalLabel"><i class="fas fa-book"></i> Form Buku Tamu
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php require_once 'Components/add-guest-form.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once 'Layouts/footer.php'; ?>