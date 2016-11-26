PhpOrient\Protocols\Binary\SocketTransport
===============






* Class name: SocketTransport
* Namespace: PhpOrient\Protocols\Binary
* Parent class: [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)





Properties
----------


#### $inTransaction
```php
    public boolean $inTransaction = false
```
 If a transaction started



* Visibility: **public**


#### $databaseOpened
```php
    public boolean $databaseOpened = false
```
 Flag needed to know if a database is opened or not



* Visibility: **public**


#### $databaseName
```php
    public string $databaseName
```
 The database actually open



* Visibility: **public**


#### $connected
```php
    public boolean $connected = false
```
 Flag needed to know if connected to the server



* Visibility: **public**


#### $_socket
```php
    protected \PhpOrient\Protocols\Binary\OrientSocket $_socket
```
 



* Visibility: **protected**


#### $sessionId
```php
    protected integer $sessionId = -1
```
 



* Visibility: **protected**


#### $token
```php
    protected string $token = ''
```
 



* Visibility: **protected**


#### $requestToken
```php
    protected boolean $requestToken = false
```
 With this flag a session with token is requested



* Visibility: **protected**


#### $_protocolVersion
```php
    protected integer $_protocolVersion
```
 



* Visibility: **protected**


#### $hostname
```php
    protected string $hostname
```
 



* Visibility: **protected**


#### $port
```php
    protected string $port
```
 



* Visibility: **protected**


#### $username
```php
    protected string $username
```
 



* Visibility: **protected**


#### $password
```php
    protected string $password
```
 



* Visibility: **protected**


#### $clusterMap
```php
    protected \PhpOrient\Protocols\Common\ClustersMap $clusterMap
```
 



* Visibility: **protected**


#### $nodesList
```php
    protected array<mixed,\PhpOrient\Protocols\Common\OrientNode> $nodesList
```
 



* Visibility: **protected**


#### $_logger
```php
    protected \Psr\Log\LoggerInterface $_logger
```
 



* Visibility: **protected**


#### $orientVersion
```php
    protected \PhpOrient\Protocols\Common\OrientVersion $orientVersion
```
 



* Visibility: **protected**


Methods
-------


### getProtocolVersion
```php
    integer PhpOrient\Protocols\Binary\SocketTransport::getProtocolVersion()
```
##### Gets the version of negotiated protocol



* Visibility: **public**




### setProtocolVersion
```php
    mixed PhpOrient\Protocols\Binary\SocketTransport::setProtocolVersion(integer $protocolVersion)
```
##### 



* Visibility: **public**


##### Arguments
* $protocolVersion **integer**



### getSessionId
```php
    integer PhpOrient\Protocols\Binary\SocketTransport::getSessionId()
```
##### Gets the session ID for current connection



* Visibility: **public**




### setSessionId
```php
    \PhpOrient\Protocols\Binary\SocketTransport PhpOrient\Protocols\Binary\SocketTransport::setSessionId($sessionId)
```
##### 



* Visibility: **public**


##### Arguments
* $sessionId **mixed**



### getToken
```php
    string PhpOrient\Protocols\Binary\SocketTransport::getToken()
```
##### 



* Visibility: **public**




### setToken
```php
    \PhpOrient\Protocols\Binary\SocketTransport PhpOrient\Protocols\Binary\SocketTransport::setToken(string $token)
```
##### 



* Visibility: **public**


##### Arguments
* $token **string**



### isRequestToken
```php
    boolean PhpOrient\Protocols\Binary\SocketTransport::isRequestToken()
```
##### 



* Visibility: **public**




### setRequestToken
```php
    \PhpOrient\Protocols\Binary\SocketTransport PhpOrient\Protocols\Binary\SocketTransport::setRequestToken(boolean $requestToken)
```
##### Set the client to get and send the token



* Visibility: **public**


##### Arguments
* $requestToken **boolean**



### getSocket
```php
    \PhpOrient\Protocols\Binary\OrientSocket PhpOrient\Protocols\Binary\SocketTransport::getSocket()
```
##### Gets the Socket, and establishes the connection if required.



* Visibility: **public**




### execute
```php
    mixed PhpOrient\Protocols\Common\TransportInterface::execute(string $operation, array $params)
```
##### Execute the operation with the given name.



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\TransportInterface](PhpOrient-Protocols-Common-TransportInterface)


##### Arguments
* $operation **string** <p>The operation to prepare.</p>
* $params **array** <p>The parameters for the operation.</p>



### operationFactory
```php
    \PhpOrient\Protocols\Binary\Abstracts\Operation PhpOrient\Protocols\Binary\SocketTransport::operationFactory(\PhpOrient\Protocols\Binary\Abstracts\Operation|string $operation, array $params)
```
##### 



* Visibility: **protected**


##### Arguments
* $operation **[PhpOrient\Protocols\Binary\Abstracts\Operation](PhpOrient-Protocols-Binary-Abstracts-Operation)|string** <p>The operation name or instance.</p>
* $params **array** <p>The parameters for the operation.</p>



### _hexDump
```php
    string|null PhpOrient\Protocols\Binary\SocketTransport::_hexDump(string $data, boolean $htmlOutput, boolean $uppercase)
```
##### View any string as a hexDump.

This is most commonly used to view binary data from streams
or sockets while debugging, but can be used to view any string
with non-viewable characters.

* Visibility: **public**
* This method is **static**.


##### Arguments
* $data **string** <p>The string to be dumped</p>
* $htmlOutput **boolean** <p>Set to false for non-HTML output</p>
* $uppercase **boolean** <p>Set to true for uppercase hex</p>



### hexDump
```php
    mixed PhpOrient\Protocols\Binary\SocketTransport::hexDump($message)
```
##### Dump data stream to HexDec format



* Visibility: **public**


##### Arguments
* $message **mixed**



### __construct
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::__construct()
```
##### Class Constructor



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### setLogger
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::setLogger()
```
##### Set the client Logger



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### getLogger
```php
    \Psr\Log\LoggerInterface PhpOrient\Protocols\Common\AbstractTransport::getLogger()
```
##### Get the Logger from transport



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### debug
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::debug($message)
```
##### Debug method



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $message **mixed**



### getClusterMap
```php
    \PhpOrient\Protocols\Common\ClustersMap PhpOrient\Protocols\Common\AbstractTransport::getClusterMap()
```
##### 



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### setClustersMap
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::setClustersMap(\PhpOrient\Protocols\Common\ClustersMap $clusterList)
```
##### 



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $clusterList **[PhpOrient\Protocols\Common\ClustersMap](PhpOrient-Protocols-Common-ClustersMap)**



### getTransaction
```php
    \PhpOrient\Protocols\Binary\Transaction\TxCommit PhpOrient\Protocols\Common\AbstractTransport::getTransaction()
```
##### Retrieve a new transaction instance



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### getNodesList
```php
    array<mixed,\PhpOrient\Protocols\Common\OrientNode> PhpOrient\Protocols\Common\AbstractTransport::getNodesList(boolean|false $filterActualNode)
```
##### Retrieve the nodes list, optionally filter excluding the actual one

//TODO Improve with different protocol types handler if another transport protocol are implemented

* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $filterActualNode **boolean|false**



### setNodesList
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::setNodesList(array<mixed,\PhpOrient\Protocols\Common\OrientNode> $nodesList)
```
##### 



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $nodesList **array&lt;mixed,\PhpOrient\Protocols\Common\OrientNode&gt;**



### getOrientVersion
```php
    \PhpOrient\Protocols\Common\OrientVersion PhpOrient\Protocols\Common\AbstractTransport::getOrientVersion()
```
##### 



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)




### setOrientVersion
```php
    mixed PhpOrient\Protocols\Common\AbstractTransport::setOrientVersion(\PhpOrient\Protocols\Common\OrientVersion $orientVersion)
```
##### 



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $orientVersion **[PhpOrient\Protocols\Common\OrientVersion](PhpOrient-Protocols-Common-OrientVersion)**



### configure
```php
    \PhpOrient\Protocols\Common\ConfigurableInterface PhpOrient\Protocols\Common\ConfigurableInterface::configure(array $options)
```
##### Configure the object.



* Visibility: **public**
* This method is defined by [PhpOrient\Protocols\Common\ConfigurableInterface](PhpOrient-Protocols-Common-ConfigurableInterface)


##### Arguments
* $options **array** <p>The options for the object.</p>



### fromConfig
```php
    static PhpOrient\Protocols\Common\AbstractTransport::fromConfig(array $options)
```
##### Return a new class instance configured from the given options.



* Visibility: **public**
* This method is **static**.
* This method is defined by [PhpOrient\Protocols\Common\AbstractTransport](PhpOrient-Protocols-Common-AbstractTransport)


##### Arguments
* $options **array** <p>The options for the newly created class instance.</p>


