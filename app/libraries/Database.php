<?php
    /*
        PDO DB Class:
        - Connect                
        - Create prepared statements              
        - Bind values                     
        - Return rows and results           
    */

    class Database
    {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbHandler;
        private $stmt;
        private $error;

        public function __construct()
        {
            // set DSN (Database Source Name)
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // create PDO instance
            try {
                $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                print $this->error;
            }
        }

        // prepare statement with query
        public function query($sql)
        {
            $this->stmt = $this->dbHandler->prepare($sql);
        }

        // bind values
        public function bind($param, $value, $type = null)
        {
            if (isnull($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            // PDO statements have bindValues function to bind a value to a parameter
            $this->stmt->bindValue($param, $value, $type);
        }

        // execute the prepared statement
        public function execute()
        {
            return $this->stmt->execute();
        }

        // get result, set as an array of objects
        public function resultSet()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // get single record as object
        public function single()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount()
        {
            return $this->stmt->rowCount();
        }
    }
