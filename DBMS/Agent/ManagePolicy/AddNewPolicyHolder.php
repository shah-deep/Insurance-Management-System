<?php
require_once '../header.php';
 ?>

<h1>Add New Policy Holder</h1>
  <div class="">
    <h2>Holder's Details:</h2>
    <form class="" action="../includes/AddNewPolicyHolder-inc.php" method="post">
      <input type="text" name="Name" placeholder="Name" required>
      <input type="email" name="Email_id" placeholder="Email_id" required>
      <input type="number" name="Mobile_no" placeholder="Mobile Number" min="5000000000" max="9999999999" required>
      <h7> Date of Birth:</h7>
      <input type="date" name="DOB" placeholder="DOB" required>

      <h2> Address: </h2>
      <input type="text" name="House_no" placeholder="House Number">
      <input type="text" name="Colony" placeholder="Colony">
      <input type="text" name="City" placeholder="City">
      <input type="number" name="Pincode" placeholder="Pincode">

      <h2>Nominee:</h2>
        <input type="text" name="Nominee_name" placeholder="Nominee Name" required>
        <select name="Nominee_relation" required>
             <option value="" selected disabled>Nominee Relation</option>
             <option value="Parent">Parent</option>
             <option value="Child">Child</option>
             <option value="Spouse">Spouse</option>
             <option value="Grand child">Grand Child</option>
             <option value="Relative">Relative</option>
             <option value="Friend">Friend</option>
        </select>

      <h2>Personal Details:</h2>
        <select name="Gender" required>
             <option value="" selected disabled>Select gender</option>
             <option value="MALE">Male</option>
             <option value="FEMALE">Female</option>
             <option value="OTHER">Other</option>
        </select>
        <input type="text" name="Occupation" placeholder="Occupation">
        <input type="text" name="Edu_ql" placeholder="Education Qualification">


        <br> <br>
        <button type="submit" name="submit">Add Policy Holder</button>

    </form>
  </div>

<?php
require_once '../footer.php';
 ?>
