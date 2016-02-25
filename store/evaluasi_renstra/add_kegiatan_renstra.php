<?php 

require '../../boot.php';
require '../../session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}
$config = Config::get('evaluasi');
$req = Request::all();

$data = $req['d'];

for ($i=0; $i < count($data) ; $i++) { 
    $data[$i]['renstra'] = $config->renstra;

    $dt = DB::insertIgnore('tabel_renstra', $data[$i]);

    $da = DB::insertIgnore('indikator_anggaran_renstra', [
            'renstra' => $config->renstra,
            'kd_kegiatan' => ($data[$i]['kd_urusan'] . $data[$i]['kd_bidang'] . $data[$i]['kd_program'] . $data[$i]['kd_kegiatan']),
            'kd_unit' => $data[$i]['kd_unit'],
            'kd_subunit' => $data[$i]['kd_sub_unit']
        ]);

}


if ($dt) {
    $hasil = [
        "success" => true,
        "message" => "Data berhasil dimasukkan"  
    ];
    
} else {
    $hasil = [
        "success" => false,
        "message" => "Data gagal dimasukkan"
    ];
}

echo json_encode($hasil);


exit;