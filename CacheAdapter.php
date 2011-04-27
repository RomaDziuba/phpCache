<?php 
abstract class CacheAdapter 
{
    protected $cache;
    
    public function __construct(&$cache) 
    {
        $this->cache = $cache;
    }
    
    abstract function increment($name, $delta);
    
    abstract public function get($name, $group = 'default', $isCheckCahceValidity = true);
    
    abstract public function set($name, $value, $group = 'default');
    
    abstract public function remove($name , $group = 'default');

    abstract public function clean($group = false);
}
?>