<?php 
class PearCacheLiteAdapter extends CacheAdapter
{
    private static $_counter = 0;
    
    public function increment($name, $delta = 1)
    {
        return $this->_counter += $delta;
    }
    
    public function get($id, $group = 'default', $isCheckCahceValidity = true)
    {
        return $this->cache->get($id, $group, !$isCheckCahceValidity);
    }
    
    public function set($id, $data, $group = 'default')
    {
        $res =  $this->cache->save($data, $id, $group);
        
        if ( !$res ) {
            throw new CahceException();
        }
        
        return $res;        
    }
    
    public function remove($id, $group = 'default')
    {
        $this->cache->remove($id, $group);
    }

    public function clean($group = false)
    {
        $this->cache->clean($group);
    }
    
	public function addItem($key, $value)
    {
    	throw new CahceException(_('Memcache adapter does not support addItem method'));
    }
    
    public function removeItem($key, $value)
    {
    	throw new CahceException(_('Memcache adapter does not support removeItem method'));
    }
}
?>