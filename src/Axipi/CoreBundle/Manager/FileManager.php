<?php
namespace Axipi\CoreBundle\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

//use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

use Axipi\CoreBundle\Manager\AbstractManager;

class FileManager extends AbstractManager
{
    //$fs = new Filesystem();

    private $root = 'files/';

    private $filesExcluded = ['.', '..', 'index.php', 'index.html', '.git', '.gitkeep', '.svn', '.DS_Store', '._.DS_Store'];

    public function getMimeType($path)
    {
        $guesser = MimeTypeGuesser::getInstance();

        return $guesser->guess($path);
    }

    public function getIcon($path)
    {
        $icon = 'file-o';
        if(is_dir($path)) {
            $icon = 'folder-o';
            if($dh = opendir($path)) {
                while(($child = readdir($dh)) !== false) {
                    if(!in_array($child, $this->filesExcluded) && substr($child, 0, 2) != '._') {
                        $icon = 'folder';
                        break;
                    }
                }
            }

        } else {
            $guesser = MimeTypeGuesser::getInstance();
            $mime = $guesser->guess($path);

            if(strstr($mime, 'image/')) {
                $icon = 'file-image-o';

            } else if(strstr($mime, 'video/')) {
                $icon = 'file-video-o';

            } else if(strstr($mime, 'text/')) {
                $icon = 'file-text-o';

            } else if(strstr($mime, 'excel') || strstr($mime, 'spreadsheetml')) {
                $icon = 'file-excel-o';

            } else if(strstr($mime, 'word')) {
                $icon = 'file-word-o';

            } else if(strstr($mime, '/pdf')) {
                $icon = 'file-pdf-o';

            } else if(strstr($mime, '/zip')) {
                $icon = 'file-zip-o';
            }
        }
        return $icon;
    }

    public function getBySlug($slug)
    {
        $slug = $this->cleanSlash($slug);

        $path = $this->root.$slug;

        $parts = explode('/', $slug);

        $file = [];
        $file['icon'] = $this->getIcon($path);
        $file['name'] = $parts[count($parts) - 1];
        $file['slug'] = $slug;
        if(is_dir($path)) {
            $file['type'] = 'folder';
        } else {
            $file['type'] = 'file';
            $file['size'] = filesize($path);
            $file['mime'] = $this->getMimeType($path);
        }
        return $file;
    }

    public function cleanSlash($slug) {
        if(substr($slug, 0, 1) == '/') {
            $slug = substr($slug, 1);
        }

        if(substr($slug, -1) == '/') {
            $slug = substr($slug, 0, -1);
        }
        return $slug;
    }

    public function getRows($slug)
    {
        $slug = $this->cleanSlash($slug);

        $dir = $this->root.$slug;

        $elements = [];
        $folders = [];
        $files = [];
        if(is_dir($dir)) {
            if($dh = opendir($dir)) {
                while(($file = readdir($dh)) !== false) {
                    if(!in_array($file, $this->filesExcluded) && substr($file, 0, 2) != '._') {
                        $element = $this->getBySlug($slug.'/'.$file);
                        if($element['type'] == 'directory') {
                            $folders[] = $element;
                        } else {
                            $files[] = $element;
                        }
                    }
                }
                closedir($dh);
            }
            sort($folders);
            sort($files);
            $elements = array_merge($folders, $files);
        }
        return $elements;
    }

    public function persist($data)
    {
        if(is_object($data->getFile()) && $data->getFile() instanceof UploadedFile) {
            if($data->getFile()->isValid()) {
                if(strstr($data->getFile()->getClientOriginalName(), '.php')) {
                    return false;
                }
                $dir = $data->getDir();
                $filename = $this->cleanString($data->getFile()->getClientOriginalName());
                $data->getFile()->move('files/'.$dir, $filename);

                return $filename;
            }
        }
    }

    public function remove($slug)
    {
        @unlink('files/'.$slug);
    }

    function cleanString($str) {
        $allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.';

        $from = explode(',', 'À,Á,Â,Ã,Ä,Å,à,á,â,ã,ä,å,Ò,Ó,Ô,Õ,Ö,Ø,ò,ó,ô,õ,ö,ø,È,É,Ê,Ë,è,é,ê,ë,Ç,ç,Ì,Í,Î,Ï,ì,í,î,ï,Ù,Ú,Û,Ü,ù,ú,û,ü,ÿ,Ñ,ñ');
        $to = explode(',', 'A,A,A,A,A,A,a,a,a,a,a,a,O,O,O,O,O,O,o,o,o,o,o,o,E,E,E,E,e,e,e,e,C,c,I,I,I,I,i,i,i,i,U,U,U,U,u,u,u,u,y,N,n');
        $str = str_replace($from, $to, $str);

        $str = strtolower($str);

        $str = str_replace('&#039;', '-', $str);
        $str = str_replace('&quot;', '', $str);
        $str = str_replace('&amp;', '-', $str);
        $str = str_replace('&lt;', '', $str);
        $str = str_replace('&gt;', '', $str);
        $str = str_replace('\'', '-', $str);
        $str = str_replace('@', '-', $str);
        $str = str_replace('(', '-', $str);
        $str = str_replace(')', '-', $str);
        $str = str_replace('#', '-', $str);
        $str = str_replace('&', '-', $str);
        $str = str_replace(' ', '-', $str);
        $str = str_replace('_', '-', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('?', '-', $str);
        $str = str_replace(':', '-', $str);
        $str = str_replace('*', '-', $str);
        $str = str_replace('|', '-', $str);
        $str = str_replace('<', '-', $str);
        $str = str_replace('>', '-', $str);
        $str = str_replace('°', '-', $str);
        $str = str_replace(',', '-', $str);

        $strlen = strlen($allowed);
        for($i=0;$i<$strlen;$i++) {
            $accepted[] = substr($allowed, $i, 1);
        }
        $newstr = '';
        $strlen = strlen($str);
        for($i=0;$i<$strlen;$i++) {
            $asc = substr($str, $i, 1);
            if(in_array($asc, $accepted)) {
                $newstr .= $asc;
            }
        }
        while(strstr($newstr, '--')) {
            $newstr = str_replace('--', '-', $newstr);
        }
        if(substr($newstr, -1) == '-') {
            $newstr = substr($newstr, 0, -1);
        }
        return $newstr;
    }
}
