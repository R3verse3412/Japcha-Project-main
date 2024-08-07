<?php
class AnnouncementModel extends Dbh
{
    public function getAllAnnouncement()
    {
        try {
            $announcements = array();
            $stmt = $this->connect()->prepare('SELECT * FROM announcements ORDER BY id DESC');
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $announcements[] = $row;
                }
            }
            return $announcements;
        } catch (\Throwable $a) {
            error_log($a->getMessage());
            // Don't use header() here, as it could cause issues when there are multiple announcements to fetch.
            return null;
        }
    }

    public function insertAnnouncement($formattedStartTime, $formattedEndTime, $getAnnouncement, $getContent)
    {
        $stmt = $this->connect()->prepare('INSERT INTO announcements (starting_date, ending_date, announcement, content) VALUES (?, ?, ?, ?)');
        if (!$stmt->execute(array($formattedStartTime, $formattedEndTime, $getAnnouncement, $getContent))) {
            throw new Exception("Failed to Add Announcement");
        }
    }

    public function editAnnouncement($formattedStartTime, $formattedEndTime, $editAnnouncement, $editContent,$couponID)
    {
        try {

            $stmt = $this->connect()->prepare('UPDATE announcements SET starting_date=?,ending_date=?,announcement=?,content=? WHERE id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($formattedStartTime, $formattedEndTime, $editAnnouncement, $editContent,$couponID))) {
                throw new Exception("Failed to update Announcement");
            }
    
            // Close the prepared statement
            $stmt = null;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/AnnouncementManagement.php?error=" . urlencode($e->getMessage()));
            exit();
        }

   
}
}
