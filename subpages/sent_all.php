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
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Recipient</th>
                            <th>Sent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            if (Message::getSentMessages($conn, $_SESSION['user_id']) != NULL) {
                                
                                foreach (Message::getSentMessages($conn, $_SESSION['user_id']) as $row) {

                                    $shortMessage = (strlen($row->getMessage()) > 30) ? substr($row->getMessage(), 0, 29) . "..." : $row->getMessage();

                                    echo "<tr>";
                                    echo "<td><a href='sent.php?id=" . $row->getId() . "'>" . $row->getTitle() . "</a></td>";
                                    echo "<td>" . $shortMessage . "</td>";
                                    echo "<td>" . $row->getRecipientname() . " </td>";
                                    echo "<td>" . $row->getSendDatetime() . " </td>";
                                    echo "</tr>";

                                }
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';

