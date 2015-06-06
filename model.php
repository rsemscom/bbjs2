<?php
namespace App;

class Model {
    static public $DBTable = "model";
    static public $DBHost = "";
    static public $DBName = "bbjs2";
    static public $DBLogin = "root";
    static public $DBPassword = "";


    /**
     * @param $sql string
     * @param $first bool
     * @return array|object
     */
    public function query($sql, $first = false) {
        $con = mysqli_connect(Model::$DBHost, Model::$DBLogin, Model::$DBPassword) or die(mysqli_connect_error());
        mysqli_select_db($con, Model::$DBName) or die(mysqli_error($con));
        $mtable = mysqli_query($con, $sql) or die(mysqli_error($con));
        mysqli_close($con);

        if (!is_object($mtable))
            return;

        $res = [];
        while ($row = mysqli_fetch_object($mtable))
            $res[] = $row;

        return sizeof($res) == 1 || $first && sizeof($res) ? $res[0] : $res;
    }

    /**
     * @return array
     */
    public function getAll() {
        return $this->query("SELECT * FROM `{$this::$DBTable}`");
    }


    /**
     * @param $params array
     */
    public function insertFinish($params) {
        var_dump($params);
        $keys = implode('`, `', array_keys($params));
        $values = implode("', '", $params);
        $sql = "INSERT INTO `{$this::$DBTable}`(`$keys`) VALUES('$values')";
        $this->query($sql);
    }

    /**
     * @param $params array
     */
    public function updateFinish($params) {
        $pairs = [];
        foreach ($params as $param=>$val)
            if ($param != 'id')
                $pairs[] = "`$param` = '$val'";
        $pairs = implode(', ', $pairs);
        $id = $params['id'];
        $sql = "UPDATE `{$this::$DBTable}` SET $pairs WHERE `id` = '$id'";
        $this->query($sql);
    }

    /**
     * @param $params array
     */
    public function removeFinish($params) {
        $this->query("DELETE FROM `{$this::$DBTable}` WHERE `id` = {$params['id']}");
    }
}

class Hotel extends Model {
    static public $DBTable = 'hotel';

    public function insert($params) {
            $params['country'] = Country::getCountryWidthName($params['country'])->id;
        if (!$params['country'])
            throw new \Exception('no country');
        $this->insertFinish($params);
        return 'ok';
    }

    public function update($params) {
        if ($params['country']) {
            $params['country'] = Country::getCountryWidthName($params['country'])->id;
            if (!$params['country'])
                throw new \Exception('no country');
        }
        $this->updateFinish($params);
        return 'ok';
    }

    public function remove($params) {
        $this->removeFinish($params);
        return 'ok';
    }

    public function get($params) {
        $country = Country::getCountryWidthName($params['country'])->id;
        if (!$country)
            return $this->getAll();
        return $this->query("SELECT * FROM `{$this::$DBTable}` WHERE `country` = $country");
    }
}

class Country extends Model {
    static public $DBTable =  'country';

    public function insert($params) {
        $this->insertFinish($params);
        return 'ok';
    }

    public function update($params) {
        $this->updateFinish($params);
        return 'ok';
    }

    public function remove($params) {
        $this->removeFinish($params);
        return 'ok';
    }

    public static function getCountryWidthName($name) {
        $table = Country::$DBTable;
        return Model::query("SELECT * FROM `$table` WHERE `name` = '$name'", true);
    }

    public function get($params) {
        return $this->getAll();
    }
}