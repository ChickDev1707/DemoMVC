<?php
    class MonthReportModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function exportReport($month, $year) {
            $sql = "SELECT THE_LOAI, COUNT(MA_PHIEU_MUON) AS TOTAL
                    FROM sach INNER JOIN phieu_muon_tra ON sach.MA_SACH = phieu_muon_tra.MA_SACH
                    WHERE MONTH(NGAY_MUON) = {$month} AND YEAR(NGAY_MUON) = {$year}
                    GROUP BY THE_LOAI";
            $this->database->query($sql);
            $rows = $this->database->resultSet();
            return $rows;
        }
        public function countRows($month, $year) {
            $sql = "SELECT COUNT(*) as so_dong FROM phieu_muon_tra WHERE MONTH(NGAY_MUON) = {$month} AND YEAR(NGAY_MUON) = {$year}";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data[0]->so_dong;
        }
        public function getAllMonthYear() {
            $sql = "SELECT THANG, NAM FROM bao_cao_thang";
            $this->database->query($sql);
            $this->database->execute();
            $data = $this->database->resultSet();
            return $data;
        }
        public function createMonthReport($data) {
            $sql = "INSERT INTO bao_cao_thang(THANG, NAM, TONG_SO_LUOT_MUON) VALUES (:month, :year, :total)";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getMonthReportId($month, $year) {
            $sql = "SELECT * FROM bao_cao_thang WHERE THANG = {$month} AND NAM = {$year}";
            $this->database->query($sql);
            $data = $this->database->single();
            return $data->MA_BAO_CAO_THANG;
        }
        public function createMonthReportDetails($data) {
            $sql = "INSERT INTO ct_bao_cao_thang(MA_BAO_CAO_THANG, THE_LOAI, SO_LUOT_MUON, TI_LE)
                    VALUES (:id, :type, :total, :rate)";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getData($month, $year) {
            $monthReportId = $this->getMonthReportId($month, $year);
            $sql = "SELECT * FROM ct_bao_cao_thang WHERE MA_BAO_CAO_THANG = {$monthReportId}";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
    }
?>