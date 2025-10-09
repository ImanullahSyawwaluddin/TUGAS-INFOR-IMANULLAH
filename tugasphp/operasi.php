<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $angka1 = floatval($_POST['angka1'] ?? 0);
    $angka2 = floatval($_POST['angka2'] ?? 0);
    $operasi = $_POST['operasi'] ?? '';

    switch ($operasi) {
        case 'tambah':
            $result = $angka1 + $angka2;
            break;
        case 'kurang':
            $result = $angka1 - $angka2;
            break;
        case 'kali':
            $result = $angka1 * $angka2;
            break;
        case 'bagi':
            if ($angka2 == 0) {
                $result = 'Error: Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $result = $angka1 / $angka2;
            }
            break;
        default:
            $result = 'Operasi tidak valid.';
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Operasi Matematika</title></head>
<body>
<h2>Operasi Matematika</h2>
<form method="post" action="">
    Angka 1: <input type="number" step="any" name="angka1" required><br><br>
    Angka 2: <input type="number" step="any" name="angka2" required><br><br>
    Operasi:
    <select name="operasi" required>
        <option value="">--Pilih--</option>
        <option value="tambah">Tambah (+)</option>
        <option value="kurang">Kurang (-)</option>
        <option value="kali">Kali (×)</option>
        <option value="bagi">Bagi (÷)</option>
    </select><br><br>
    <button type="submit">Hitung</button>
</form>

<?php if ($result !== ''): ?>
    <h3>Hasil: <?=is_numeric($result) ? $result : htmlspecialchars($result)?></h3>
<?php endif; ?>

<p><a href="menu.php">Kembali ke Menu</a></p>
</body>
</html>