<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>

<?php
require_once __DIR__ ."/../../database/database.php";
class Staff
{
  private $con ;
  public function __construct()
  {
    $this->con = Database::getInstance()->connectDB;
  }
 
  public function getStaffs() {
    $query = "SELECT * FROM `nhanvien`";
    $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
    return $result;
  }

    public function detail($id) {
      $query = "SELECT * FROM `nhanvien` where MSNV = '$id'";
      $result = $this->con->query($query)->fetch_assoc();
      return $result; 
    }
    public function login($username,$password) {
      $query = "SELECT `ChucVu`,`MSNV`,`HoTenNV`,`username` FROM `nhanvien` where username = '$username' and password = '$password'";
      $result = $this->con->query($query);
      if (!$result) {
        return null;
      }
      return $result->fetch_assoc(); 
    }
  
    public function insert($fullname,$position,$address,$phoneNumber,$username,$password) {
      $id = 'staff' . substr(uniqid(),7,10);
      $query = "INSERT INTO `nhanvien`(`MSNV`,`HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`,`username`,`password`) VALUES ('$id','$fullname','$position','$address','$phoneNumber','$username','$password')";
      $result = $this->con->query($query);
      if(!$result) {
        return 0;
      }
      return $id;
    }
  
    public function update($id, $fullname, $position, $address,$phoneNumber) {
        $query = "update `nhanvien` set `HoTenNV` = '$fullname', `ChucVu`= $position, `DiaChi`='$address', `SoDienThoai` = '$phoneNumber' where MSNV = '$id'";
        $result = $this->con->query($query);
        return $result;
    }

    public function delete($id) {
        $query = "delete from `nhanvien` where MSNV = '$id'";
        $result = $this->con->query($query);
        return $result;
    }
    public function getTypeStaff($type) {
      $query = "SELECT * FROM `NhanVien`where ChucVu = $type";
      $result = $this->con->query($query)->fetch_all(MYSQLI_ASSOC);
      return $result;
    }
}
  // $staff  = new Staff();
  // $result = $staff->login("tttin","827ccb0eea8a706c4c34a16891f84e7b");
  // var_dump($result);
?>