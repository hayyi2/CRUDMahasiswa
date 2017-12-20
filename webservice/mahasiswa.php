<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

$host 		= "localhost"; 
$username 	= "root"; 
$password 	= ""; 
$dbname 	= "ade_db";

$pdo = new PDO("mysql:host=$host;dbname=$dbname" , $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false );
$db = $pdo;

$data = array();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if (!isset($_GET['id'])) {
			$result = $db->prepare("select * from mahasiswa");
			$result->execute();

			$data = array(true, $result->fetchAll());
		}else{
			$result = $db->prepare("select * from mahasiswa where id_mahasiswa=" . $_GET['id']);
			$result->execute();

			$data = $result->fetchAll();
			if (count($data) == 1) {
				$data = array(true, $data[0]);
			}else{
				$data = array(false, 'Data tidak ditemukan.');
			}
		}
		break;
	case 'POST':
		$rules = (
			isset($_POST['nim']) &&
			isset($_POST['nama']) &&
			isset($_POST['tanggal_lahir']) &&
			isset($_POST['jenjang']) &&
			isset($_POST['jurusan']) &&
			isset($_POST['prodi']) &&
			isset($_POST['seleksi']) &&
			isset($_POST['nomor'])
		);
		if ($rules) {
			$result = $db->prepare("insert into mahasiswa ( nim, nama, tanggal_lahir, jenjang, jurusan, prodi, seleksi, nomor) value ( "
					. "'" . $_POST['nim'] . "', "
					. "'" . $_POST['nama'] . "', "
					. "'" . $_POST['tanggal_lahir'] . "', "
					. "'" . $_POST['jenjang'] . "', "
					. "'" . $_POST['jurusan'] . "', "
					. "'" . $_POST['prodi'] . "', "
					. "'" . $_POST['seleksi'] . "', "
					. "'" . $_POST['nomor'] . "'"
				. " )");
			$result->execute();

			$data = array(true, "Success.");
		}else{
			$data = array(false, "Error.");
		}
		break;
	case 'PUT':
		if (isset($_GET['id'])) {
			$result = $db->prepare("select * from mahasiswa where id_mahasiswa=" . $_GET['id']);
			$result->execute();

			$data = $result->fetchAll();
			if (count($data) == 1) {
				parse_str(file_get_contents("php://input"),$put);
				$rules = (
					isset($put['nim']) &&
					isset($put['nama']) &&
					isset($put['tanggal_lahir']) &&
					isset($put['jenjang']) &&
					isset($put['jurusan']) &&
					isset($put['prodi']) &&
					isset($put['seleksi']) &&
					isset($put['nomor'])
				);
				if ($rules) {
					$result = $db->prepare("update mahasiswa set "
							. "nim='" . $put['nim'] . "', "
							. "nama='" . $put['nama'] . "', "
							. "tanggal_lahir='" . $put['tanggal_lahir'] . "', "
							. "jenjang='" . $put['jenjang'] . "', "
							. "jurusan='" . $put['jurusan'] . "', "
							. "prodi='" . $put['prodi'] . "', "
							. "seleksi='" . $put['seleksi'] . "', "
							. "nomor='" . $put['nomor'] . "'"
						. " where id_mahasiswa=" . $_GET['id']);
					$result->execute();

					$data = array(true, "Success.");
				}else{
					$data = array(false, "Error.");
				}
			}else{
				$data = array(false, 'Data tidak ditemukan.');
			}
		}else{
			$data = array(false, 'Data tidak ditemukan.');
		}
		break;
	case 'DELETE':
		if (isset($_GET['id'])) {
			$result = $db->prepare("select * from mahasiswa where id_mahasiswa=" . $_GET['id']);
			$result->execute();

			$data = $result->fetchAll();
			if (count($data) == 1) {
				$result = $db->prepare("delete from mahasiswa where id_mahasiswa=" . $_GET['id']);
				$result->execute();

				$data = array(true, "Success.");
			}else{
				$data = array(false, "Error.");
			}
		}else{
			$data = array(false, 'Data tidak ditemukan.');
		}
		break;
}

header('Content-Type:application/json;charset=utf-8');
echo json_encode($data);