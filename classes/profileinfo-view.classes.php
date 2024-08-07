<?php

class ProfileInfoView extends ProfileInfo {

    public function fetchAbout($customerId){
        $profileInfo = $this->getProfileInfo($customerId);

        echo $profileInfo[0]["profile_about"];
    }
    public function fetchTitle($customerId){
        $profileInfo = $this->getProfileInfo($customerId);

        echo $profileInfo[0]["profile_introtitle"];
    }
    public function fetchText($customerId){
        $profileInfo = $this->getProfileInfo($customerId);

        echo $profileInfo[0]["profile_introtext"];
    }
}