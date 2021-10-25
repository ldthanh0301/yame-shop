<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>

<?php
require_once __DIR__ ."/../../database/database.php";
class Customer
{
  private $con ;
  public function __construct()
  {
    $this->con = Database::getInstance()->connectDB;
  }
 
  public function getCustomers() {
    $query = "SELECT * FROM `KhachHang`";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
  }

    public function detail($id) {
      $query = "SELECT * FROM `KhachHang` where MSKH = '$id'";
      $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
      return $result; 
    }
  
    public function insert($fullname,$email,$address,$phoneNumber) {
      $id = 'KH' . substr(uniqid(),4,7);
      $query = "INSERT INTO `KhachHang`(`MSKH`,`HoTenKH`, `Email`, `SoDienThoai`) VALUES ('$id','$fullname','$email','$phoneNumber')";
      $result = $this->con->query($query);
      if(!$result) {
        return 0;
      }
      $query = "INSERT INTO `diachikh`(`MSKH`,`DiaChi`) VALUES ('$id','$address')";
      $result = $this->con->query($query);
      if(!$result) {
        return 0;
      }
      return $id;
    }
  
    public function update($id, $fullname, $address,$phoneNumber) {
        $query = "update `KhachHang` set `HoTenKH` = '$fullname', `SoDienThoai` = '$phoneNumber' where MSKH = '$id'";
        $result = $this->con->query($query);
        if (!$result) {
          return 0;
        }
        $query = "update `diachi` set `DiaCHi` = '$address' where MSKH = '$id')";
        $result = $this->con->query($query);
        return $result;
    }

    public function delete($id) {
        $query = "delete from `KhachHang` where MSKH = '$id'";
        $result = $this->con->query($query);
        return $result;
    }
   
}
   $customer = new Customer();
   var_dump($customer->insert('Le DTHanh','Thanhb@gmail.com','Nhơn mỹ, chợ mới','0333123123'));
?>