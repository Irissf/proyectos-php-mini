<?php

namespace irisphp\Notas\lib\Database;
use irisphp\notas\lib\Database;

class Note extends Database
{

    private string $uuid;

    public function __construct(string $title,string $content) 
    {
        parent::__construct();

        $this->uuid = uniqid(); //genera un valor unico
    }

    public function save()
    {
        $query = $this->connect()->prepare("INSERT INTO notes(uuid, title, content, updated) VALUES (:uuid,:title,:content,NOW())");
        $query->execute(['title' => $this->title, 'uuid'=> $this->uuid, 'content'=>$this->content]);
    }
}

?>