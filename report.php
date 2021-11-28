
<?php 
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    if(!isset($_SESSION["business_id"])){
        header("location: profile.php");
        exit;
    }
         

    require("fpdf.php");
    require_once("config.php");

    $pdf = new FPDF();

    //get variable
    $id = $_SESSION['business_id'];

    $sql = "SELECT * FROM business_information WHERE business_id = '$id'";

    $obj = 0;
    if($result = $mysqli->query($sql)) {
        $obj = $result->fetch_object();
    }

    $business_name = $obj->business_name;
    $district=$obj->address_district;
    $address=$obj->address_street;
    $date = date('jS \of F Y');
    $dateStart = date('jS \of F Y', strtotime('-7 days'));
    
    // THANK YOU
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",25);
    $pdf->Cell(190,10,"Small Business Hub",0,1,"C");
    $pdf->Cell(190,10,"",0,1,"C");
    
    $pdf->SetFont("Arial","B",19);
    $pdf->Cell(190,10,"Report of Engagement",0,1,"C");
    
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(190,10,"Your report of engagement between $dateStart and $date",0,1,"C");
    
    $pdf->Cell(190,10,"",0,1,"C");
    
    
    // Business DETAILS
    $pdf->SetFont("Arial","B",19);
    $pdf->Cell(190,10,"Business Details",1,1,"C");
    
    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(95, 10, "Business Name:", 0, 0);
    $pdf->Cell(95, 10, "Image:", 0, 1);

    
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(95, 10, $business_name, 0, 0);
    
    $image = $obj->image;
    const TEMPIMGLOC = 'tempimg.png';
    if( file_put_contents(TEMPIMGLOC, $image) !== false) {
        $pdf->Image(TEMPIMGLOC, $pdf->GetX(), $pdf->GetY(), 0, 50);
    }
    $pdf->Cell(0, 50, '', 0, 1);
    

    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(95, 10, "Address:", 0, 0);
    $pdf->Cell(95, 10, "District:", 0, 1);
    
    $pdf->SetFont("Arial","",12);
    $pdf->Cell(95, 10, $address, 0, 0);
    $pdf->Cell(95, 10, $district, 0, 1);
    
    $pdf->Cell(95, 10, "", 0, 1);
    
    
    
    // ORDER ITEMS
    $pdf->SetFont("Arial","B",19);
    $pdf->Cell(190,10,"Posts",1,1,"C");
    
    
    $pdf->SetFont("Arial","",15);
    $pdf->Cell(110, 10, "Image", 0, 0);
    $pdf->Cell(40, 10, "Description", 0, 0, "R");
    $pdf->Cell(40, 10, "Likes", 0, 1, "R");
    

    $pdf->SetFont("Arial","",12);

    $sql = "SELECT * FROM posts WHERE business_id = $id AND created_at >= now() - INTERVAL 7 day";

    $total = 0;
    if($result = $mysqli->query($sql)) {
        while( $row = $result->fetch_object()) {

            if(($pdf->GetPageHeight() - $pdf->GetY()) < 100){
                $pdf->AddPage();
            }
            
            $image_loc = "tempimg_$row->post_id.png";
            if( file_put_contents($image_loc, $row->photo) !== false) {
                $pdf->Image($image_loc, $pdf->GetX(), $pdf->GetY(), 0, 50);
            }
            $pdf->Cell(80, 60, '', 0, 0, "R");
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $pdf->MultiCell(70, 10, substr($row->description, 0, 100), 0, "R");

            $pdf->SetXY($x+70, $y);

            $likes_sql = "SELECT COUNT(*) as likes FROM saves WHERE post_id = '$row->post_id'";

            if($likes_result = $mysqli->query($likes_sql)) {
                $likes_object = $likes_result->fetch_object();
                $pdf->Cell(40, 60, $likes_object->likes, 0, 1, "R");
                $total += $likes_object->likes;
            }
        }
    } else {
        echo mysqli_error($mysqli);
    }

    // for ($i = 0; $i < count($cart); $i++){
    //     $item_id = $cart[$i]["id"];
    //     $quantity = $cart[$i]["quantity"];
    //     $sql = "SELECT * FROM items WHERE item_id = $item_id";
        
    //     if($result = $mysqli->query($sql)){
    //         $row = $result->fetch_object();
            
    //         $pdf->Cell(110, 10, $row->title, 0, 0);
    //         $pdf->Cell(40, 10, $quantity, 0, 0, "R");
    //         $pdf->Cell(40, 10, '$'.$row->price.'.00', 0, 1, "R");
    //         $total += $row->price * $quantity;
            
    //         $sql = "INSERT INTO receipts_items (receipt_id, title, quantity, price)
    //         VALUES ($id,'$row->title', '$quantity', '$row->price');
    //         ";
    //         if(!mysqli_query($mysqli,$sql)){
    //             echo $sql;
    //             echo ("Error\n".mysqli_error($mysqli));
    //         }
            
    //     }
    // }

    $pdf->Cell(110, 10, "", 0, 1);
    $pdf->Cell(110, 10, "", 0, 0);
    $pdf->SetFont("Arial","B",12);
    $pdf->Cell(40, 10, "Total Likes", 0, 0);
    $pdf->Cell(40, 10, $total, 0, 1, "R");


    $pdf->Output();
?>
