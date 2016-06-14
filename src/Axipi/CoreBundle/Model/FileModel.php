<?php
namespace Axipi\CoreBundle\Model;

class FileModel
{
    protected $file;

    protected $dir;

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setDir($dir)
    {
        $this->dir = $dir;
    }

    public function getDir()
    {
        return $this->dir;
    }
}
