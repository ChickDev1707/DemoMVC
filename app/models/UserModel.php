
<?php

    class UserModel extends Database
    {
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }
        public function getReaderCardInfo($id){
            $sql = "SELECT * FROM doc_gia WHERE MA_DOC_GIA = ?";
            $this->db->query($sql);
            $this->db->bind(1, $id);
            $this->db->queryExecute();
            $rows = $this->db->single();
            return $rows;
        }
        public function setReaderCardInfo($info){
            $sql = "INSERT INTO doc_gia(MA_DOC_GIA, HO_TEN_DOC_GIA, LOAI_DOC_GIA, NGAY_SINH, DIA_CHI, EMAIL, NGAY_LAP_THE, TEN_ANH) VALUES (:id, :name, :type, :dob, :address, :email, :createDate, :imgName)";
            $this->db->query($sql);
            $this->db->insertExecute($info);
        }
        public function changeReaderCardStatus($data){
            $sql = "UPDATE user_account WHERE USERID = (:id) SET KIEM_TRA_TAO_THE = 1";
            $this->db->query($sql);
            $this->db->insertExecute($data);
        }
    }
?>