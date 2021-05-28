<?php
    class ReportBookBorrowedModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function exportReport($month) {
            $sql = "SELECT THE_LOAI, COUNT(MA_PHIEU_MUON) AS TOTAL
                    FROM sach INNER JOIN phieu_muon_tra ON sach.MA_SACH = phieu_muon_tra.MA_SACH
                    WHERE MONTH(NGAY_MUON) = {$month}
                    GROUP BY THE_LOAI";
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function countRows() {
            $sql = "SELECT COUNT(*) as so_dong FROM phieu_muon_tra";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data[0]->so_dong;
        }
    }
?>