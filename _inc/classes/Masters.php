<?php
    class Masters extends Database{
        private $db;
        public function __construct()
        {
            $this->db = $this->make_connection();
        }
        public function selectAll(){
            try{
                $sql = "SELECT * FROM masters";
                $query = $this->db->query($sql);
                $result = $query->fetchAll();
                return $result;
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getRows(){
            try{
                $sql = "SELECT * FROM masters";
                $query = $this->db->query($sql);
                return $query->rowCount();
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        public function content_mapping(){
            try{
                $sql = "SELECT * FROM masters";
                $query = $this->db->query($sql);
                $rows = $query->fetchAll();
                echo '<table class="table-horizontal">
                        <tr>
                            <th>názov</th>
                            <th>image</th>
                            <th>cena</th>
                            <th>delete</th>
                            <th>edit</th>
                        <tr>';
                for($i = 0; $i<count($rows); $i++){
                    echo '<tr>';
                    echo '<td>'.$rows[$i]->name.'</td>';
                    echo '<td>'.basename($rows[$i]->pic_url).'</td>';
                    echo '<td>'.$rows[$i]->price.'</td>';
                    echo '<td>
                            <form action ="" method="POST">
                                <button type="submit" class="btn border-10 no-shadow no-transform no-border" name="delete" value="'.$rows[$i]->menu_id.'"'.'>Vymazať</button>
                         </form>
                        </td>';
                    echo '<td>
                        <form action="update.php?page=Menu" method="POST">
                          <button type="submit" class="btn border-10 no-shadow no-transform no-border" name="edit_menu" value="'.$rows[$i]->menu_id.'"'.'>Editovať</button>
                          </form>
                      </td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
    }
    public function delete($id){
        try{
            $sql = "DELETE FROM masters WHERE masters_id = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$id]);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    // private function select_distinguish_url($id){
    //     $sql = "SELECT pic_url FROM menu WHERE menu_id != ?";
    //     $query = $this->db->prepare($sql);
    //     $query->execute([$id]);
    //     $array = $query->fetchAll();
    //     return $array;
    // }
    private function get_images_url(){
        $array = glob("../img/masters_img/*");
        return $array;
    }
    public function edit_interface($id){
        $sql = "SELECT name, pic_url, price FROM masters WHERE masters_id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);
        $object = $query->fetch();
        $img_url = basename($object->pic_url);
        $url_array = $this->get_images_url();
        $dir = '/saber/img/masters_img/';
        echo '<form action="table.php?page=Masters" method="POST" class="standart-form edit-form" enctype="multipart/form-data">
        <label for="name">Názov</label><br>
          <input type="text" name="edit_name" value="'.$object->name.'" required><br>
          <label for="images">Select image from existed</label><br>
          <select name="images" id="images">
            <option value="'.$dir.$img_url.'">'.$img_url.'</option>';
        for($i = 0; $i<count($url_array); $i++){
            if(basename($url_array[$i]) == $img_url) continue;
            echo '<option value="'.$dir.basename($url_array[$i]).'">'.basename($url_array[$i]).'</option>';
        }
        echo  '</select><br>';
        echo '<label for="load_img">Or load a new one</label><br>';
        echo '<input type="file" name="load_img" id="load_img" accept="image/*"><br>';
        echo '<label for="edit_price">Cena</label><br>';
        echo '<input type="text" name="edit_price" value="'.$object->price.'" required><br>';
        echo '<img src="'.$dir.$img_url.'" id="prewiew-image" width=500><br>';
        echo  '<button type="submit" name="edit" class="btn no-border" value="'.$id.'">Submit</button>
        </form>';
    }
    public function edit(){
        $sql = "UPDATE menu SET name = :name, pic_url = :url, price = :price WHERE menu_id = :id";
        $query = $this->db->prepare($sql);
        $url = $_POST['images'];
        if(isset($_FILES)){
            $extFile = explode("/", $_FILES['load_img']['type'])[0];
            if($extFile == "image"){
                $uploaddir = '../img/menu_img/';
                $uploadfile = $uploaddir . basename($_FILES['load_img']['name']);
                move_uploaded_file($_FILES['load_img']['tmp_name'], $uploadfile);
                $url = $uploadfile;
            }

        }
        $data = array("name" => $_POST['edit_name'], "url" => $url, "price"=> $_POST['edit_price'], "id" => $_POST['edit']);
        $query->execute($data);
    }
    public function create_interface(){
        $url_array = $this->get_images_url();
        $dir = '/pekaren/img/menu_img/';
        echo '<form action="table.php?page=Menu" method="POST" class="standart-form edit-form" enctype="multipart/form-data">
        <label for="name">Názov</label><br>
          <input type="text" placeholder="Názov" name="create_name" required><br>
          <label for="images">Select image from existed</label><br>
          <select name="images" id="images">';
        for($i = 0; $i<count($url_array); $i++){
            echo '<option value="'.$dir.basename($url_array[$i]).'">'.basename($url_array[$i]).'</option>';
        }
        echo  '</select><br>';
        echo '<label for="load_img">Or load a new one</label><br>';
        echo '<input type="file" name="load_img" id="load_img" accept="image/*"><br>';
        echo '<label for="create_price">Cena</label><br>';
        echo '<input type="text" placeholder="Cena" name="create_price" required><br>';
        echo '<img src="'.$dir.basename($url_array[0]).'" id="prewiew-image" width=500><br>';
        echo  '<button type="submit" name="create" class="btn no-border">Submit</button>
        </form>';
    }
    public function create(){
        try{
            $sql = "INSERT INTO menu (name, pic_url, price) VALUES (:name, :pic_url, :price)";
            $url = $_POST['images'];
            if(isset($_FILES)){
                $extFile = explode("/", $_FILES['load_img']['type'])[0];
                if($extFile == "image"){
                    $uploaddir = '../img/menu_img/';
                    $uploadfile = $uploaddir . basename($_FILES['load_img']['name']);
                    move_uploaded_file($_FILES['load_img']['tmp_name'], $uploadfile);
                    $url = $uploadfile;
                }
    
            }
            $data = array("name" => $_POST['create_name'], "pic_url" => $url, "price"=> $_POST['create_price']);
            $query = $this->db->prepare($sql);
            $query->execute($data);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }

?>