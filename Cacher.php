<?php 

require_once dirname(__FILE__).'/CacheException.php';

class Cacher
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

            default:
                $libName = $currentClass;
                break;
        } // end switch
        
        $className = $libName.'Adapter';
        $path = dirname(__FILE__).'/'.$className.'.php';
        
        require_once dirname(__FILE__).'/CacheAdapter.php';
        if(!include_once($path)) {
            throw new SystemException(_('Cache Adapter not installed'));
        }
        
        $instance = new $className($cahce);
        
        return new self($instance);
    } // end factory
    
    public function increment($name, $delta = 1)
    {
        return $this->adapter->increment($name, $delta);
    }
    
    public function set($name, $value, $group = 'default')
    {
        return $this->adapter->set($name, $value, $group);
    }
    
    public function get($name, $group = 'default', $isCheckCahceValidity = true)
    {
        return $this->adapter->get($name, $group, $isCheckCahceValidity);
    }
    
    public function remove($name, $group = 'default')
    {
        $this->adapter->delete($name, $group);
    }

    public function clean($group = false)
    {
        $this->adapter->clean($group);
    }
    
}
?>