<?php
require_once '../header.php';
require '../../database.php';

$policy_no = $_GET['Policy_no'];
$name = $_GET['Name'];

$sql = "SELECT * FROM Policy_holder WHERE Policy_no = $policy_no AND Name = '$name'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
        $row = mysqli_fetch_assoc($result); ?>

<h1>Update Policy Holder</h1>
  <div class="">
    <h2>Holder's Details:</h2>
    <form class="" action="../includes/UpdatePolicyHolder-inc.php" method="post">
      <input hidden name="Policy_no" value="<?php echo $row['Policy_no'] ?>">
      Name:<input type="text" name="Name" placeholder="Name" value = "<?php echo $row['Name'] ?>" required>
      E-mail:<input type="email" name="Email_id" placeholder="Email_id" value = "<?php echo $row['Email_id'] ?>" required>
      Moblie_no:<input type="number" name="Mobile_no" placeholder="Mobile Number" min="5000000000" max="9999999999" value = "<?php echo $row['Mobile_no'] ?>" required>
      <h7> Date of Birth:</h7>
      <input type="date" name="DOB" placeholder="DOB" value = "<?php echo $row['DOB'] ?>" required>

      <h2> Address: </h2>
      House_no:<input type="text" name="House_no" placeholder="House Number" value = "<?php echo $row['House_no'] ?>">
      Colony:<input type="text" name="Colony" placeholder="Colony" value = "<?php echo $row['Colony'] ?>">
      City:<input type="text" name="City" placeholder="City" value = "<?php echo $row['City'] ?>">
      Pincode:<input type="number" name="Pincode" placeholder="Pincode" value = "<?php echo $row['Pincode'] ?>">

      <h2>Nominee:</h2>
        Nominee_name:<input type="text" name="Nominee_name" placeholder="Nominee Name" value = "<?php echo $row['Nominee_name'] ?>" required>
        Nominee_relation:<select name="Nominee_relation" required>
             <option value="" selected disabled>Nominee Relation</option>
             <option <?php if ($row['Nominee_relation']=="Parent") {
            echo 'selected';
        } ?> value="Parent">Parent</option>
             <option <?php if ($row['Nominee_relation']=="Child") {
            echo 'selected';
        } ?> value="Child">Child</option>
             <option <?php if ($row['Nominee_relation']=="Spouse") {
            echo 'selected';
        } ?> value="Spouse">Spouse</option>
             <option <?php if ($row['Nominee_relation']=="Grand child") {
            echo 'selected';
        } ?> value="Grand child">Grand Child</option>
             <option <?php if ($row['Nominee_relation']=="Relative") {
            echo 'selected';
        } ?> value="Relative">Relative</option>
             <option <?php if ($row['Nominee_relation']=="Friend") {
            echo 'selected';
        } ?> value="Friend">Friend</option>
        </select>

      <h2>Personal Details:</h2>
        Gender:<select name="Gender" required>
             <option value="" selected disabled>Select gender</option>
             <option <?php if ($row['Gender']=="MALE") {
            echo 'selected';
        } ?> value="MALE">Male</option>
             <option <?php if ($row['Gender']=="FEMALE") {
            echo 'selected';
        } ?> value="FEMALE">Female</option>
             <option <?php if ($row['Gender']=="OTHER") {
            echo 'selected';
        } ?> value="OTHER">Other</option>
        </select>
        Occupation:<input type="text" name="Occupation" placeholder="Occupation" value = "<?php echo $row['Occupation'] ?>">
        Edu_ql:<input type="text" name="Edu_ql" placeholder="Education Qualification" value = "<?php echo $row['Edu_ql'] ?>">


        <br> <br>
        <button type="submit" name="submit">Update Policy Holder Details</button>

    </form>
  </div>

<?php
    } else {
        header("Location: UpdatePolicy.php?error=Policy_Does_Not_Exist");
        exit();
    }
require_once '../footer.php';
 ?>
