<?php

    class DayReportModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createLatePaymentCard($data) {
            $sql = "INSERT INTO bao_cao_ngay (NGAY, TEN_SACH, NGAY_MUON, SO_NGAY_TRA_TRE) VALUES (:ngay, :ten_sach, :ngay_muon, :so_ngay_tra_tre)";
            $this->database->query($sql);
            $this->database->execute($data);
        }
        public function getInfoLatePaymentBook($date) {
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));
            $day = date('d', strtotime($date));
            $sql = "SELECT TEN_SACH, NGAY_MUON, SO_NGAY_TRA_TRE FROM phieu_muon_tra INNER JOIN sach
            ON phieu_muon_tra.MA_SACH = sach.MA_SACH
            WHERE YEAR(NGAY_TRA) = {$year} AND MONTH(NGAY_TRA) = {$month} AND DAY(NGAY_TRA) = {$day} AND SO_NGAY_TRA_TRE > 0";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
        public function getAllDay() {
            $sql = "SELECT NGAY FROM bao_cao_ngay";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
        public function getDataFromDayReport($date) {
            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));
            $day = date('d', strtotime($date));
            $sql = "SELECT * FROM bao_cao_ngay WHERE YEAR(NGAY) = {$year} AND MONTH(NGAY) = {$month} AND DAY(NGAY) = {$day}";
            $this->database->query($sql);
            $data = $this->database->resultSet();
            return $data;
        }
    }

?>