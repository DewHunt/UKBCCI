<style>
    th,
    td {
        border-color: #96D4D4;
    }
</style>


<?php
include_once "../DB/db_connect.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlquery = "SELECT * FROM member_list WHERE id = $id";

    $result = $conn->query($sqlquery);


    if($result && $result->num_rows > 0) {
        $member = $result->fetch_assoc();
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="details-table">

                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Company Name</th>
                        <td><?php echo $member['company_name']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Establish Year </th>
                        <td><?php echo $member['establish_year']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Business Contact Number </th>
                        <td><?php echo $member['telephone']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Mobile</th>
                        <td><?php echo $member['mobile']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Type of Business</th>
                        <td><?php echo $member['business_type']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Business Address</th>
                        <td><?php echo $member['business_address']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px"> Number of Employee</th>
                        <td><?php echo $member['employee_number']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px"> Membership Type</th>
                        <td><?php echo $member['membership_type']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px"> Membership Fees</th>
                        <td><?php echo $member['selected_membership_amount']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Email Address</th>
                        <td><?php echo $member['email']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Website URL</th>
                        <td><?php echo $member['website']; ?></td>
                    </tr>
                    <tr>
                        <th width="250px">Never Provide Details Via</th>
                        <td><?php echo $member['shared_way']; ?></td>
                    </tr>

                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo "No member found with the provided ID.";
    }
} else {
    echo "Invalid request.";
}
?>