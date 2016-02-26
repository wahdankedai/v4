<?php 
require 'boot.php';
require 'session.php';

if (! isset($session) || $session->auth == "") {
    Common::Error(401, 'json');
}

$id = Common::obj(Request::all());
$error = Common::obj([
    "folder" => "error",
    "tipe" => "pdf"
]);

if ($id == "") {
    Common::getView('not_authorized');
    exit;
}

if ($id->tipe == 'pdf') {
    
    $dt = Common::cekReport($id) ? Common::generateNamaReport($id) : Common::generateNamaReport($error);

    define('NAMA_LAPORAN', $dt);

    Common::cekReport($id) ? Common::getReport($id) : Common::getReport($error);

    if (file_exists(NAMA_LAPORAN)) {
    ?>
    <style type="text/css">
        #pdf {
            width: 100%;
            height: 100%;
            position: relative;
        }
    </style>
    <script type="text/javascript" src="static/js/PDFObject.js"></script>

    <div id="pdf"></div>

    <script type="text/javascript">
        var myPDF = new PDFObject({ 
                url: '<?php echo NAMA_LAPORAN; ?>',
                pdfOpenParams: {
                    navpanes: 1,
                    view: "FitV",
                    pagemode: "thumbs"
                }
            
            }).embed("pdf");
    </script>
<?php
    }
} else if ($id->tipe == 'xls') {
    echo "excel";
}
