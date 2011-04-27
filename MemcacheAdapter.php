<?php 
class MemcacheAdapter extends CacheAdapter
{
    public function increment($name, $delta = 1)
    {
        return $this->cache->increment($name, $delta);
    }
    
    public function set($name, $value, $group = 'default')
    {
        return $this->cache->set($name, $value);
    }
    
    public function get($name, $group = 'default', $isCheckCahceValidity = true)
    {
        return $this->cache->get($name);
    }
    
    public function remove($name, $group = 'default')
    {
        $this->cache->delete($name);
    }

    public function clean($group = false)
    {
        $this->cache->flush($group);
    }
    
}
?>