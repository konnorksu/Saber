<?php
    class Table extends Database{
        private $db;
        public function __construct(){
            $this->db=$this->make_connection();
        }

        public function admin_table($object){
            echo '  <tr>
                        <th>'.get_class($object).'</th>
                        <td>Počet záznamov: '.$object->getRows().'</td>
                        <td><a class="btn border-10 no-shadow no-transform" href="./table.php?page='.get_class($object).'">Upraviť</a></td>
                        <td><a class="btn border-10 no-shadow no-transform" href="./create.php?page='.get_class($object).'">Add new</a></td>
                    </tr>';
        }

        public function content_interface(){
            try{
                $sql = "SELECT * FROM masters";
                $query = $this->db->query($sql);
                $rows = $query->fetchAll();
                echo '<table class="table-horizontal">
                        <tr>
                            <th>Meno</th>
                            <th>image</th>
                            <th>text</th>
                            <th>delete</th>
                            <th>edit</th>
                        <tr>';
                for($i = 0; $i<count($rows); $i++){
                    echo '<tr>';
                    echo '<td>'.$rows[$i]->name.'</td>';
                    echo '<td>'.basename($rows[$i]->img).'</td>';
                    echo '<td>'.$rows[$i]->text.'</td>';
                    echo '<td>
                        <form action ="" method="POST">
                                <button type="submit" name="delete" value="'.$rows[$i]->id.'"'.'>Vymazať</button>
                         </form>
                        </td>';
                    echo '<td>
                        <form action="edit.php" method="POST">
                          <button type="submit" name="edit" value="'.$rows[$i]->id.'"'.'>Edit</button>
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
    public function create(){
        try{
            $sql = "INSERT INTO masters (name, img, text) VALUES (:name, :img, :text)";
            $url = $_POST['img'];
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
        public function delete($id){
            try{
                $sql = "DELETE FROM masters WHERE id = ?";
                $query = $this->db->prepare($sql);
                $query->execute([$id]);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function edit(){
            $sql = "UPDATE masters SET name = :name, img = :img, text = :text WHERE id = :id";
            $query = $this->db->prepare($sql);
            $data = array("name" => $_POST['name'], "img" => $_POST['img'], "text" => $_POST['text'], "id" => $_POST['edit']);
            $query->execute($data);
        }

        public function edit_interface($id){
            $sql = "SELECT * FROM masters WHERE id = ?";
            $query = $this->db->prepare($sql);
            $query->execute([$id]);
            $user = $query->fetch();
            echo '<form action="admin.php" method="POST">
            <label for="name">Name</label><br>
            <textarea name="name" cols="30" rows="10" required>'.$user->name.'</textarea><br>
            <label for="img">img</label><br>
            <textarea name="img" cols="30" rows="10"required>'.$user->img.'</textarea><br>
            <label for="text">text</label><br>
            <textarea name="text" cols="30" rows="10"required>'.$user->text.'</textarea><br>
            <button type="submit" name="edit" class="btn no-border" value="'.$id.'">Submit</button>
            </form>';
        }
    }
?>