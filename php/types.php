<?php

Class Produs {
    public $id;
    public $cantitate;

    public function __cosntruct($json = data) {
        if ($json) $this->set(json_decode(data, true));
    }

    public function set($data)
    {
        foreach($data as $key => $value)
        {
            if(is_array($value))
            {
                $sub = new Produs;
                $sub->set($value);
                $value = $sub;
            }
            $this->{$key} = $value;
        }
    }
}

?>