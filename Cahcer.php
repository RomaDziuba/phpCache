<?php 

require_once dirname(__FILE__).'/CahceException.php';

class Cahcer
{
    protected $adapter;
    
    public function __construct(&$adapter) 
    {
        $this->adapter = $adapter;
    }
    
    public static function factory(&$cahce)
    {
        $libName = false;
        $parentClass = get_parent_class($cahce);
        $currentClass = get_class($cahce);
        switch($currentClass) {
            case 'Cache_Lite':
                $libName = 'PearCacheLite';
                break;
        } // end switch
        
        if(!$libName) {
            throw new SystemException( _('Cache Adapter not found') );
        }

        
        $className = $libName.'Adapter';
        $path = dirname(__FILE__).'/'.$className.'.php';
        
        require_once dirname(__FILE__).'/CacheAdapter.php';
        if(!include_once($path)) {
            throw new SystemException(_('Cache Adapter not installed'));
        }
        
        $instance = new $className($cahce);
        
        return new Cahcer($instance);
    } // end factory
    
    public function get($id, $group = 'default', $isCheckCahceValidity = true)
    {
        return $this->adapter->get($id, $group, $isCheckCahceValidity);
    }
    
    public function put($data, $id = null, $group = 'default')
    {
        return $this->adapter->put($data, $id, $group);
    }
    
    public function remove($id , $group = 'default')
    {
        $this->adapter->remove($id, $group);
    }

    public function clean($group = false)
    {
        $this->adapter->clean($group);
    }
}
?>