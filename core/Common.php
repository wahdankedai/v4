<?php 

class Common
{

    public static function buildTree(array &$elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
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

   public static function getView($file = "")
   {
       $fileTarget = ROOT . DS . 'views' . DS . $file . EXT; 

       include $fileTarget;
   }



}