<?php
include('connection.php');

if(isset($_GET['status']))
    {
        $id=$_GET['status'];
        $select=mysqli_query($con,"select * from coupon_code where id='$id'");
        while($row=mysqli_fetch_object($select))
        {
            $status_var=$row->status;
            if($status_var=='0')
            {
                $status_state=1;
            }
            else
            {
                $status_state=0;
            }
            $update=mysqli_query($con,"update coupon_code set status='$status_state' where id='$id' ");
            if($update)
            {
                header("Location:dashboard.php");
            }
            else
            {
                echo mysqli_error($con);
            }
        }
?>
<?php
    }
?>