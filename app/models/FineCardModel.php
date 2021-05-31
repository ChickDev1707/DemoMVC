

<?php
    class FineCardModel extends Database {
        private $database;
        public function __construct()
        {
            $this->database = new Database();
        }
        public function createFineCard($data) {
            $sql = 'INSERT INTO phieu_thu_tien_phat (MA_DOC_GIA, SO_TIEN_THU, CON_LAI) VALUES (:reader_card_id, :received_money, :remain_money)';
            $this->database->query($sql);
            $this->database->execute($data);
        }  
        public function getReaderId($id){
            $sql = 'SELECT * FROM doc_gia WHERE MA_DOC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $id);
            $row= $this->database->single();
            return $row;
        }
        // check if reader exist
        public function getAllReadersInfo(){
            $sql = 'SELECT MA_DOC_GIA, HO_TEN_DOC_GIA, TONG_NO FROM doc_gia';
            $this->database->query($sql);
            $this->database->execute();
            $rows= $this->database->resultSet();
            return $rows;
        }
        // upload reader info to input
        public function updateTotalFine($id, $newTotalFine){
            $sql = 'UPDATE doc_gia SET TONG_NO = ? WHERE MA_DOC_GIA = ?';
            $this->database->query($sql);
            $this->database->bind(1, $newTotalFine);
            $this->database->bind(2, $id);
            $this->database->execute();
        }
        // upload total fine after get fine
    }

?>