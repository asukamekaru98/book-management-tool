<?php

class DataBaseController
{
    protected $db;

    public function __construct(DataBaseMySQL $db)
    {
        $this->db = $db;
    }
}
