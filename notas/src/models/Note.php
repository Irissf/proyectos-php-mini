<?php

namespace irisphp\Notas\lib\Database;
use irisphp\notas\lib\Database;

class Note extends Database
{

    private string $uuid;

    public function __construct( string $title, string $content) 
    {
        parent::__construct();

        $this->uuid = uniqid(); //genera un valor unico
    }

    public function save()
    {
        $query = $this->connect()->prepare("INSERT INTO notes(uuid, title, content, updated) VALUES (:uuid,:title,:content,NOW())");
        $query->execute(['title' => $this->title, 'uuid'=> $this->uuid, 'content'=>$this->content]);
    }

    public function update()
    {
        $query = $this->connect()->prepare("UPDATE notes SET title = :title, content = :content, upadated = NOW() WHERE uuid = :uuid");
        $query->execute(['title' => $this->title, 'uuid'=> $this->uuid, 'content'=>$this->content]);
    }

    //con static podemos llamarlo sin inicializar el objeto
    public static function get($uuid)
    {
        //en static no tenemos acceso a this, ya que es como un encapsulamiento a parte
        $db = new Database();
        $query = $db->connect()->prepare("SELECT * FROM notes WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
    }

    public function getUUID()
    {
        return $this->uuid;
    }

    public function setUUID($value)
    {
        $this->uuid = $value;
    }
}

?>