<?php 

$conn = new Connection;
 

class Category extends Connection {

    public function checkExists($category){
        $query = mysqli_query($this->connect(), "SELECT * FROM category WHERE category_name = '$category' ");
        if(mysqli_num_rows($query) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function checkeditExists($category, $id){
        $query = mysqli_query($this->connect(), "SELECT * FROM category WHERE category_name = '$category' AND category_id != '$id' ");
        if(mysqli_num_rows($query) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function show(){
        $query = mysqli_query($this->connect(), " SELECT * FROM category ORDER BY category_name ASC");
        return $query;
    } 


    public function add($category) {
        $sql = "INSERT INTO category (category_name) VALUES
                    ('$category')";
        $query = mysqli_query($this->connect(), $sql);

        return $query;
    }

    public function delete($category){
        $sql = "DELETE FROM category WHERE category_id = '$category'";
        $query = mysqli_query($this->connect(), $sql);
        return $query;
    }

    public function edit($category){
        $query = mysqli_query($this->connect(), " SELECT * FROM category WHERE category_id = '$category'");
        return $query;
    }

    public function update($category, $id) {
        $sql = "UPDATE category SET category_name = '$category' WHERE category_id = '$id' ";
        $query = mysqli_query($this->connect(), $sql);

        return $query;
    }

}
