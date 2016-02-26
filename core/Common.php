<?php 

class Common
{

    public static function buildTree(array &$elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = self::buildTree($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

   public static function cekView($file = "")
   {
        $fileTarget = ROOT . DS . 'views' . DS . $file . EXT; 
        return file_exists($fileTarget);
   }

   public static function cekReport($param)
   {
        if (! isset($param->folder) || ! isset($param->tipe)) {
          return false;
        }

        $fileTarget = REPORT . DS . strtolower(str_replace(" ", "_", $param->folder)) . DS . $param->tipe . EXT; 
        return file_exists($fileTarget);
   }

   public static function getView($file = "")
   {
       $fileTarget = ROOT . DS . 'views' . DS . $file . EXT; 

       include $fileTarget;
   }

   public static function getReport($param)
   {

       $fileTarget = REPORT . DS . strtolower(str_replace(" ", "_", $param->folder)) . DS . $param->tipe . EXT; 

       include $fileTarget;
   }

   public static function Error($file = "")
   {
       $fileTarget = ROOT . DS . 'views' . DS . 'error' . DS . $file . EXT; 

       include $fileTarget;
   }

   public static function generateNamaReport($param)
   {
      if (! isset($param->folder) || ! isset($param->tipe)) {
          return false;
      }

      return 'report/pdf_file/' . str_replace(" ", "_", $param->folder) . "_" . time() . '.' . $param->tipe;
   }

   public static function obj(array $dt)
   {
     return json_decode(json_encode($dt));
   }

   public static function trickRequest(array $req)
   {
      if (isset($req["kode"]) && isset($req["tipe"]) && isset($req["nama"])) {
        $kode = 'kd_' .$req['tipe'];
        $nama = 'nm_' .$req['tipe'];

        $req[$kode] = $req["kode"];
        $req[$nama] = $req["nama"];

        unset($req["kode"]);
        unset($req["nama"]);

      }
      
      return $req;
    
   }

   public static function toNULL($value ='')
   {
      return $value == '' ? 'NULL' : $value;
   }
}