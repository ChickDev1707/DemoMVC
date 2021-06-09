
<?php
    class ParameterEditing extends Controller{
        private $ParameterEditingModel;
        public function __construct()
        {
            $this->ParameterEditingModel = $this->model("ParameterEditingModel");
        }
        public function index(){
            $data = $this->ParameterEditingModel->getAllParams();
            $this->view("librarian/Parameter-editing", $data);

            $this->listenChangeReaderCardParams();
            $this->listenBookTypeAdding();
            $this->listenBookTypeList();
            $this->listenBookTypeDelete();

            $this->listenBookAuthorAdding();
            $this->listenBookAuthorList();
            $this->listenBookAuthorDelete();
            $this->listenChangeYearDistance();

            $this->listenChangeBorrowParams();
            
        }
        private function listenChangeReaderCardParams(){
            if(isset($_POST['submit_change_reader_card'])){
                $data= [
                    'min_age'=> $_POST['min_age'],
                    'max_age'=> $_POST['max_age'],
                    'card_date_limit'=> $_POST['card_date_limit'],
                ];
                $type = "correct";
                $message = "";
                $errorMessage = $this->getChangeReaderCardParamsErrorMessage($data);

                if($errorMessage != ""){
                    $message = $errorMessage;
                    $type = "incorrect";
                    // has error;
                }else{
                    $message = "Đã thay đổi quy định thẻ độc giả";
                    
                    $this->ParameterEditingModel->changeReaderCardParams($data);

                    $dataVars = array($data);
                    $jsDataVars = json_encode($dataVars, JSON_HEX_TAG | JSON_HEX_AMP);
                    echo "<script> updateReaderCardParams.apply(null, $jsDataVars);</script>";
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            }
        }
        private function getChangeReaderCardParamsErrorMessage($data){
            if($data['max_age']< $data['min_age']){
                return "Tuổi tối đa phải lớn hơn hoặc bằng tuổi tối thiểu";
            }
            return "";
        }
        // reader card
        // --------------------------------------------------------------------------------------

        private function listenBookTypeAdding(){
            if(isset($_POST['submit_type_add'])){
                $data= [
                    'book_type'=> $_POST['book_type'],
                ];
                $type = "correct";
                $message = "";
                $errorMessage = $this->getBookTypeAddingError($data['book_type']);

                if($errorMessage != ""){
                    $type = "incorrect";
                    $message = $errorMessage;
                    // has error;
                }else{
                    $message = "Đã thêm thể loại vào hệ thống";
                    $this->ParameterEditingModel->addBookType($data['book_type']);
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";

            }
        }
        private function getBookTypeAddingError($bookType){
            if(!isValidName($bookType)){
                return "Tên thể loại không hợp lệ";
            }
            if($this->isBookTypeExists($bookType)){
                return "Tên thể loại đã tồn tại";
            }
            return "";
        }
        private function isBookTypeExists($bookType){
            $rows = $this->ParameterEditingModel->getAllBookTypes();
            foreach($rows as $row){
                if($row->TEN_THE_LOAI_SACH == $bookType) return true;
            } 
            return false;
        }
        // book type add 
        // --------------------------------------------------------------------------------------
        private function listenBookTypeDelete(){
            
            if(isset($_POST['submit_type_delete'])){
                $data= $this->getSelectedTypesFromList();
                $type = "correct";
                $message = "";
                $errorMessage = $this->getTypesError($data);

                if($errorMessage != ""){
                    $type = "incorrect";
                    $message = $errorMessage;
                    // has error;
                }else{
                    $message = "Đã xóa thể loại khỏi hệ thống";
                    foreach($data as $type){
                        $this->ParameterEditingModel->deleteBookType($type);
                    }
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
            }
        }
        private function getSelectedTypesFromList(){
            $numOfTypes= count($this->ParameterEditingModel->getAllBookTypes());
            $data = [];
            for($i = 0; $i< $numOfTypes; $i++){
                $checkBoxName = "type-check-{$i}";
                $typeName = "type-{$i}";
                if(isset($_POST[$checkBoxName]) && isset($_POST[$typeName])){
                    array_push($data, $_POST[$typeName]);
                }    
            }
            return $data;
        }
        private function getTypesError($selectedType){
            foreach($selectedType as $type){
                if($this->existsBookWithTargetType($type)){
                    return "Đang có sách sử dụng thể loại ".$type;
                    break;
                }
            }
            return "";
        }

        private function existsBookWithTargetType($bookType){
            $books = $this->ParameterEditingModel->getAllBooks();
            foreach($books as $book){
                if($book->THE_LOAI == $bookType) return true;
                else return false;
            }
        }
        private function listenBookTypeList(){
            if(isset($_POST["submit_type_list"])){
                $types = $this->ParameterEditingModel->getAllBookTypes();

                $vars = array($types);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> displayBookTypes.apply(null, $jsVars);</script>";
            }
        }
        // book type delete 
        // --------------------------------------------------------------------------------------
        
        private function listenBookAuthorAdding(){
            if(isset($_POST['submit_author_add'])){
                $data= [
                    'book_author'=> $_POST['book_author'],
                ];
                $type = "correct";
                $message = "";
                $errorMessage = $this->getBookAuthorAddingError($data['book_author']);

                if($errorMessage != ""){
                    $type = "incorrect";
                    $message = $errorMessage;
                    // has error;
                }else{
                    $message = "Đã thêm tác giả vào hệ thống";
                    $this->ParameterEditingModel->addBookAuthor($data['book_author']);
                }
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";

            }
        }
        private function getBookAuthorAddingError($bookAuthor){
            if(!isValidName($bookAuthor)){
                return "Tên tác giả không hợp lệ";
            }
            if($this->isBookAuthorExists($bookAuthor)){
                return "Tên tác giả đã tồn tại";
            }
            return "";
        }
        private function isBookAuthorExists($bookAuthor){
            $rows = $this->ParameterEditingModel->getAllBookAuthors();
            foreach($rows as $row){
                if($row->TEN_TAC_GIA == $bookAuthor) return true;
            } 
            return false;
        }
        private function listenBookAuthorList(){
            if(isset($_POST["submit_author_list"])){
                $authors = $this->ParameterEditingModel->getAllBookAuthors();

                $vars = array($authors);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> displayBookAuthors.apply(null, $jsVars);</script>";
            }
        }
        // book author add 
        // --------------------------------------------------------------------------------------

        private function listenBookAuthorDelete(){
            
            if(isset($_POST['submit_author_delete'])){
                $data= $this->getSelectedAuthorsFromList();
                $author = "correct";
                $message = "";
                $errorMessage = $this->getAuthorsError($data);

                if($errorMessage != ""){
                    $author = "incorrect";
                    $message = $errorMessage;
                    // has error;
                }else{
                    $message = "Đã xóa tác giả khỏi hệ thống";
                    foreach($data as $author){
                        $this->ParameterEditingModel->deleteBookAuthor($author);
                    }
                }
                $vars = array($author, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
            }
        }
        private function getSelectedAuthorsFromList(){
            $numOfAuthors= count($this->ParameterEditingModel->getAllBookAuthors());
            $data = [];
            for($i = 0; $i< $numOfAuthors; $i++){
                $checkBoxName = "author-check-{$i}";
                $authorName = "author-{$i}";
                if(isset($_POST[$checkBoxName]) && isset($_POST[$authorName])){
                    array_push($data, $_POST[$authorName]);
                }    
            }
            return $data;
        }
        private function getAuthorsError($selectedAuthor){
            foreach($selectedAuthor as $author){
                if($this->existsBookWithTargetAuthor($author)){
                    return "Đang có sách có tác giả là ".$author;
                    break;
                }
            }
            return "";
        }
        private function existsBookWithTargetAuthor($bookAuthor){
            $books = $this->ParameterEditingModel->getAllBooks();
            foreach($books as $book){
                if($book->TAC_GIA == $bookAuthor) return true;
                else return false;
            }
        }
        // book author delete 
        // --------------------------------------------------------------------------------------
        private function listenChangeYearDistance(){
            if(isset($_POST['submit_year_distance_change'])){
                $data= [
                    'year_distance'=> $_POST['year_distance']
                ];
                $type = "correct";
                // no checking error;
                $message = "Đã thay đổi khoảng cách năm xuất bản";
                
                $this->ParameterEditingModel->changeYearDistance($data['year_distance']);

                $dataVars = array($data['year_distance']);
                $jsDataVars = json_encode($dataVars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> updateYearDistance.apply(null, $jsDataVars);</script>";
                
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            }
        }
        // year distance change
        // --------------------------------------------------------------------------------------
        private function listenChangeBorrowParams(){
            if(isset($_POST['submit_change_borrow'])){
                $data= [
                    'max_num_of_book'=> $_POST['max_num_of_book'],
                    'max_borrow_day_amount'=> $_POST['max_borrow_day_amount'],
                ];
                $type = "correct";
                // no checking error;
                $message = "Đã thay đổi quy định mượn sách";
                
                $this->ParameterEditingModel->changeBorrowParams($data);

                $dataVars = array($data);
                $jsDataVars = json_encode($dataVars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> updateChangeBorrowParams.apply(null, $jsDataVars);</script>";
                
                $vars = array($type, $message);
                $jsVars = json_encode($vars, JSON_HEX_TAG | JSON_HEX_AMP);
                echo "<script> showMessageBox.apply(null, $jsVars);</script>";
                
            }
        }
    }
    function isValidName($name){
        $checker = "/^[a-zA-Z\s]*$/";  
        $hasNonSpace = "/\S/";
        // only contains space is not a valid name
        if(preg_match($checker, $name) && preg_match($hasNonSpace, $name)) return true;
        else return false;
    }
?>