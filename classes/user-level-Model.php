<?php

class UserLevel extends Dbh {

    public function setUserLevel($name, $dashboard_view, $dashboard_edit,$orderManagement_view ,  $orderManagement_create, $contentManagement_view, $contentManagement_create, $contentManagement_edit,$contentManagement_delete,  $fileManagement_view, $fileManagement_create,  $fileManagement_edit, $fileManagement_delete, $fileManagement_archive, $statisticsManagement_view, $statisticsManagement_create, $chatManagement_view, $chatManagement_create,   $marketingManagement_view,  $marketingManagement_create,  $marketingManagement_edit, $marketingManagement_delete,  $marketingManagement_archive ) {
            try {

                $stmt = $this->connect()->prepare('INSERT INTO user_level (user_level_name,  dashboard_view, dashboard_edit, orderManagement_view, orderManagement_create, contentManagement_view  ,  contentManagement_create  ,  contentManagement_edit ,  contentManagement_delete, fileManagement_view, fileManagement_create ,  fileManagement_edit ,  fileManagement_delete, fileManagement_archive, statisticsManagement_view, statisticsManagement_create, chatManagement_view, chatManagement_create,  marketingManagement_view,  marketingManagement_create,  marketingManagement_edit, marketingManagement_delete,  marketingManagement_archive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');

                // Execute the query
                if (!$stmt->execute(array($name, $dashboard_view, $dashboard_edit,$orderManagement_view ,  $orderManagement_create, $contentManagement_view, $contentManagement_create, $contentManagement_edit,$contentManagement_delete,  $fileManagement_view, $fileManagement_create,  $fileManagement_edit, $fileManagement_delete, $fileManagement_archive, $statisticsManagement_view, $statisticsManagement_create, $chatManagement_view, $chatManagement_create,   $marketingManagement_view,  $marketingManagement_create,  $marketingManagement_edit, $marketingManagement_delete,  $marketingManagement_archive ))) {
                    throw new Exception("User registration failed.");
                    header("location: ../back-end/userLevel.php?error=userregistrationfailed");
                   
                }

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../back-end/userLevel.php?error=" . urlencode($th->getMessage()));
                exit();
            }
        
    }

    public function updateUserLevel($name, $dashboard_view, $dashboard_edit, $orderManagement_view, $orderManagement_create, $contentManagement_view, $contentManagement_create, $contentManagement_edit, $contentManagement_delete, $fileManagement_view, $fileManagement_create, $fileManagement_edit, $fileManagement_delete, $fileManagement_archive, $statisticsManagement_view, $statisticsManagement_create, $chatManagement_view, $chatManagement_create, $marketingManagement_view, $marketingManagement_create, $marketingManagement_edit, $marketingManagement_delete, $marketingManagement_archive, $userlvlID)
    {
        try {
            $stmt = $this->connect()->prepare('UPDATE `user_level` SET `user_level_name`= ?, `dashboard_view`= ?, `dashboard_edit`=?, `contentManagement_view`= ?, `contentManagement_create`= ?, `contentManagement_edit`= ?, `contentManagement_delete`= ?, `fileManagement_view`= ?, `fileManagement_create`= ?, `fileManagement_edit`=?, `fileManagement_delete`=?, `fileManagement_archive`=?, `orderManagement_view`=?, `orderManagement_create`=?, `statisticsManagement_view`=?, `statisticsManagement_create`=?, `chatManagement_view`=?, `chatManagement_create`= ?, `marketingManagement_view`=?, `marketingManagement_create`=?, `marketingManagement_edit`=?, `marketingManagement_delete`=?, `marketingManagement_archive`= ? WHERE userlevel_id = ?');
    
            // Bind parameters
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $dashboard_view);
            $stmt->bindParam(3, $dashboard_edit);
            $stmt->bindParam(4, $contentManagement_view);
            $stmt->bindParam(5, $contentManagement_create);
            $stmt->bindParam(6, $contentManagement_edit);
            $stmt->bindParam(7, $contentManagement_delete);
            $stmt->bindParam(8, $fileManagement_view);
            $stmt->bindParam(9, $fileManagement_create);
            $stmt->bindParam(10, $fileManagement_edit);
            $stmt->bindParam(11, $fileManagement_delete);
            $stmt->bindParam(12, $fileManagement_archive);
            $stmt->bindParam(13, $orderManagement_view);
            $stmt->bindParam(14, $orderManagement_create);
            $stmt->bindParam(15, $statisticsManagement_view);
            $stmt->bindParam(16, $statisticsManagement_create);
            $stmt->bindParam(17, $chatManagement_view);
            $stmt->bindParam(18, $chatManagement_create);
            $stmt->bindParam(19, $marketingManagement_view);
            $stmt->bindParam(20, $marketingManagement_create);
            $stmt->bindParam(21, $marketingManagement_edit);
            $stmt->bindParam(22, $marketingManagement_delete);
            $stmt->bindParam(23, $marketingManagement_archive);
            $stmt->bindParam(24, $userlvlID);
    
            // Execute the query
            if (!$stmt->execute()) {
                throw new Exception("User registration failed.");
            }
    
            $stmt = null;
    
        } catch (\Throwable $th) {
            header("location: ../back-end/userLevel.php?error=" . urlencode($th->getMessage()));
            exit();
        }
    }
    

    public function getUserlevel(){
        $stmt = $this->connect()->prepare('SELECT * FROM user_level WHERE isDeleted != 1 AND archive != 1 ORDER BY userlevel_id ASC');

        if(!$stmt->execute()) {
            $stmt = null;
            header("location: ../back-end/userLevel.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            // header("location: ../back-end/userLevel.php?error=userlevelnotfound");
            exit();
        }

        $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $profileData;

    }

    public function getArchivedUserlevel(){
        $stmt = $this->connect()->prepare('SELECT * FROM user_level WHERE isDeleted != 1 AND archive = 1 ORDER BY user_level_name DESC');

        if(!$stmt->execute()) {
            $stmt = null;
            header("location: ../back-end/userLevel.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            return true;
            // header("location: ../back-end/userLevel.php?error=userlevelnotfound");
            exit();
        }

        $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $profileData;

    }

    public function getUserlevelByID($userlvlid){
        $stmt = $this->connect()->prepare('SELECT * FROM user_level WHERE isDeleted != 1 AND archive != 1 AND userlevel_id != ? ORDER BY userlevel_id ASC LIMIT 7;');

        if(!$stmt->execute([$userlvlid])) {
            $stmt = null;
            header("location: ../back-end/userLevel.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            // header("location: ../back-end/userLevel.php?error=userlevelnotfound");
            exit();
        }

        $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $profileData;

    }

    public function UnarchivedUserlevel($userlevel_id){
        try {

            $stmt = $this->connect()->prepare('UPDATE user_level SET archive = 0 WHERE userlevel_id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($userlevel_id))) {
                throw new Exception("Failed to update addons");
            }
    
            // Close the prepared statement
            $stmt = null;
            return true;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/AdminArchive.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function DeleteUserlevel($userlevel_id){
        try {

            $stmt = $this->connect()->prepare('UPDATE user_level SET archive = 0, isDeleted = 1 WHERE userlevel_id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($userlevel_id))) {
                throw new Exception("Failed to update addons");
            }
    
            // Close the prepared statement
            $stmt = null;
            return true;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/AdminArchive.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }


}