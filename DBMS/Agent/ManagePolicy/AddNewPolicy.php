<?php
require_once '../header.php';
 ?>

<h1>Add New Policy</h1>
  <div class="">
    <h2>Holder's Details:</h2>
    <form class="" action="../includes/AddNewPolicy-inc.php" method="post">
      <input type="text" name="Name" placeholder="Name">
      <input type="email" name="Email_id" placeholder="Email_id">
      <h7> Date of Birth:</h7>
      <input type="date" name="DOB" placeholder="DOB">
<!-- Age     <input type="" name="" placeholder="Age">    -->
      <p> Address: </p>
      <input type="text" name="House_no" placeholder="House Number">
      <input type="text" name="Colony" placeholder="Colony">
      <input type="text" name="City" placeholder="City">
      <input type="number" name="Pincode" placeholder="Pincode">

      <h2>Nominee:</h2>
        <input type="text" name="Nominee_name" placeholder="Nominee Name">
        <input type="text" name="Nominee_relation" placeholder="Nominee Relation">

      <h2>Personal Details:</h2>
        <input type="number" name="Height" placeholder="Height">
        <input type="number" name="Weight" placeholder="Weight">
        <select name="Gender" required>
             <option value="" selected disabled>Select gender</option>
             <option value="M">Male</option>
             <option value="F">Female</option>
             <option value="O">Other</option>
        </select>
        <input type="text" name="Occupation" placeholder="Occupation">
        <input type="text" name="Edu_ql" placeholder="Education Qualification">

      <h2>Policy Details:</h2>
        <input type="number" name="Policy_no" placeholder="Policy No.">
        <input type="number" name="Plan_no" placeholder="Plan No."> <br> <br>
        <input type="number" name="Premium" placeholder="Premium">
        <input type="number" name="Commission" placeholder="Commission">
        <input type="number" name="Term" placeholder="Term">
        <input type="number" name="PPT" placeholder="Premium Paying Term">
        <input type="number" name="SA" placeholder="Sum Assured">
        <input type="text" name="Mode" placeholder="Mode"><br>
        <h7> Date of Commencement:</h7>
        <input type="date" name="DOC" placeholder="Date Of Commencement">
        <h7> First Unpaid Payment:</h7>
        <input type="date" name="FUP" placeholder="First Unpaid Payment">
        <br> <br>
        <button type="submit" name="submit">Add Policy</button>

    </form>
  </div>

<?php
require_once '../footer.php';
 ?>
