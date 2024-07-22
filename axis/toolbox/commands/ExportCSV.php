<?php

class ExportCSV{

    private $tableName;
    private $filePath;

    function run($tableName){
        $this->tableName = $tableName;
        $this->filePath = 'storage/csv/' . $this->tableName . '.csv';

        try {
            $fp = fopen($this->filePath, 'w');
            $dbConnect = new app\axis\database\DataBaseConnect();
            $pdo = $dbConnect->getPDO();

            $sql = 'SELECT * FROM '. $this->tableName;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            foreach ($stmt as $row) {
                $this->writeRowToCsv($fp, $row);
            }
            fwrite($fp, $output);
            $this->downloadFile($this->filePath);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function exportToCsv() {
        try {
            $fp = fopen($this->filePath, 'w');
            $dbConnect = new app\axis\database\DataBaseConnect();
            $pdo = $dbConnect->getPDO();

            $sql = 'SELECT * FROM '. $this->tableName;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            foreach ($stmt as $row) {
                $this->writeRowToCsv($fp, $row);
            }
            fwrite($fp, $output);
            $this->downloadFile($this->filePath);
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    private function writeRowToCsv($fp, $row) {
        $rowTmp = '"' . implode('","', $row) . '"' . "\n";
        fwrite($fp, $rowTmp);
    }

    private function downloadFile($filePath) {
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "[ERROR] File not found.";
        }
    }

    private function handleError($e) {
        print "[ERROR] {{$e->getMessage()}}\n";
        die();
    }
}
