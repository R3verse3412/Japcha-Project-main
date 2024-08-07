<?php

class CmsInfoView extends Cms {

    public function fetchLogo(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_logo_url"];
    }
    public function fetchImage(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_image_url"];
    }
    public function fetchBg(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_bg_url"];
    }
    public function fetchTitle(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_title"];
    }
    public function fetchSubtitle(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_subtitle"];
    }
    public function fetchJapcha(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_japcha"];
    }
    public function fetchHowToOrder(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_how_to_order"];
    }
    public function fetchSocials(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_socials"];
    }
    public function fetchPolicy($cms_id){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_policy"];
    }
    public function fetchLocation(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_location"];
    }
    public function fetchContact(){
        $profileInfo = $this->getCms();

        echo $profileInfo[0]["cms_contact_us"];
    }
}