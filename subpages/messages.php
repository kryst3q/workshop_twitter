<?php

session_start();

require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../src/Message.php';
require_once '../config/connection.php';

?>

<div class="container">
    <div class="row">
        <?php 
            require_once '../template/messages_navbar.html';
        ?>
        <div class="col-md-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sender</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        foreach (Message::getAllMessages($conn, $_SESSION['user_id']) as $row) {

                            echo "<tr>";
                            echo "<td><a href='message.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td>";
                            echo "<td>" . $row['sender'] . " </td>";
                            echo "<td>" . $row['send_datetime'] . " </td>";
                            echo "</tr>";

                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<?php

require_once '../template/footer.html';