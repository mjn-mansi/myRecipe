<?php 

$conn = new Connection;
 

class Menu extends Connection {

    public function checkExists($category, $menu){
        $query = mysqli_query($this->connect(), "SELECT * FROM menu WHERE menu_name = '$menu' AND category_id = '$category'");
        if(mysqli_num_rows($query) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function checkeditExists($category, $menu, $id){
        $query = mysqli_query($this->connect(), "SELECT * FROM menu WHERE menu_name = '$menu' AND category_id = '$category' AND menu_id != '$id' ");
        if(mysqli_num_rows($query) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function showCategory(){
        $query = mysqli_query($this->connect(), " SELECT * FROM category ORDER BY category_name ASC");
        return $query;
    }

    public function show(){
        $query = mysqli_query($this->connect(), " 
            SELECT * FROM menu 
            LEFT JOIN category ON category.category_id = menu.category_id
            ORDER BY category_name ASC, menu_name ASC");
        return $query;
    } 

    public function add($menu, $price, $category) {
        $sql = "INSERT INTO menu (menu_name, menu_price, category_id) VALUES
                    ('$menu', '$price', '$category')";
        $query = mysqli_query($this->connect(), $sql);

        return $query;
    }

    public function delete($menu){
        $sql = "DELETE FROM menu WHERE menu_id = '$menu'";
        $query = mysqli_query($this->connect(), $sql);
        return $query;
    }

    public function edit($menu){
        $query = mysqli_query($this->connect(), " SELECT * FROM menu WHERE menu_id = '$menu'");
        return $query;
    }

    public function update($menu, $price, $category, $id) {
        $sql = "UPDATE menu SET menu_name = '$menu', menu_price = '$price', category_id = '$category' WHERE menu_id = '$id' ";
        $query = mysqli_query($this->connect(), $sql);

        return $query;
    }

    public function showBookings($bookingType){
        $query = mysqli_query($this->connect(), "SELECT * FROM booking LEFT JOIN users ON booking.user_id = users.id WHERE booking_type = '$bookingType' ORDER BY booking.booking_id DESC");
        return $query;
    }

}
