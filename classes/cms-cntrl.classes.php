<?php

class CmsContr extends Cms {

    private $cmsLogo;
    private $cmsImage;
    private $cms_bg;
    private $cms_title;
    private $cms_subtitle;
    private $cms_japcha;
    private $cms_how_to_order;
    private $cms_socials;
    private $cms_policy;
    private $cms_location;
    private $cms_contact;
    
    public function __construct($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        $this->cmsLogo = $cmsLogo;
        $this->cmsImage = $cmsImage;
        $this->cms_bg = $cms_bg;
        $this->cms_title = $cms_title;
        $this->cms_subtitle = $cms_subtitle;
        $this->cms_japcha = $cms_japcha;
        $this->cms_how_to_order = $cms_how_to_order;
        $this->cms_socials = $cms_socials;
        $this->cms_policy = $cms_policy;
        $this->cms_location = $cms_location;
        $this->cms_contact = $cms_contact;
    }

    public function defaultProfileInfo($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        
        if($this->emptyInputCheck($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact) == false){
            $cmsLogo = "Something";
            $cmsImage = "Something About";
            $cms_bg = "Something bout you";
            $cms_title = "YOUR ONE-STOP FLAVORFUL SHOP";
            $cms_subtitle = "MILK TEA • FRUIT TEA • MANGO GRAHAM CAKE • FRAPPE • ETC";
            $cms_japcha = "Something bout you";
            $cms_how_to_order = "Something";
            $cms_socials = "Something About";
            $cms_policy = "Something bout you";
            $cms_location = "Something";
            $cms_contact = "Something About";
    
            $this->setCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);
            header("location: ../back-end/admin-cms.php?error=default");
            exit();
        }else{
            $this->setNewCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);
            header("location: ../back-end/admin-cms.php?error=update");
            exit();
        }

    }

    public function updateProfileInfo($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        // Error Handlers
        // if($this->emptyInputCheck($cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact) == true){
        //     header("location: ../cms.php?error=emptyinput");
        //     exit();
        // }

        // Update profile info
        $this->setNewCms($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact);

    }

    private function emptyInputCheck($cmsLogo, $cmsImage, $cms_bg, $cms_title, $cms_subtitle, $cms_japcha, $cms_how_to_order, $cms_socials, $cms_policy, $cms_location, $cms_contact){
        $result;
        if(empty( $this ->cms_title) || empty( $this ->cms_subtitle) || empty( $this ->cms_japcha) || empty( $this ->cms_how_to_order) || empty( $this ->cms_socials) || empty( $this ->cms_policy) || empty( $this ->cms_location) || empty( $this ->cms_contact)) 
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    
}