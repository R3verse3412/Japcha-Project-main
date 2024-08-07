<?php

class addCategory extends Dbh {

    protected function setCategory($category) {
            try {

                $stmt = $this->connect()->prepare('INSERT INTO categories (category_name) VALUES (?)');

                // Execute the query
                if (!$stmt->execute(array($category))) {
                    throw new Exception("Failed to Add Category");
                    header("location: ../back-end/viewCategory.php?error=addingcategoryfailed");
                   
                }

        $stmt = null;

            } catch (\Throwable $th) {
                //throw $th;
                header("location: ../back-end/viewCategory.php?error=" . urlencode($e->getMessage()));
                exit();
            }
        
    }
    protected function updateNewCategory($category, $categoryID) {
        try {

            $stmt = $this->connect()->prepare('UPDATE categories SET category_name = ? WHERE category_id = ?');
    
            // Execute the query
            if (!$stmt->execute(array($category, $categoryID))) {
                throw new Exception("Failed to update category");
            }
    
            // Close the prepared statement
            $stmt = null;

        } catch (Exception $e) {
            //throw $th;
            header("location: ../back-end/viewCategory.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    
}

    protected function checkCategory($category) {
        try {
            // Prepare the SQL query
            $stmt = $this->connect()->prepare('SELECT category_name FROM categories WHERE category_name = ?');
            
            // Execute the query
            if (!$stmt->execute(array($category))) {
                // throw new Exception("User existence check failed.");
                $stmt = null;
                header("location: ../back-end/viewCategory.php?error=categorydoesnotexist");
                exit();

            }
            
            $resultCheck = ($stmt->rowCount() > 0) ? false : true;
            return $resultCheck;
        } catch (Exception $e) {
            // Log the error or handle it appropriately
            header("location: ../back-end/viewCategory.php?error=" . urlencode($e->getMessage()));
            exit();
        }
    }

    public function getCategory(){
        $stmt = $this->connect()->prepare('SELECT * FROM categories ORDER BY category_id ASC;');

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
}