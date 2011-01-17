<?php 
abstract class CahceAdapter 
{
    protected $cache;
    
    public function __construct(&$cache) 
    {
        $this->cache = $cache;
    }
    
    abstract public function get($id, $group = 'default', $isCheckCahceValidity = true);
    
    abstract public function put($data, $id = null, $group = 'default');
    
    abstract public function remove($id , $group = 'default');

    abstract public function clean($group = false);
}
?>