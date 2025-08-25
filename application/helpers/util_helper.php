<?php
function setMessage($process, $action){
	if ($process) {
		return [
			"result" => true,
			"message" => "<div class='alert alert-success text-dark' role='alert'>Berhasil " . $action . " data</div>"
		];
	} else {
		return [
			"result" => false,
			"message" => "<div class='alert alert-danger text-dark' role='alert'>Gagal " . $action . " data</div>"
		];
	}
}
?>
