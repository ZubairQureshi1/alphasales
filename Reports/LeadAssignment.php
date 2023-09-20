<?php 
include 'config.php';
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Reports</title>
  <style>
    *{
      color: #0171c3;
      background: #f5f5f5;
    }
    th{
      vertical-align: middle !important;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="card mt-5">
      <h4 class="m-3" >Filters</h4>

     <form action="" method="POST">
      <div class="card-body">
        <div class="row">


          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Enquiry By:</label>
              <select id="inputState" class="form-control" name="Enquiry_By">
                <option value="All" selected >Choose...</option>
                <?php   
                 
                 $sql = "SELECT * FROM users"; // Change "your_table" to your actual table name
 
                 // Execute the query
                 $result = $conn->query($sql);
           
                 if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()){
                   ?>
                 <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                           <?php
                                         }
                           }
 
                           ?>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Enquiry Entered By:</label>
              <select id="inputState" class="form-control" name="Enquiry_Entered_By">
                <option value="All" selected>Choose...</option>
                <?php   
                 
                 $sql = "SELECT DISTINCT `entry_by_name` FROM enquiries WHERE `entry_by_name` IS NOT NULL AND `entry_by_name`<>'0'"; // Change "your_table" to your actual table name
 
                 // Execute the query
                 $result = $conn->query($sql);
              
                 if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()){
                   ?>
                 <option value="<?= $row['entry_by_name']; ?>"><?= $row['entry_by_name']; ?></option>
                           <?php
                                         }
                           }
 
                           ?>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Enquiry Type(s):</label>
              <select id="inputState" class="form-control" name="Enquiry_Type">
                <option  value="All" selected >Choose...</option>
                <option>Telephonic</option>
                <option>Physical</option>
                <option>SM - Lead</option>
                <option>Cold Lead</option>
                <option>Inbound Tel. Call</option>
                <option>Outbound Tel. Call</option>
                <option>Others</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Enquiry Status(s):</label>
              <select id="inputState" class="form-control" name="Enquiry_Status">
                <option value="All" selected >Choose...</option>
                <option>Follow Up Required</option>
                <option>Dropped</option>
                <option>Sales Matured</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Source(s) of Information:</label>
              <select id="inputState" value="All" class="form-control" name="Source_Of_Information">
                <option value="All" selected >Choose...</option>
                <option>Streamers</option>
                <option>Hoarding</option>
                <option>Banners</option>
                <option>Flyers</option>
                <option>News Paper</option>
                <option>Tv Ad</option>
                <option>Cable</option>
                <option>Friend/ Relative</option>
                <option>WhatsApp</option>
                <option>SMS</option>
                <option>Facebook</option>
                <option>Instagram</option>
                <option>LinkedIn</option>
                <option>YouTube</option>
                <option>Google Ads</option>
                <option>Refered By</option>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">City:</label>
              <select id="inputState" class="form-control" name="City">
                <option value="All" selected>Choose...</option>
                <?php
                $sql = "SELECT * FROM `cities`"; // Change "your_table" to your actual table name

                // Execute the query
                $result = $conn->query($sql);
             
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()){
                  ?>
                <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                          <?php
                                        }
                          }

                          ?>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;" >Project(s):   </label>
              <select id="inputState" class="form-control" name="Project">
                <option value="All" selected>Choose...</option>
                <?php   

                $sql = "SELECT * FROM `wings`"; // Change "your_table" to your actual table name

                // Execute the query
                $result = $conn->query($sql);
                var_dump($result);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()){
                  ?>
                <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                          <?php
                                        }
                          }

                          ?>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;" >Product(s):</label>
              <select id="inputState" class="form-control" name="Product">
                <option value="All" selected>Choose...</option>
                <?php   
                 
                $sql = "SELECT * FROM `courses`"; // Change "your_table" to your actual table name

                // Execute the query
                $result = $conn->query($sql);
                var_dump($result);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()){
                  ?>
                <option value="<?= $row['name']; ?>"><?= $row['name']; ?></option>
                          <?php
                                        }
                          }

                          ?>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;" >Ranking:</label>
              <select id="inputState" class="form-control" name="Ranking">
                <option value="All" selected>Choose...</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                
                        
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;" >Lead Assignemnt:</label>
              <select id="inputState" class="form-control">
                <option selected disabled>Choose...</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">Start Date:</label>
              <input type="date" id="inputState" name="create_date" class="form-control"/>

            </div>
          </div>
          <div class="col-2">
            <div class="form-group ">
              <label for="inputState" style=" font-weight: 500;">End Date:</label>
              <input type="date" id="inputState" name="update_date" class="form-control"/>
               
            </div>
          </div>

        </div>


       <button onclick="pageRedirect()" type="button" class="btn btn-secondary float-right m-1">Back</button>
        <button type="submit" name="filter" class="btn btn-primary float-right m-1">Get Report</button>


      </div>
      </form>

    </div>

<?php 
if(isset($_POST['filter'])){
   
   ?> 
    <div class="card mt-4">
    <h4 class="m-3" >Lead Assignment</h4>

      <div class="card-body">
        <table class="table table-striped table-bordered text-nowrap table-responsive"  >
          <thead>
            <tr role="row" class="text-left">
              <th>Enq. ID</th>
              <th>Enq. Date</th>
              <th>Enq. Type</th>
              <th>Name</th>
              <th>Mobile 1</th>
              <th>Mobile 2</th>
              <th>Landline</th>
              <th>City</th>
              <th>Project</th>
              <th>Product</th>
              <th>Price Offer</th>
              <th>CNIC</th>
              <th>Enq. Statuses</th>
              <th>Source of Info.</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
          <?php  
          
      
          
                $Enquiry_By = $_POST['Enquiry_By'];
                  if($Enquiry_By=="All"){
                    $Enquiry_By = " like '%'";
                  }else{
                    $Enquiry_By = "='".$Enquiry_By."'";
                  }

                  $Enquiry_Entered_By = $_POST['Enquiry_Entered_By'];
                  if($Enquiry_Entered_By=="All"){
                    $Enquiry_Entered_By = " like '%'";
                  }else{
                    $Enquiry_Entered_By = "='".$Enquiry_Entered_By."'";
                  }

                  $Enquiry_Type = $_POST['Enquiry_Type'];
                  if($Enquiry_Type=="All"){
                    $Enquiry_Type = " like '%'";
                  }else{
                    $Enquiry_Type = "='".$Enquiry_Type."'";
                  }

                  $Enquiry_Status = $_POST['Enquiry_Status'];
                  if($Enquiry_Status=="All"){
                    $Enquiry_Status = " like '%'";
                  }else{
                    $Enquiry_Status = "='".$Enquiry_Status."'";
                  }

                  $Source_Of_Information = $_POST['Source_Of_Information'];
                  if($Source_Of_Information=="All"){
                    $Source_Of_Information = " like '%'";
                  }else{
                    $Source_Of_Information = "='".$Source_Of_Information."'";
                  }

                  $City = $_POST['City'];
                  if($City=="All"){
                    $City = " like '%'";
                  }else{
                    $City = "='".$City."'";
                  }

                  $Project = $_POST['Project'];
                  if($Project=="All"){
                    $Project = " like '%'";
                  }else{
                    $Project = "='".$Project."'";
                  }


                  $Product = $_POST['Product'];
                  if($Product=="All"){
                    $Product = " like '%'";
                  }else{
                    $Product = "='".$Product."'";
                  }


                  $Ranking = $_POST['Ranking'];
                  if($Ranking=="All"){
                    $Ranking = " like '%'";
                  }else{
                    $Ranking = "='".$Ranking."'";
                  }

                  

                  $startdate = $_POST['create_date'];
                  $enddate = $_POST['update_date'];
                 
                 
               $sql = "SELECT *  FROM enquiries LEFT JOIN enquiry_followups ON enquiries.id = enquiry_followups.enquiry_id WHERE  enquiries.entry_by_name $Enquiry_Entered_By   AND enquiries.enquiry_type $Enquiry_Type  AND enquiries.status $Enquiry_Status AND enquiries.source_info_id  $Source_Of_Information  AND enquiries.city_name $City AND enquiries.project_name $Project AND enquiries.product_name $Product AND enquiry_followups.interest_level $Ranking AND DATE(enquiries.created_at) BETWEEN DATE('$startdate') AND DATE('$enddate')" ; // Change "your_table" to your actual table name
             
               //  student_admission.study_model $model AND 
                 // Execute the query
                 $result = $conn->query($sql);
                
                 if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()){
                   ?>

            <tr >
              
              <td><?= $row['enq_form_code']?></td>
              <td ><?php 
              $datetimeFromDatabase = $row['created_at'];
              $dateOnly = date("Y-m-d", strtotime($datetimeFromDatabase));
              echo $dateOnly;
              ?></td>
              <td><?= $row['enquiry_type']?></td>
              <td><?= $row['name']?></td>
              <td><?= $row['phone1']?></td>
              <td><?= $row['phone2']?></td>
              <td><?= $row['landline']?></td>
              <td><?= $row['city_name']?></td>
              <td><?= $row['project_name']?></td>
              <td><?= $row['product_name']?></td>
              <td><?= $row['price_offer']?></td>
              <td><?= $row['student_cnic_no']?></td>
              <td><?= $row['status']?></td>
              <td><?= $row['source_info_id']?></td>
              <td><?php echo $row['present_address']." ".$row['permanent_address'];?></td>
              
            </tr>
            <?php
                                  
                   }
                          }

                          ?>
          </tbody>
          <tfoot></tfoot>
        </table>
      </div>
    </div>
    <?php
    }
    ?>
    </div>
    <script>
      const pageRedirect = () => {
         window.location.replace(`http://${window.location.host}/alphasales/`);
      }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>







        