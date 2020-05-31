<?php
require_once '../header.php';
 ?>

<h1>Add New Policy</h1>
  <div class="">
    <h2>Holder's Details:</h2>
    <form class="" action="../includes/AddNewPolicy-inc.php" method="post">
      <input type="text" name="Name" placeholder="Name" required>
      <input type="email" name="Email_id" placeholder="Email_id" required>
      <input type="number" name="Mobile_no" placeholder="Mobile Number" required>
      <h7> Date of Birth:</h7>
      <input type="date" name="DOB" placeholder="DOB">

      <p> Address: </p>
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

      <h2>Policy Details:</h2>
        <input type="number" name="Policy_no" placeholder="Policy No." required>
        <input type="number" name="Plan_no" placeholder="Plan No." required> <br> <br>
        <input type="number" name="Premium" placeholder="Premium" required>
        <input type="number" name="Term" placeholder="Term" required>
        <input type="number" name="PPT" placeholder="Premium Paying Term">
        <input type="number" name="SA" placeholder="Sum Assured" required>
        <select name="Mode" required>
             <option value="" selected disabled>Select Mode</option>
             <option value="yearly">Yearly</option>
             <option value="halfly">Half-Yearly</option>
             <option value="monthly">Monthly</option>
             <option value="quartely">Quartely</option>
        </select>
        <br><br>
        <h7> Date of Commencement:</h7>
        <input type="date" name="DOC" placeholder="Date Of Commencement" required>
        <h7> First Unpaid Payment:</h7>
        <input type="date" name="FUP" placeholder="First Unpaid Payment">
        <br> <br>
        <button type="submit" name="submit">Add Policy</button>

    </form>
  </div>

<?php
require_once '../footer.php';
 ?>
