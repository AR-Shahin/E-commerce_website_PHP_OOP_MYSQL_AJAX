<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/21/2020
 * Time: 10:04 AM
 */

namespace App\classes;
#require_once '../../vendor/autoload.php';
use App\classes\Database;
class Manage extends Database
{

    public function manageRecordWithPagination($table,$pno,$n=10,$c='N',$I=0,$key = 'null'){
        # $a = self::pagination($this->con,$table,$pno,5);
        $a = $this->pagination($table,$pno,$n);
        if ($table == "categories") {
            $sql = "SELECT p.cat_id,p.catname as category, c.catname as parent FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cat_id ORDER BY cat_id DESC  ".$a["limit"];
        }else if($table == "products"){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id`   ORDER BY p.`product_id` DESC  ".$a["limit"];
        }else if($table == "invoice"){
            $sql = "SELECT * FROM `invoice` ORDER BY `invoice_no` DESC ".$a["limit"];
        }
        else{
            $sql = "SELECT * FROM ".$table."  "."ORDER BY brand_id DESC". "  ".$a["limit"];
        }
        if($c == 'C'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND c.cat_id = '$I' AND p.quantity > 0 ORDER BY p.`product_id` DESC  ".$a["limit"];
        }
        if($c == 'R'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND p.quantity > 0 ORDER BY RAND() LIMIT 0 ,4 ";
        }
        if($c == 'search'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND `keywords` LIKE '%$key%' AND p.quantity > 0 ORDER BY `product_id` DESC ";
        }
        if($c == 'newOrder'){
            $sql ="SELECT orders.*,customers.* FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id WHERE orders.status = 0 ORDER BY orders.date DESC ".$a["limit"];
        }
        if($c == 'manageOrder'){
            $sql ="SELECT orders.*,customers.* FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id ORDER BY orders.`odr_id` DESC  ".$a["limit"];
        }
        if($c == 'shiftOrder'){
            $sql = "SELECT orders.*,customers.* FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id WHERE orders.status = 1 ORDER BY orders.`odr_id` DESC ".$a["limit"];
        }
        if($c == 'delivery'){
            $sql = "SELECT orders.*,customers.* FROM orders INNER JOIN customers ON customers.cus_id = orders.cus_id WHERE orders.status = 2 OR orders.status = 3 ORDER BY orders.`odr_id` DESC ".$a["limit"];
        }
        #$result = Database::connect($sql);
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ["rows"=>$rows,"pagination"=>$a["pagination"]];
    }

    public function pagination($table,$pno,$n){
        $sql = "SELECT COUNT(*) as 'rows' FROM $table";
        #$query = Database::connect($sql);
        $query = $this->con->query($sql);
        # $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
        $row = mysqli_fetch_assoc($query);
        //$totalRecords = 100000;
        $pageno = $pno;
        $numberOfRecordsPerPage = $n;

        $last = ceil($row["rows"]/$numberOfRecordsPerPage);

        $pagination = "<ul class='pagination'>";

        if ($last != 1) {
            if ($pageno > 1) {
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li></li>";
            }
            for($i=$pageno - 5;$i< $pageno ;$i++){
                if ($i > 0) {
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                }

            }
            $pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
            for ($i=$pageno + 1; $i <= $last; $i++) {
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                if ($i > $pageno + 4) {
                    break;
                }
            }
            if ($last > $pageno) {
                $next = $pageno + 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a></li></ul>";
            }
        }
        //LIMIT 0,10
        //LIMIT 20,10
        $limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

        return ["pagination"=>$pagination,"limit"=>$limit];
    }

    public  function getAllData($table,$id,$sort){
        $sql = "SELECT * FROM `$table` ORDER BY`$id` $sort ";
        # $res = Database::connect($sql);
        $res = $this->con->query($sql);
        if($res != false){
            $count = mysqli_num_rows($res);
            if($count == 0){
                return "NO_DATA_FOUNDED";
            }else{
                $rows = array();
                while($row = $res->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

    }

    public function deleteRecord($table,$pk,$id){
        if($table == "categories"){

            # $pre_stmt = $this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
            #  $pre_stmt->bind_param("i",$id);
            #  $pre_stmt->execute();
            #  $result = $pre_stmt->get_result() or die($this->con->error);
            $sql = "SELECT ".$id." FROM categories WHERE parent_cat = ".$id ."";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            }else{
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result) {
                    return "CATEGORY_DELETED";
                }
            }
        }else{
            $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
            $pre_stmt->bind_param("i",$id);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return "DELETED";
            }
        }
    }

    /* public function getSingleData($table,$pk,$id){
         $sql = "SELECT * FROM $table WHERE $pk = $id";
         $res = $this->con->query($sql);
         if($res->num_rows == 1){
             $row = $res->fetch_assoc();
         }
         return $row;
     }*/

    public function single_record($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
        }
        return $row;
    }
    public function update_record($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='".$value."', ";
        }
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return "UPDATED";
        }else{
            return "NOT_UPDATED";
        }
    }
    public function getSingleProduct($pid){
        $sql = "SELECT p.product_id, p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND p.`product_id` = '$pid' ";
        $res = $this->con->query($sql);
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
        }
        return $row;
    }
    public function autoComplete($content){
        $sql = "SELECT * FROM `products` WHERE `keywords` LIKE '%$content%' ";
        $res = $this->con->query($sql);
        $result = '';
        $result.='<div class "skill_style"><ul>';
        if($res->num_rows == 0){
            $result.='<li>Not Found</li>';
        }else{
            while ($data = $res->fetch_assoc()){
                $result.= '<li>'.$data['keywords'].'</li>';
            }
        }

        $result.='</ul></div>';
        echo $result;
    }

    public function checkDoubleItem($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        if($res->num_rows > 0){
            return 'EXISTS';
        }else{
            return 'NOT_EXISTS';
        }
    }
    public function getAllOrderProduct($id){
        $sql= "SELECT * FROM `orders` WHERE `status` != 3 AND cus_id = $id ORDER BY odr_id DESC ";
        $data = array();
        $res = mysqli_query($this->con,$sql);
        $r = $res->num_rows;
        if( $r>0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function getBottomProduct($case){
        if($case == 'FET'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND `type` = 0 ORDER BY RAND() LIMIT 0 ,3 ";
        }else if($case == 'TOP'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND `type` = 2 ORDER BY RAND() LIMIT 0 ,3 ";
        } else if($case == 'NEW'){
            $sql = "SELECT p.`product_id`,p.productname,c.catname,b.brandname,p.price,p.quantity,p.add_date,p.status,p.`image`,p.`keywords`,p.`type`,p.`description` FROM products p,brands b,categories c WHERE p.`brand_id` = b.`brand_id` AND p.`cat_id` = c.`cat_id` AND type = 1 ORDER BY RAND() LIMIT 0 ,3 ";
        }
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;

    }

    public function countRow($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        $count = $res->num_rows;
        return $count;
    }

    public function fetch_data_conditions($table,$where){
        $sql ="";
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT * FROM ".$table . " WHERE ".$conditions;
        $data = array();
        $res = mysqli_query($this->con,$sql);
        $r = $res->num_rows;
        if( $r>0){
            while($row = $res->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    public function countColumnSum($table,$column,$where){
        $sql ="";
        $sum = 0;
        $conditions = "";
        foreach($where as $key => $value){
            //`id` = 'n'
            $conditions.= $key. "='". $value ."' AND ";
        }
        $conditions = substr($conditions,0,-5);
        $sql .= "SELECT $column FROM ".$table . " WHERE ".$conditions;
        $res = $this->con->query($sql);
        $count = $res->num_rows;
        if( $count>0){
            while($row = $res->fetch_assoc()){
                $sum += $row[$column];
            }
            return $sum;
        }
    }
}