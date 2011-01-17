<?php 
class PearCacheLiteAdapter extends CahceAdapter
{
    public function get($id, $group = 'default', $isCheckCahceValidity = true)
    {
        return $this->cache->get($id, $group, !$isCheckCahceValidity);
    }
    
    public function put($data, $id = null, $group = 'default')
    {
        $res =  $this->cache->save($data, $id, $group);
        
        if ( !$res ) {
            throw new CahceException();
        }
        
        return $res;        
    }
    
    public function remove($id , $group = 'default')
    {
        $this->cache->remove($id, $group);
    }

    public function clean($group = false)
    {
        $this->cache->clean($group);
    }
}
?>