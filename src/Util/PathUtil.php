<?php 
namespace App\Util;

use Cake\Core\Configure;
?>
<?php
    class PathUtil {
        public static function getFullPath($relativePath) {
            $full = Configure::read('App.fullBaseUrl');
            if (Configure::read('debug') > 0)
                $full .= '/yotellevo'; // HACK: para poder trabajar en mi PC y que pinche en el server tambien
            $full .= '/' . str_replace('\\', '/', $relativePath);
            
            return $full;
        }
    }
?>
