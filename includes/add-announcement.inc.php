<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['saveAddButton'])) {
        // Handle addition of an announcement
        $getStartDate = $_POST["editStartTime"];
        $getEndDate = $_POST["editEndTime"];
        $getAnnouncement = htmlspecialchars($_POST["getTitle"], ENT_QUOTES, 'UTF-8');
        $getContent = htmlspecialchars($_POST["getContent"], ENT_QUOTES, 'UTF-8');

        // Format date using the correct format
        $formattedStartTime = date("Y-m-d H:i:s", strtotime($getStartDate));
        $formattedEndTime = date("Y-m-d H:i:s", strtotime($getEndDate));

        // Create an instance of AnnouncementModel
        include "../classes/dbh.classes.php";
        include "../classes/AnnouncementModel.php";
        $announcement = new AnnouncementModel();

        // Attempt to add the announcement
        try {
            $announcement->insertAnnouncement($formattedStartTime, $formattedEndTime, $getAnnouncement, $getContent);
            header("location: ../back-end/AnnouncementManagement.php?success=announcementadded");
            exit();
        } catch (Exception $e) {
            header("location: ../back-end/AnnouncementManagement.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    if (isset($_POST['updateButton'])) {
        // Handle the update of an announcement
        $editStartDate = htmlspecialchars($_POST["editStartTime"], ENT_QUOTES, 'UTF-8');
        $editEndDate = htmlspecialchars($_POST["editEndTime"], ENT_QUOTES, 'UTF-8');
        $editAnnouncement = htmlspecialchars($_POST["editTitle"], ENT_QUOTES, 'UTF-8');
        $editContent = htmlspecialchars($_POST["editContent"], ENT_QUOTES, 'UTF-8');
        $couponID = htmlspecialchars($_POST["announcementID"], ENT_QUOTES, 'UTF-8');
        $formattedStartTime = date("Y-m-d H:i:s", strtotime($editStartDate));
        $formattedEndTime = date("Y-m-d H:i:s", strtotime($editEndDate));

        // Create an instance of AnnouncementModel
        include "../classes/dbh.classes.php";
        include "../classes/AnnouncementModel.php";
        $announcement = new AnnouncementModel();

        // Attempt to edit the announcement
        try {
            $announcement->editAnnouncement($formattedStartTime, $formattedEndTime, $editAnnouncement, $editContent, $couponID);
            header("location: ../back-end/AnnouncementManagement.php?success=announcementupdated");
            exit();
        } catch (Exception $e) {
            header("location: ../back-end/AnnouncementManagement.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }
}

