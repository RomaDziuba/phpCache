<?php 
class MemcachedAdapter extends CacheAdapter
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
    
	public function addItem($key, $value)
    {
    	do {
		    $values = $this->cache->get($key, null, $cas_token);
		    
		    $keyItem = md5($value);
		    
		    if ($this->cache->getResultCode() == Memcached::RES_NOTFOUND) {
		        $values = array(
		        	$keyItem => $value
		        );
		        $this->cache->add($key, $values);
		    } else { 
		        $values[$keyItem] = $value;
		        $this->cache->cas($cas_token, $key, $values);
		    }
		} while ($this->cache->getResultCode() != Memcached::RES_SUCCESS);
    } // end addItem
    
    public function removeItem($key, $value)
    {
    	do {
    		$values = $this->cache->get($key, null, $cas_token);
    		
			$loopFlag = true;
    		$keyItem = md5($value);
    		
    		if ($this->cache->getResultCode() == Memcached::RES_NOTFOUND || !isset($values[$keyItem])) {
    			$loopFlag = false;
    		} else {
    			unset($values[$keyItem]);
    			
    			$this->cache->cas($cas_token, $key, $values);
    		}
    	} while ($this->cache->getResultCode() != Memcached::RES_SUCCESS && $loopFlag);
    } // end removeItem
    
}
?>