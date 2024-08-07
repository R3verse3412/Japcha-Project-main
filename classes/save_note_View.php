<?php

class SampleView extends SampleModel {

    public function fetchJapcha(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["japcha"];
    }
    public function fetchOrderNote(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["order_note"];
    }
   
    public function fetchSocials(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["socials"];
    }
   
    public function fetchPolicy(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["policy"];
    }
   
    public function fetchLocation(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["location"];
    }
    public function fetchContact(){
        $cmsinfo = $this->getContent();

        echo $cmsinfo[0]["contact"];
    }

    // Landing Page
    public function fetchTitle(){
        $cmsinfo = $this->getContentLanding();

        echo $cmsinfo[0]["title"];
    }

    public function fetchSubtitle(){
        $cmsinfo = $this->getContentLanding();

        echo $cmsinfo[0]["subtitle"];
    }
    
    public function fetchFbLinks(){
        $cmsinfo = $this->getLinks();

        echo $cmsinfo[0]["fb_link"];
    }

    public function fetchYtLinks(){
        $cmsinfo = $this->getLinks();

        echo $cmsinfo[0]["yt_link"];
    }

    public function fetchIgLinks(){
        $cmsinfo = $this->getLinks();

        echo $cmsinfo[0]["ig_link"];
    }
   
}