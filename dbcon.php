<?php
/**
 * Created by PhpStorm.
 * User: www.zeffee.com
 * Date: 2016/3/16
 * Time: 14:03
 */

/**
 * 	单位(1W次/秒)
 
 *				无DML		有DML
 *	Mysql 		1.592 		2.037
 *	Mysqli		1.383		1.704
 *	PDO         1.356  		1.732
 
 *	本结果系十次 1W次操作的平均值
**/


error_reporting(E_ALL||~E_NOTICE);

for ($x=0; $x < 10; $x++) { 
	//设置开始时间
	$start_time =microtime(true);

	//1W次数据库操作
	for ($i=0; $i < 10000; $i++) { 
		//若无设置模式则仅单纯连接数据库
		if($_GET["mode"])
		{
			$sql="select * from ins where id=".$i+10;
		}
		else
		{
			$sql="";
		}
		$res=$_GET["action"]($sql);					
	}

	//此1W次操作花费的时间
	$time=microtime(true)-$start_time;
	echo "第".$x."次操作花费的时间:".$time."<br>";

	//合计总花费时间
	$all_time +=$time;
}
echo "平均1W次操作花费的时间:".$all_time/10;



function Mysqli_con($sql="")
{
	$mysqli =new mysqli("localhost","root","root","php");
	$row    ="";
	if($sql)
	{
		$row =mysqli_fetch_assoc($mysqli->query($sql));
	}
			
	$mysqli->close();
	return $row;
}


function Mysql_con($sql="")
{
	$con =mysql_select_db("php",mysql_connect("localhost",'root','root'));
	$row ="";
	if($sql)
	{
		$row =mysql_fetch_assoc(mysql_query($sql)); 
	}
	
	mysql_close();
	return $row;
}

function Pdo_con($sql="")
{
	$con = new PDO("mysql:host=localhost;dbname=php",'root','root');
	$res ="";
	if($sql)
	{
		foreach ($con->query($sql) as $row) {
			$res=$row;
		}
	}
	$con=null;
	return $res;	
}
?>