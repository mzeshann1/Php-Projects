<?php
// Include your database connection or any necessary files here
session_start();
require "../partials/_dbconnect.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['count']) && isset($_POST['cid'])) {
    $count = $_POST['count'];
    $cid = $_POST['cid'];

    // Calculate the offset based on the count
    $offset = $count - 2;

    // Fetch additional questions based on the count
    $sql = "SELECT * FROM `questions` WHERE `questions`.`category_id` = $cid LIMIT 2 OFFSET $offset";
    $result = mysqli_query($conn, $sql);

    // Check if there are more questions
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Output the additional questions in the same HTML structure as in the main page
            $q_id = $row["question_id"];
            $q_title = $row["question_title"];
            $q_description = $row["question_description"];
            $q_time = $row["created"];
            $q_user_id = $row["user_id"];

            $sql2 = "SELECT user_first_name FROM users WHERE sno= $q_user_id ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item mt-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="none" data-bs-toggle="collapse" data-bs-target="#collapse' . $q_id . '" aria-expanded="true" aria-controls="collapse' . $q_id . '" style="background-color: #6351ce !important;">
                                <div style="display: flex;
                                flex-direction: row;
                                justify-content: space-around;
                                align-items: center;
                                width: 100%;">
    
                                    <div>
                                        <span><i class="fa-solid fa-circle-user fa-xl me-2"></i>  ' . $q_title . ' </span>
                                            &nbsp;
                                            <span>by</span>
                                            &nbsp;
                                            <span>  ' . $row2["user_first_name"] . ' at ' . $q_time . ' </span>
                                            
                                        </div>
                                        <div >
                                                <a href="../others/thread_comment.php?question_id=' . $q_id . '" class="btn btn-primary ">Comment on this question</a>
                                        </div>
                                </div>
                            </button>
                        </h2>
                        <!-- <div id="collapse' . $q_id . '" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class=" ps-1"><a href="" style="color: black !important; text-decoration: none;">' . $q_description . '</a></p>
                                <a href="../others/thread_comment.php?question_id=' . $q_id . '" class="btn btn-primary">Comment on this question</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            ';
        }
    } else {
        echo "No more questions available.";
    }
} else {
    echo "Invalid request.";
}
?>
