<?php include "../connect.php" ?>
<!doctype html>
<html lang="en">
<?php 
session_start(); // เริ่ม session

// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // เปลี่ยนเส้นทางไปยังหน้า login
    exit(); // ออกจาก script
}

// ส่วนที่เหลือของโค้ดใน index.php จะอยู่ที่นี่
?>
  <head>
    <meta charset="utf-8">
    <title>CS Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="mcss.css" rel="stylesheet" type="text/css" />
    <script src="mpage.js"></script>
  </head>

  <body>

    <header>
      <div class="logo">
        <img src="cslogo.jpg" width="200" alt="Site Logo">
      </div>
      <h1>Search Member</h1>
      <a href="logout.php">logout</a>
    </header>

    <div class="mobile_bar">
      <a href="#"><img src="responsive-demo-home.gif" alt="Home"></a>
      <a href="#" onClick='toggle_visibility("menu"); return false;'><img src="responsive-demo-menu.gif" alt="Menu"></a>
    </div>

    <main>
      <article>
      
   
      

      <!-- ฟอร์มสำหรับค้นหา -->
      <form method="get">
            <input type="text" name="search" placeholder="Search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"><br>
            <button type="submit">ค้นหา</button>
        </form>
        
        <hr>

        <?php
        // ตรวจสอบว่ามีการส่งค่าการค้นหาหรือไม่
        if (isset($_GET['search']) && $_GET['search'] != '') {
            $search = '%' . $_GET['search'] . '%'; // ใช้ % เพื่อค้นหาคำที่มีส่วนคล้ายกัน
            $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ? OR address LIKE ? OR email LIKE ?");
            $stmt->execute([$search, $search, $search]);

            // แสดงผลลัพธ์การค้นหา
        while ($row = $stmt->fetch()) {
         echo "ชื่อสมาชิก : " . $row["name"] . "<br>";
         echo "ที่อยู่ : " . $row["address"] . "<br>";
         echo "อีเมล์ : " . $row["email"] . "<br>";
         echo "<img src='../member_photo/" . $row['username'] . ".jpg' width='100' style='display:block'><br>";
         echo "<hr>";
     }
        }
            
        ?>

      </article>
      <nav id="menu">
        <h2>Navigation</h2>
        <ul class="menu">
          <li class="dead"><a>Home</a></li>
          <li><a href="member.php">All member</a></li>
          <li><a href="product.php">Table of All Products</a></li>
          <li><a href="deletemem.php">delete member</a></li>
          <li><a href="insertmem.php">Insert member</a></li>
          <li><a href="searchmem.php">Search member</a></li>
          <li><a href="productpic.php">ALL product pic</a></li>
          <li><a href="editproduct.php">Edit product</a></li>
          <li><a href="addproduct.php">Add product</a></li>
          <li><a href="deleteproduct.php">Delete product</a></li>
          <li><a href="workshopsql.php">lab7workshopsql</a></li>
          <li><a href="lab10.php">lab10</a></li>
          <li><a href="lab10order.php">lab10order</a></li>
          <li><a href="lab10cart.php">lab10cart</a></li>
          <li><a href="lab10detail.php">lab10detail</a></li>
          <li><a href="lab11.php">lab11</a></li>
          <li><a href="lab12.php">lab12</a></li>
          <li><a href="q_trytest.php">testquiz4</a></li>
        </ul>
      </nav>
     
    </main>
   
  </body>
</html>