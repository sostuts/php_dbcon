# Usage:

### URL:http://127.0.0.1/dbcon.php?action=Action_Function&mode=Mode

| name            | 必须   | values                                   |
| --------------- | ---- | :--------------------------------------- |
| Action_Function | 是    | Mysql_con:mysql连接、Mysqli_con:mysqli连接、       Pdo_con:pdo连接 |
| Mode            | 否    | 1为执行DML语句,不填则不执行                         |



>

### Example:

Mysqli连接且需要执行DML语句:

http://127.0.0.1/dbcon.php?action=Mysqli_con&mode=1

>



Pdo连接、不执行DML语句:

http://127.0.0.1/dbcon.php?action=Pdo_con&mode=