<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$bangun = $_POST['bangun'] ?? '';
$luas = '';
$error = '';

function hitung_luas($bangun, $data) {
    switch ($bangun) {
        case 'persegi':
            return $data['sisi'] * $data['sisi'];
        case 'persegipanjang':
            return $data['panjang'] * $data['lebar'];
        case 'segitiga':
            return 0.5 * $data['alas'] * $data['tinggi'];
        case 'lingkaran':
            return pi() * pow($data['jari'], 2);
        case 'jajargenjang':
            return $data['alas'] * $data['tinggi'];
        default:
            return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hitung'])) {
    switch ($bangun) {
        case 'persegi':
            $sisi = floatval($_POST['sisi'] ?? 0);
            if ($sisi <= 0) $error = 'Sisi harus lebih dari 0.';
            else $luas = hitung_luas('persegi', ['sisi' => $sisi]);
            break;
        case 'persegipanjang':
            $panjang = floatval($_POST['panjang'] ?? 0);
            $lebar = floatval($_POST['lebar'] ?? 0);
            if ($panjang <= 0 || $lebar <= 0) $error = 'Panjang dan lebar harus lebih dari 0.';
            else $luas = hitung_luas('persegipanjang', ['panjang' => $panjang, 'lebar' => $lebar]);
            break;
        case 'segitiga':
            $alas = floatval($_POST['alas'] ?? 0);
            $tinggi = floatval($_POST['tinggi'] ?? 0);
            if ($alas <= 0 || $tinggi <= 0) $error = 'Alas dan tinggi harus lebih dari 0.';
            else $luas = hitung_luas('segitiga', ['alas' => $alas, 'tinggi' => $tinggi]);
            break;
        case 'lingkaran':
            $jari = floatval($_POST['jari'] ?? 0);
            if ($jari <= 0) $error = 'Jari-jari harus lebih dari 0.';
            else $luas = hitung_luas('lingkaran', ['jari' => $jari]);
            break;
        case 'jajargenjang':
            $alas = floatval($_POST['alas'] ?? 0);
            $tinggi = floatval($_POST['tinggi'] ?? 0);
            if ($alas <= 0 || $tinggi <= 0) $error = 'Alas dan tinggi harus lebih dari 0.';
            else $luas = hitung_luas('jajargenjang', ['alas' => $alas, 'tinggi' => $tinggi]);
            break;
        default:
            $error = 'Bangun tidak valid.';
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Mencari Luas Bangun</title></head>
<body>
<h2>Mencari Luas Bangun</h2>

<form method="post" action="">
    Pilih Bangun:
    <select name="bangun" onchange="this.form.submit()" required>
        <option value="">--Pilih--</option>
        <option value="persegi" <?= $bangun === 'persegi' ? 'selected' : '' ?>>Persegi</option>
        <option value="persegipanjang" <?= $bangun === 'persegipanjang' ? 'selected' : '' ?>>Persegi Panjang</option>
        <option value="segitiga" <?= $bangun === 'segitiga' ? 'selected' : '' ?>>Segitiga</option>
        <option value="lingkaran" <?= $bangun === 'lingkaran' ? 'selected' : '' ?>>Lingkaran</option>
        <option value="jajargenjang" <?= $bangun === 'jajargenjang' ? 'selected' : '' ?>>Jajargenjang</option>
    </select>
</form>

<?php if ($bangun): ?>
<form method="post" action="">
    <input type="hidden" name="bangun" value="<?=htmlspecialchars($bangun)?>">
    <?php if ($bangun === 'persegi'): ?>
        Sisi: <input type="number" step="any" name="sisi" required><br><br>
    <?php elseif ($bangun === 'persegipanjang'): ?>
        Panjang: <input type="number" step="any" name="panjang" required><br><br>
        Lebar: <input type="number" step="any" name="lebar" required><br><br>
    <?php elseif ($bangun === 'segitiga'): ?>
        Alas: <input type="number" step="any" name="alas" required><br><br>
        Tinggi: <input type="number" step="any" name="tinggi" required><br><br>
    <?php elseif ($bangun === 'lingkaran'): ?>
        Jari-jari: <input type="number" step="any" name="jari" required><br><br>
    <?php elseif ($bangun === 'jajargenjang'): ?>
        Alas: <input type="number" step="any" name="alas" required><br><br>
        Tinggi: <input type="number" step="any" name="tinggi" required><br><br>
    <?php endif; ?>
    <button type="submit" name="hitung">Hitung Luas</button>
</form>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color:red;"><?=htmlspecialchars($error)?></p>
<?php elseif ($luas !== ''): ?>
    <h3>Luas <?=htmlspecialchars($bangun)?> = <?=round($luas, 2)?></h3>
<?php endif; ?>

<p><a href="menu.php">Kembali ke Menu</a></p>
</body>
</html>