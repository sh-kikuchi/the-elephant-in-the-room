<?php

class CsvImporter {
    private $table_cols;
    private $table_name;
    private $filePath;

    public function __construct($table_name) {
        $this->table_name = $table_name;
        $this->filePath = 'storage/csv/' . $this->table_name . '.csv';
    }

    public function import() {
        try {

            $dbConnect = new app\axis\database\DataBaseConnect();
            $pdo = $dbConnect->getPDO();

            if (!file_exists($this->filePath) || !is_readable($this->filePath)) {
                throw new Exception("CSV file not found or not readable: $this->filePath");
            }

            $f = fopen($this->filePath, "r");
            // Read the first row to get column names
            $header = fgetcsv($f);
            if (!$header) {
                throw new Exception("Failed to read the header from the CSV file.");
            }
            $this->table_cols = implode(', ', $header);

            while ($data = fgetcsv($f)) {
                $col_arr = [];
                if (implode($data) != null) {
                    foreach($data as $col){
                        array_push($col_arr, "'".$col."'");   
                    }
                    $col_str = implode(',', $col_arr);
                    $sql = "INSERT INTO {$this->table_name} ({$this->table_cols}) VALUES ({$col_str});";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
            }
            fclose($f);
        } catch (PDOException $e) {
            print "[ERROR] {$e->getMessage()}\n";
            die();
        } catch (Exception $e) {
            print "[ERROR] {$e->getMessage()}\n";
            die();
        }
    }
}

// Usage
$csvImporter = new CsvImporter('users');
$csvImporter->import();

