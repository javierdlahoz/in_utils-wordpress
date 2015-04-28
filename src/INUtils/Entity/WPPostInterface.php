<?php
namespace INUtils\Entity;

interface WPPostInterface
{    
    public function getId();
    public function getDate();
    public function setDate($date);
    public function getContent();
    public function getPermalink();
    public function getImage();
    public function getType();
    public function getTitle();
    public function setContent($content);
    public function setType($type);
    public function setTitle($title);
    public function getMetaField($fieldName);
    public function setMetaField($fieldName, $fieldValue);
    public function getFormattedDate($format = "j M Y");
    public function getChildren();
    public function getName();
    public function setName($name);
}