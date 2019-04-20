<?php
class DB
{
    var $DB_HOST; //資料庫主機位置DB hosting location
    var $DB_USER; //資料庫的使用帳號DB account
    var $DB_PASSWORD; //資料庫的使用密碼DB password
    var $DB_NAME; //資料庫名稱DB name
    var $DB_LANGUAGE; //資料庫使用語系DB language applied
    
    var $conn;
    var $result;
    
    function DB($argDB_HOST = 'localhost', $argDB_USER = 'kgx', $argDB_PASSWORD = 'goodluck', $argDB_NAME = 'kgx', $argDB_Language = 'utf8mb4')
    {
        $this->DB_HOST     = $argDB_HOST;
        $this->DB_USER     = $argDB_USER;
        $this->DB_PASSWORD = $argDB_PASSWORD;
        $this->DB_NAME     = $argDB_NAME;
        $this->DB_LANGUAGE = $argDB_Language;
        
        $this->connect();
    }
    
    function connect()
    {
        @$this->conn = mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD);
        
        if (mysqli_errno($this->conn))
            $this->err_msg();
        else
            mysqli_select_db($this->conn, $this->DB_NAME);
        
        if (mysqli_errno($this->conn))
            $this->err_msg();
        else
            $this->query("SET NAMES " . $this->DB_LANGUAGE);
    }
    
    function query($argQuery)
    {
        $this->result = mysqli_query($this->conn, $argQuery);
        
        if (mysqli_errno($this->conn))
            $this->err_msg();
    }
    
    function num_rows()
    {
        return mysqli_num_rows($this->result);
    }
    
    function num_fields()
    {
        return mysqli_num_fields($this->result);
    }
    
    function fetch_assoc()
    {
        return mysqli_fetch_assoc($this->result);
    }
    
    function fetch_row()
    {
        return mysqli_fetch_row($this->result);
    }
    
    function field_name($col)
    {
        return mysqli_fetch_field_direct($this->result, $col);
    }
    
    function close()
    {
        mysqli_close($this->conn);
    }
    
    function err_msg()
    {
        echo "[" . mysqli_errno($this->conn) . "]: " . mysqli_error($this->conn) . "<br />";
        exit();
    }
    
}
?>