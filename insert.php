<?php 
// Template Name:Test

get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<?php


global $wpdb;
$tablename = $wpdb->prefix."mahi";

if(isset($_POST['submit'])){
    $title = esc_attr($_POST['title']);
    $phone = esc_attr($_POST['phone']);
    $email = sanitize_email($_POST['email']);

    if(!is_email($email)) {
       echo '<div class="error"><p>Invalid e-mail!</p></div>';
      
    }

    $datum = $wpdb->get_results("SELECT * FROM $tablename WHERE email = '".$email."'");


    if($wpdb->num_rows > 0) {
        ?>
        <div class="wrap">
            <div class="error"><p>Student exsist!</p></div> 
        </div>
        <?php
    }else {

    $newdata = array(
        'title'=>$name,
        'phone'=>$phone,
        'email'=>$email,
    );
    $wpdb->insert( $tablename, $newdata);
    ?>
    <div class="wrap">
        <div class="updated"><p>Student added!</p></div>
    </div>
<?php }  }?>

 <form method="POST" style="padding:40px">
    <table>
        <tr>
            <td> <label for=" Name"> Name</label><input type="text" name="title" id="name" placeholder="Name" />
            <br>
        </td>
        </tr>
        <tr>
            <td> <br> <label for=" Email"> Email</label>    <input type="text" name="email" id="email" placeholder="Email" /> <br></td>
        </tr>
        <tr>
            <td> <br>
            <label for=" Phone"> Phone</label>    
            <input type="text" name="phone" id="phone"  placeholder="Phone" /> <br></td>
        </tr>
        <tr>
            <td> <br><input type="submit" name="submit"></td>
        </tr>
    </table>
</form>

<?php //get_footer() ?>
