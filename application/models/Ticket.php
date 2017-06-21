<?php

class Application_Model_Ticket
{
    protected $_title;
    protected $_detail;
    protected $_priority;
    protected $_created;
    protected $_attachment;
    protected $_id;

    public function __construct(array $options = null)
    {
        if(is_array($options)){
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if(('mapper'==$name) || !method_exists($this,$method)){
            throw new Exception('Invalid ticket property');
        }
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid ticket property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setTitle($text)
    {
        $this->_title = (string) $text;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setDetail($text)
    {
        $this->_detail = (string) $text;
        return $this;
    }

    public function getDetail()
    {
        return $this->_detail;
    }

    public function setPriority($text)
    {
        $this->_priority = (string) $text;
        return $this;
    }

    public function getPriority()
    {
        return $this->_priority;
    }

    public function setCreated($text)
    {
        $this->_created = (string) $text;
        return $this;
    }

    public function getCreated()
    {
        return $this->_created;
    }

    public function setAttachment($text)
    {
        $this->_attachment = (string) $text;
        return $this;
    }

    public function getAttachment()
    {
        return $this->_attachment;
    }

    public function setId($text)
    {
        $this->_id = (string) $text;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
}