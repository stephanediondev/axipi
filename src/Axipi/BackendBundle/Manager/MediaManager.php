<?php
namespace Axipi\BackendBundle\Manager;

//use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

use Axipi\CoreBundle\Manager\AbstractManager;

class MediaManager extends AbstractManager
{
    //$fs = new Filesystem();

    private $root = 'medias/';

    private $filesExcluded = ['.', '..', 'index.php', 'index.html', '.git', '.gitkeep', '.svn', '.DS_Store', '._.DS_Store'];

    public function getMimeType($path)
    {
        $guesser = MimeTypeGuesser::getInstance();

        return $guesser->guess($path);
    }

    public function getIcon($path)
    {
        $icon = 'square-o';
        if(is_dir($path)) {
            $icon = 'folder';
        } else {
            $guesser = MimeTypeGuesser::getInstance();
            $mime = $guesser->guess($path);

            if(strstr($mime, 'image/')) {
                $icon = 'file-image-o';

            } else if(strstr($mime, 'video/')) {
                $icon = 'file-video-o';

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

        $media = [];
        $media['icon'] = $this->getIcon($path);
        $media['name'] = $parts[count($parts) - 1];
        $media['slug'] = $slug;
        $media['size'] = filesize($path);
        $media['mime'] = $this->getMimeType($path);
        return $media;
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
        if(is_dir($dir)) {
            if($dh = opendir($dir)) {
                while(($file = readdir($dh)) !== false) {
                    if(!in_array($file, $this->filesExcluded)) {
                        $elements[] = ['icon' => $this->getIcon($dir.'/'.$file), 'name' => $file, 'slug' => $this->cleanSlash($slug.'/'.$file)];
                    }
                }
                closedir($dh);
            }
        }
        return $elements;
    }

    public function persist($data)
    {
        if($data->getDateCreated() == null) {
            $data->setDateCreated(new \Datetime());
        }
        $data->setDateModified(new \Datetime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($type)
    {
        $this->em->remove($type);
        $this->em->flush();
    }
}
