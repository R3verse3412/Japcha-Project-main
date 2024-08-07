<?php

class ProfileInfo extends Dbh {

    protected function getProfileInfo($cusomterId){
        $stmt = $this->connect()->prepare('SELECT * FROM profiles WHERE customer_id = ?;');

        if(!$stmt->execute(array($cusomterId))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../myProfile.php?error=profilenotfoundssss");
            exit();
        }

        $profileData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $profileData;

    }

    protected function setNewProfileInfo($profileAbout, $profileTitle, $profileText, $cusomterId){
        $stmt = $this->connect()->prepare('UPDATE profiles SET profile_about = ?, profille_introtitle = ?, profile_introtext = ? WHERE customer_id = ?;');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $cusomterId))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }

    protected function setProfileInfo($profileAbout, $profileTitle, $profileText, $cusomterId){
        $stmt = $this->connect()->prepare('INSERT INTO profiles (profile_about, profile_introtitle, profile_introtext, customer_id) VALUES (?,?,?,?);');

        if(!$stmt->execute(array($profileAbout, $profileTitle, $profileText, $cusomterId))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }

        $stmt = null;

    }

    public function getCustomerDataFront($customer_id){
        $stmt = $this->connect()->prepare('SELECT * FROM customer_account WHERE customer_id = ? AND isDeleted != 1;');
    
        if(!$stmt->execute(array($customer_id))) {
            $stmt = null;
            header("location: ../myProfile.php?error=stmtfailed");
            exit();
        }
    
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../myProfile.php?error=profilenotfoundas");
            exit();
        }
    
        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $profileData;
    }
    
}