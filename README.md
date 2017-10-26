## 目录

- [进阶学习](#进阶学习)
	- [HTTP协议详解](#HTTP协议详解)
  	- [请求报头](#请求报头)
  	- [php中获取请求信息](#php中获取请求信息)
  	- [http请求的几种方式](#http请求的几种方式)
  		- [http响应返回](#http响应返回)
  	- [下载文件处理](#下载文件处理)
  		- [普通下载](#普通下载)
  		- [断点续传](#断点续传)
- [PHP5](#php5)
	- [新增特性](#新增特性 "新增特性")
		- [类的高级用法](#类的高级用法) 
		- [instanceof 操作符](#instanceof-操作符)
		- [final 关键字](#final-关键字)
		- [clone 关键字](#clone-关键字)
		- [const 关键字](#const-关键字)
		- [静态成员和静态方法](#静态成员和静态方法)
		- [抽象类](#抽象类)
		- [抽象方法](#抽象方法)
		- [对象类型提示](#对象类型提示)
		- [函数调用](#函数调用)
		- [继承类实现Iterator接口](#继承类实现Iterator接口)
		- [__autoload()方法](#__autoload方法)
		- [foreach 函数支持引用](#foreach-函数支持引用)
		- [Tidy扩展](#tidy扩展 "Tidy扩展")
	- [基础用法](#基础用法 "基础用法")
		- [变量](#变量) 
			- [变量的间接引用](#变量的间接引用 "变量的间接引用")


----------



# 进阶学习

## HTTP协议详解

    超文本传输协议（httpwatch工具进行抓取），是建立在 tcp/ip 协议基础上
    超文本传输协议之所以叫超文本，是因为它不只可以传输文本，还可以传输音频视频等其他格式数据
    所有的web开发的数据传输都是依赖于 http 协议
         协议版本
         1、http 1.0 （短链接：已经放弃该协议，建立链接后数据发送之后直接断开）
         2、http 1.1 （长链接:长链接是会保持链接状态，跟服务器建立链接，如果服务器没有响应是有超时反馈的）
         
    一个web页面的请求会发起多次请求，首先请求的是页面文本，之后会请求图片等一系列资源    
    常识：图片的返回值是以二进制的形式返回的
    
## 请求报头

    常用请求报头
    GET /a.html HTTP/1.1            请求类型以及请求协议版本
    Accept:*/*                      数据类型（标识发送的数据类型）
    Referer:http://www.a.com        来源地址（用处很大，经常用来做防盗链功能，服务器可以判断来源地址进行访问限制）
    Accept-Language:zh-cn           页面语言
    User-Agent:Mozilla/4.0****      浏览器内核，操作系统信息（服务器可以获取这些信息并做相应的处理）
    Accept-Enocding:gzip,deflate    数据压缩格式（就是浏览器会对发送的数据进行压缩，web服务器要有相应的格式的解压功能）
    Host:localhost:80               主机名：端口，端口是可以忽略php默认80端口，传输该数据用于 tcp/ip 解析用来做域名解析使用
    Connnection:Keep-Alive          链接状态：默认就是长链接，不会与服务器立即断开
    
    消息体（通常用来存放post数据） 
                 
## php中获取请求信息
    
```php

<?php

    $_SERVER;                			//超全局变量用来存储所有http协议发送的信息
    $_SERVER['PHP_SELF']; 				//当前正在执行脚本的文件名，与 document root相关。 
    $_SERVER['argv']; 					//传递给该脚本的参数。 
    $_SERVER['argc']; 					//包含传递给程序的命令行参数的个数（如果运行在命令行模式）。 
    $_SERVER['GATEWAY_INTERFACE']; 		//服务器使用的 CGI 规范的版本。例如，“CGI/1.1”。 
    $_SERVER['SERVER_NAME']; 			//当前运行脚本所在服务器主机的名称。 
    $_SERVER['SERVER_SOFTWARE']; 		//服务器标识的字串，在响应请求时的头部中给出。 
    $_SERVER['SERVER_PROTOCOL']; 		//请求页面时通信协议的名称和版本。例如，“HTTP/1.0”。 
    $_SERVER['REQUEST_METHOD']; 		//访问页面时的请求方法。例如：“GET”、“HEAD”，“POST”，“PUT”。 
    $_SERVER['QUERY_STRING']; 			//查询(query)的字符串。 
    $_SERVER['DOCUMENT_ROOT']; 			//当前运行脚本所在的文档根目录。在服务器配置文件中定义。 
    $_SERVER['HTTP_ACCEPT']; 			//当前请求的 Accept: 头部的内容。 
	$_SERVER['HTTP_ACCEPT_CHARSET']; 	//当前请求的 Accept-Charset: 头部的内容。例如：“iso-8859-1,*,utf-8”。 
    $_SERVER['HTTP_ACCEPT_ENCODING'];	//当前请求的 Accept-Encoding: 头部的内容。例如：“gzip”。 
    $_SERVER['HTTP_ACCEPT_LANGUAGE'];	//当前请求的 Accept-Language: 头部的内容。例如：“en”。 
    $_SERVER['HTTP_CONNECTION'];		//当前请求的 Connection: 头部的内容。例如：“Keep-Alive”。 
    $_SERVER['HTTP_HOST'];				//当前请求的 Host: 头部的内容。 
    $_SERVER['HTTP_REFERER'];			//链接到当前页面的前一页面的 URL 地址。 
    $_SERVER['HTTP_USER_AGENT'];		//当前请求的 User_Agent: 头部的内容。 
    $_SERVER['HTTPS'];					//如果通过https访问,则被设为一个非空的值(on)，否则返回off 
    $_SERVER['REMOTE_ADDR'];			//正在浏览当前页面用户的 IP 地址。 
    $_SERVER['REMOTE_HOST'];			//正在浏览当前页面用户的主机名。 
    $_SERVER['REMOTE_PORT'];			//用户连接到服务器时所使用的端口。 
    $_SERVER['SCRIPT_FILENAME'];		//当前执行脚本的绝对路径名。 
    $_SERVER['SERVER_ADMIN'];			//管理员信息 
    $_SERVER['SERVER_PORT'];			//服务器所使用的端口 
    $_SERVER['SERVER_SIGNATURE'];		//包含服务器版本和虚拟主机名的字符串。 
    $_SERVER['PATH_TRANSLATED'];		//当前脚本所在文件系统（不是文档根目录）的基本路径。 
    $_SERVER['SCRIPT_NAME'];			//包含当前脚本的路径。这在页面需要指向自己时非常有用。 
    $_SERVER['REQUEST_URI'];			//访问此页面所需的 URI。例如，“/index.html”。 
    $_SERVER['PHP_AUTH_USER']; 			//当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名。 
    $_SERVER['PHP_AUTH_PW']; 			//当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码。 
    $_SERVER['AUTH_TYPE']; 				//当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认证的类型

?>

```

## http请求的几种方式
    
    PSOT、GET、HEAD、OPTIONS、DELETE、TRACE、PUT
    
    常用有：PSOT、GET
    
    POST和GET的区别：
        1、post的请求数据是放在http协议的消息体里边的
        2、HTTP协议本身是没有对传输数据进行限制，主要是浏览器在对get和post请求做限制
        3、get请求最多只能传输 2k+35 数据，post请求没有进行数据限制



### http响应返回

    状态码：例如：200    也就是请求状态，这个参考网上的解释
    其他的不再解释


    图片状态304是怎么产生的呢？
    浏览器发送图片请求时会检测本地是否缓存该文件如果存在该文件会请求时发送 If-Modified-Since 参数用来标识缓存时间，
    web服务器端会校验浏览器发送过来的 If-Modified-Since参数，判断该文件是否和服务器上的图片时间是否一致，如果一致则不再进行图片返回直接返回 304 状态码，否则会把图片传输给浏览器，并返回 200 状态码
    
    常见响应返回值解释
    
    Location:http://......
    Server:nginx    web服务器类型
    Content-Encoding:gzip    web服务器返回数据压缩使用的算法，供浏览器解码使用
    Content-Length:20121     返回的数据大小，除了数据本身的大小，还包括响应头的大小
    Content-Language:zh-cn    返回的数据语言
    Content-Type:text/html,charset=GB2312 返回的html，以及文件的编码格式。当然也可以返会的是image/jpeg 
    Content-Type:image/jpeg   当然也可以返回 image/jpeg 图片 （全部以文件mime类型来代表）
    Last-Modified:Thu, 04 May 2017 09:09:32 GMT    表示浏览器请求资源的最新时间
    Refresh:1;url=http://www.baidu.com    如果有这个返回值代表：页面响应之后会在1秒之后重定向到新的网址
    
    Expires:-1                下边这三个选项是一组用来控制浏览器 禁止 缓存该页面，为什么有三个？
    Cache-Control:no_cache    是因为不同的浏览器 禁止 缓存不一样，这是为了兼容不同的浏览器设置禁用页面缓存
    Pragma:no_cache            这三个选项可以兼容目前常见的浏览器
    
    文件下载相应后边会讲到
    

## 下载文件处理

### 普通下载


```php

<?php

    $file_name = "测试.jpg";
        
    //php读取文件名时不支持中文，所以需要对中文名称进行转码（文件名默认需要使用 gb2312 的编码）
    $file_name = iconv('utf-8', 'gb2312', $file_name);        

    if (!file_exists($file_name)) {
        echo "文件不存在";
        exit;
    }
        
    //获取文件大小，以字节为单位
    $file_size = filesize($file_name);
        
    //打开文件,可读方式打开
    $file = fopen($file_name, 'r');
        
    //返回数据给浏览器
    //下载文件需要的头
    header("Content-type: application/octet-stream"); //告知浏览器返回的是流文件的形式
    header("Accept-Ranges: bytes");    //按字节返回文件内容
    header("Accept-Length: $file_size"); //返回文件大小
    //这里可以设置浏览器端下载窗口所显示的文件名称
    header("Content-Disposition: attachment; filename=". $file_name);
        
    //定义缓冲区大小,字节为单位
    $buffer_size = 1024; 
        
    //为了保证 feof($file) 的可用性，可以考虑做一个文件字节读取计数器
    $file_count = 0;
        
    //向客户端循环发送数据，这样可以避免瞬间压力， feof用来判断文件指针是否到结尾
    while( !feof($file) && (($file_size - $file_count) > 0)){
        $buffer_data = fread($file, $buffer);
        $file_count += $buffer;
        //把部分数据回送给浏览器
        echo $buffer_data;
    }
        
    fclose($file);
?>

```

### 断点续传
    
```php

<?php

/** php下载类,支持断点续传
 *  Date:  2013-06-30
 *  Author: test
 *  Ver:  1.0  *
 *  Func:
 *  download: 下载文件
 *  setSpeed: 设置下载速度
 *  getRange: 获取header中Range
 */
class FileDownload
{
    // class start
    private $_speed = 512;  // 下载速度

    /** 下载
     * @param String $file 要下载的文件路径
     * @param String $name 文件名称,为空则与下载的文件名称一样
     * @param boolean $reload 是否开启断点续传
     */
    public function download($file, $name = '', $reload = false)
    {
        if (file_exists($file)) {
            if ($name == '') {
                $name = basename($file);
            }
            $fp = fopen($file, 'rb');
            $file_size = filesize($file);
            $ranges = $this->getRange($file_size);
            header('cache-control:public');
            header('content-type:application/octet-stream');
            header('content-disposition:attachment; filename=' . $name);
            if ($reload && $ranges != null) {
                // 使用续传
                header('HTTP/1.1 206 Partial Content');
                header('Accept-Ranges:bytes');
                // 剩余长度
                header(sprintf('content-length:%u', $ranges['end'] - $ranges['start']));
                // range信息
                header(sprintf('content-range:bytes %s-%s/%s', $ranges['start'], $ranges['end'], $file_size));
                // fp指针跳到断点位置
                fseek($fp, sprintf('%u', $ranges['start']));
            } else {
                header('HTTP/1.1 200 OK');
                header('content-length:' . $file_size);
            }
            while (!feof($fp)) {
                echo fread($fp, round($this->_speed * 1024, 0));
                ob_flush();
                //sleep(1); // 用于测试,减慢下载速度
            }
            ($fp != null) && fclose($fp);
        } else {
            return '';
        }
    }

    /** 设置下载速度
     * @param int $speed
     */
    public function setSpeed($speed)
    {
        if (is_numeric($speed) && $speed > 16 && $speed < 4096) {
            $this->_speed = $speed;
        }
    }

    /** 获取header range信息    
     * @param int $file_size 文件大小    
     * @return Array 
     */
    private function getRange($file_size)
    {
        if (isset($_SERVER['HTTP_RANGE']) && !empty($_SERVER['HTTP_RANGE'])) {
            $range = $_SERVER['HTTP_RANGE'];
            $range = preg_replace('/[\s|,].*/', '', $range);
            $range = explode('-', substr($range, 6));
            if (count($range) < 2) {
                $range[1] = $file_size;
            }
            $range = array_combine(array('start', 'end'), $range);
            if (empty($range['start'])) {
                $range['start'] = 0;
            }
            if (empty($range['end'])) {
                $range['end'] = $file_size;
            }
            return $range;
        }
        return null;
    }
}

?>

```
    


# PHP5

## **新增特性**

## 类的高级用法

### instanceof 操作符

    instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例

### final 关键字

```php

//用来标识方法，使其不能被子类重载
class MyClass {
    final function method() {}
}

//用来标识类，使其不能被继承
final class MyClass {
}
class ExtendClass extends MyClass {
    //这个地方不能继承一个被final修饰的类
}

```

### clone 关键字

```php

//你可以再类中声明一个__clone()方法，它将在克隆过程中被调用（调用的过程，在属性和方法从源对象复制过来以后进行）

class MyClass {
    function __clone() {
        echo "对象正在被克隆";
    }
}
$obj = new MyClass();

$obj_copy = colne $obj; //克隆一个对象


```

### const 关键字

```php

//用来定义在类中使用的常量(注意：在类中使用常量的时候都要使用这个)
class MyClass {
    const SUCESS = "Sucess";
}
print MyClass::SUCESS

```

### 静态成员和静态方法

```php

//类的定义现在包含静态成员（属性），可以通过类自身来访问。通常用的最多的是单例模式
class Singleton {
    //静态成员
    static private $instance = NULL;
    //单例模式通常也定义 __clone方法,防止通过外部克隆当前类
    private function __clone(){
    }
    //私有的构造类，保证外部无法访问
    private function __construct() {
    }
    //静态方法
    static public function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }
}

```

### 抽象类

```php

//把类声明为抽象类可以防止它被实例化。但是你可以继承一个抽象类：
abstract class MyBaseClass{
    function display(){
        print "测试";
    }
}

	
```

### 抽象方法


```php

//把方法声明为抽象，以便在继承的子类中再去定义。包含抽象方法的类本身必须是一个抽象类：
abstract class MyClass{
    abstract function display();
}

```


### 对象类型提示
    
    
```php

//函数声明中可以对参数进行对象类型提示。如果函数调用的时候没有传递正确的对象类型，系统会报错
class MyClass() {
}
function expectsMyClass(MyClass $obj) {
    //也就是这个对象必须是指定的MyClass对象的实例
}

```

### 函数调用

```php

//PHP4
$dummy = $obj->method();
$dummy->method2();

//PHP5开始支持链式函数调用
$obj->method()->method2();

```
### 继承类实现Iterator接口

```php

//PHP5允许PHP类和PHP继承类实现Iterator接口。在实现迭代接口后，你可以用foreach语言结构遍历一个类的实例：

$obj = new MyTteratorImplementation();
foreach($obj as $value) {
    print "$value";
}

```


### __autoload方法

    在PHP5中，你可以定义一个__autoload()函数，它在你需要使用一个未定义类的时候自动调用。通过调用这个函数，脚本引擎在PHP抛出类未定义的错误之前提供最后一次加载类的机会：

```php

function __autoload($class_name) {
    include_once($class_name."php");
}
$obj = new MyClass1();
$obj2 = new MyClass2();

//PHP5同样新增了try/throw/catch 架构的异常处理规范。使用时，你只能抛出从Exception 类继承的对象：
class SQLException extends Exception {
    public $problem;
    function __contruct($problem) {
        $this->problem = $problem;
    }
}

try {
    throw new SQLException("Couldn't connect to database");
} catch (SQLException $e) {
    print "";
} catch (Exception $e) {

}

```


### foreach 函数支持引用

```php

foreach ($arr as $key => $value) {
    $new_value = array('name' => 3);
    $arr[$key] = $new_value;
}
//在循环中使用引用改变value的值更简洁
foreach ($arr as $key => &$value) {
    $value = array('name' => 3);
}

//给引用参数设置默认值

//你可能认为只有 传递值的参数可以设置默认值，现在PHP5中也可以给引用参数设置默认值
function my_func(&$arg = null) {
    if ($arg == null) {
        print '$arg is empty';
    }
}
my_func();

```

### 新增SOAP支持

    SOAP 是一种简单的基于 XML 的协议，它使应用程序通过 HTTP 来交换信息。在我们的 SOAP 教程中，你将了解到什么是 SOAP，以及它如何在应用程序之间交换信息。


### Tidy扩展

    用于修复和美化html

### Perl扩展

    用来调用Perl脚本、使用Perl类和在PHP中使用Perl的其他功能。

----------


## **基础用法**
----------
## 变量


### 变量的间接引用

```php

//变量的间接引用使用两个 $ 符号
$name = "John";
$$name = "user";
print $John;  //这个变量被定义是因为上一行的间接引用 使得这个变量生效
//通过在变量的前面增加附加的 $ 标记，你可以任意增加引用次数
$$$name = 'user1';
print $user; //这个变量也会被定义

```

### 管理变量

#### 	*isset()*
    
    isset()用来判断某个变量是否已经声明。它返回一个布尔值。
	如果变量已经被设置就返回true,反之返回false，或者当变量的值被设定为NULL的时候，它也返回false.
    
    isset($var1, $var2, $var3); //isset可以一次判断多个变量是否设置

`注意：检查多个变量时，它只有在所有变量都定义了的情况下才返回 true,否则将返回false。`


#### *unset()*
    
    unset()可以 取消之前定义的变量，而且如果没有其他变量在引用它的话，就会释放这个变量使用的所有内存空间。调用isset()来检查一个被 unset()处理过的变量的话，会返回false.
    例如：
    $name = "test";
    unset($name);
    if (isset($name)) {
        print 'test';
    }
    这个例子不会生成任何输出。
    unset还可以用来检查数组的元素和对象的属性，就跟isset()一样。
    
>> **empty()**
    
    empty()可以用来检查一个变量是否没被声明或者值是false。这个语言结构通常被用来检查一个表单变量是否未被发送或者包含数据。当检查一个变量的值是否为真的时候，它的值会首先被转变一个布尔型的值，再检查是否为真。



>**超全局变量**
    
    作为一般的规律，php不支持全局变量，但是，一些PHP的特定内部变量可以像其他语言的全局数组一样运行。这些变量称为超全局变量，而且PHP预定了这些变量让你使用。这些超全局变量的一些列子：
    $_GET、$_POST、$_COOKIE、$_ENV、$_SERVER


>**基础数据类型**

    PHP中使用了8中数据类型，其中有5种是数量型的。同时剩下的三种数据类型有着自己的独特性。
>>**Int 整型**
 
    32位带符号数字    范围 -2147483648 到 +2147483647

>> **float 浮点型**
    
    8个字节     范围 2.2E-308 到1.8E+308    浮点型数字包含一个小数点，而且可以包含一个 +/- 号，并且可以是一个指数值

>> **string 字符串**
    
    指一序列的字符并且自动地用null做结束的组合。
    注意：字符串在使用过程中的单双引号问题
    
    **双引号**
    字符串可以包含非常多的字符。特殊字符的话不用它原来的样子来表示，要用特殊符号表示。注意字符串也可以作为数组的结构来处理
    
    例如：
    \n 换行
    \t 制表符
    \" 双引号
    \\ 反斜线
    \0 ASCII0(null)
    \r 回到行的开始处
    \$ 对$符号进行转义，就不会当成变量处理，而只是一个字符
    \{Octal #}    用八进制写的字符，例如 \70表示字母 8
    \x{Hexadecimal #}    用十六进制写的字符，例如 \0x32表示字母 2
    双引号字符串的一个附加特性是一些特定的符号，如变量或表达式，可以直接嵌入使用。例如：
    "The result is $result \n"    这里 \n 用来处理换行
    "The array offset $is contains $arr[$i]" 注意这里可以直接解析 $arr 数组

    **单引号**
    除了双引号，单引号也可以用来划定字符串。但是，与双引号不一样的是，单引号不支持双引号所有转义和变量替换的功能。
    单引号所支持的仅有两个字符转义：单引号（\'）和反斜杠（\\）,当你需要在一个单引号前面输入反斜杠的时候就必须使用双斜杠
    
    **定界符**
    用来在脚本中嵌入大篇幅的文本，其中还可能包含许多双引号和单引号，使用定界符的时候就不需要再去转义。
    这个字符串以 <<< 符号开始，紧跟着的字符串（THE_END）在你的文本中不能出现。他使用开始的字符串标记结束整个文档，（结束字符串）这个字符串必须定格写，或者加上分号，同时你需要加上换行符（\n）.定界符对于字符转义和变量替换的支持与双引号基本相同。不同的是，你在定界符中不需要去转义双引号。
   例如：
    
```php
    $str = <<<THE_END
    ASDFASDFASDF
    ASDFSDAFDASFFASFADSFDDASFASDFASF
THE_END;
```
    **访问字符串中的字符**
    字符串中的单个字符可以通过使用$str{offset}或者$str[offset]（注意[]访问方式是在PHP4中的用法，在PHP5中最好使用{}，防止无法区分是字符操作还是数组操作）符号访问。你可以用它读取和写字符串该位置的字符。当读取操作的时候，这个字符串只能用已经存在的索引来读取。如果是修改字符串，~~你可以访问还未存在的索引~~（$i = '012'; $i[3] = '3';）这是不会报错的。PHP会自动为修改的字符设置偏移量索引，而且如果你设置的索引与字符串中最后一个索引有差距，PHP会自动用空格字符（''）把这中间的缺口不上。
    
例如：
```php
$a = '11111';
$i = 10;
$a[$i] = 2;
echo $a;
//会输出  '11111 2'   注意中间补白的空格；
```
 
    提示：在许多情况下，PHP中使用字符串处理函数实现有效的运算。你在直接使用偏移量访问字符串之前最好了解一些这些函数。通常使用 str_ 开头。如果是复杂的字符串操作，那就要用到正则表达式了尤其是pcre_函数族



>> **bool 布尔型**

    范围: true 和 false    经常用来判断真假运算

>> **null**

    范围：只能有一个值的数据类型（NULL值）它表示变量的值是空的，而且他在区分空字符串和数据库的null值的时候非常有用。

>> **resources**   
    
    资源：一种特殊的数据类型，用来表示一种PHP的外部资源，例如：数据库访问、文件、数据库连接等
    
    注意：你永远无法直接操作这种类型的变量，但是可以把它们传递给相对应的函数，那些函数知道如何与这些特殊类型的数据进行交互。
    
>> **arrays**

    数组：一种 键值对 的集合，可以关键字或者索引映射到值。数组索引可以是整形数或者字符串，但是它的值可以是任何一种类型
      
	/*
	注意：PHP中的数组是使用哈希表构建的，这意味着访问每一个值都是O(1)复杂度
	
	数组可以用 array() 语言结构来声明，通常使用如下形式(方括号中的元素 key 是可选的，可以没有key)：
	array([key=>] value, [key=>] value) 
	    
	关键字是可选的，而且如果没有指定它的值的话，关键字会自动赋值。赋值的方法是按照自增的数字来命名（从0开始），你也可以部分使用关键字而其他部分不用关键字这样混合声明一个数组。
	*/
	    
	array("1", 3=>'2', '3', '4')    //输出  Array ( [0] => 1 [3] => 2 [4] => 3 [5] => 4 )
	array("1", 'name'=>'2', '3', '4') //输出 Array ( [0] => 1 [name] => 2 [1] => 3 [2] => 4 )
	
	/*
	混合使用时自增的 key 会根据手工设置 key 的地方判断从哪个值自增，上边两个案例已经说明问题
	    
	    数组的访问和修改
	        $arr1 = array(1, 2, 3);
	        $arr2[0] = 1;
	        echo $arr2[0];
	        //当然有更多用法不再解释，请参考文档
	    追加数组的特殊用法
	        $arr2[] = 2;
	        它的key根据之前的key进行自增
	
	    访问嵌套数组
	        $arr[key][key].... 根据层数选择使用多少个方括号来访问
	*/
	
	/*
	使用 foreach 遍历数组
	循环的大概语法如下：
	*/
	foreach($array as [$key =>] [&] $value){
	    //....
	}
	/*
	$key是可选的，而且如果设置的话，它将包含当前所有遍历的值的关键字，它的类型依据数组内的关键字的数据类型而定。
	设置 & 符在值的前面也是可选的，你在想更改 $value 的值，并在 $array 中也生效的时候，你需要使用它。
	大多数情况下，你不需要在遍历数组的时候修改 $value 的值，所以就不需要设置。
	*/
	
	/*
	使用list() 和each()遍历数组
	foreach()是一个遍历数组的很好的方法，同时还有一种遍历数组的方式就是用list()结构和each的函数组合：  
	*/
	
	$players = array('1', '2', '3');
	reset($players); //将数组内部的指针指向第一个单元，使用each之前一定要使用reset使指针指向第一个单元
	while( list($key, $val) = each($players) ){
	    echo $key.'='.$val;
	}
	
	
	/*
	each 函数返回当前的键值对并且把内部指针向下一个元素。当它到达数组尾部的时，会返回一个 flase 的布尔值。
	键值对是以一个数组返回的返回的结构 Array ( [1] => 28 [value] => 28 [0] => john [key] => john )。之所以要返回一个副本是因为如果你要单独访问他们，可以使用 $elem['key']和$elem['value']来访问，例如：
	*/
	$ages = array('john' => 28, 'bar' => 67);
	reset($ages);
	$person = each($ages);  //返回 Array ( [1] => 28 [value] => 28 [0] => john [key] => john )
	//可以有两种访问方式
	$name = $person['key'];
	$name = $person[0];
   






