<?php
namespace core\databaseConnectors;

class PDOconnectorExtended extends \PDO{  
    
    public $host;
    public $dbName;
    public $user;
    public $password;
    public $dbType;//tipos de base de datos: mysql,pgsql,sqlite,...
    public $persistance;
    
    public $isConnected;


    public function __construct($host,$dbName,$user,$password,$dbType,$persistace=false){
        $this->setConnector($host,$dbName,$user,$password,$dbType,$persistace);
    }
    
    public function setConnector($host,$dbName,$user,$password,$dbType,$persistace=false) {
        $this->host=$host;
        $this->dbName=$dbName;
        $this->user=$user;
        $this->password=$password;
        $this->dbType=$dbType;
        $this->persistance=$persistace;
    }
    
    
    public function openConnection() {
        
        if($this->isConnected==true)return;
        
        if($this->persistance) $options=array(\PDO::ATTR_PERSISTENT => true,\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION);
        else $options=array(\PDO::ATTR_PERSISTENT => false,\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION);
        
        parent::__construct(
            $this->dbType.':host='.$this->host.';dbname='.$this->dbName,
            $this->user,
            $this->password,
            $options
        );
        
        $this->isConnected=true;        
    }
    
    
}