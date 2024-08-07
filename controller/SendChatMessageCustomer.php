<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Manila');
$chat_time = date('Y-m-d H:i:s');

require_once "../classes/dbh.classes.php";
require_once "../classes/ChatManagementModel.php";
require_once "../classes/ChatbotModel.php";
$chatbot = new ChatbotModel();
$chat_model = new ChatModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sender_id'])) {

        $sender_id = htmlspecialchars($_POST["sender_id"], ENT_QUOTES, 'UTF-8');
        $customer_name = htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
        $receiver_id = 0;
        // Filter the message for curse words
        if (containsCurseWords($message)) {
            $response['error'] = 'Message contains inappropriate content.';
            echo json_encode($response);
            exit;
        }

        $send_message = $chat_model->SendMessageCustomer( $sender_id, $receiver_id, $customer_name, $message, $chat_time);

        // Define the response as an associative array
        $response = array();

        if ($send_message != false) {
            $response['success'] = 'Message sent';
        } else {
            $response['error'] = 'Unable to send the message';
        }

        echo json_encode($response);

    }

    if (isset($_POST['customer_id'])) {
        $sender = 0;
        $receiver = $_POST['customer_id'];
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
        $username = "Admin";
            // Filter the message for curse words
            if (containsCurseWords($message)) {
                $response['error'] = 'Message contains inappropriate content.';
                echo json_encode($response);
                exit;
            }
    
            $send_message = $chat_model->SendMessageAdmin($sender, $receiver, $username, $message, $chat_time);
    
            // Define the response as an associative array
            $response = array();
    
            if ($send_message != false) {
                $response['success'] = 'Message sent';
            } else {
                $response['error'] = 'Unable to send the message';
            }
    
            echo json_encode($response);
    }

    if(isset($_POST['chatbotId'])){
        $sender_id = htmlspecialchars($_POST["userid"], ENT_QUOTES, 'UTF-8');
        $receiver = 0;
        $message = htmlspecialchars($_POST["question"], ENT_QUOTES, 'UTF-8');
        $customer_name =  htmlspecialchars($_POST["fullname"], ENT_QUOTES, 'UTF-8');
        $send_message = $chat_model->SendMessageCustomer( $sender_id, $receiver, $customer_name, $message, $chat_time);

        $sender_id_admin = 0;
        $receiver_customer = htmlspecialchars($_POST["userid"], ENT_QUOTES, 'UTF-8'); 
        $username = "Admin";
        $message_reply = htmlspecialchars($_POST["answer"], ENT_QUOTES, 'UTF-8');

        $send_reply_message = $chat_model->SendMessageAdmin($sender_id_admin, $receiver_customer, $username, $message_reply, $chat_time);
        $response = array();
    
        if ($send_message != false && $send_reply_message  != false) {
            $response['success'] = 'Message sent';
        } else {
            $response['error'] = 'Unable to send the message';
        }

        echo json_encode($response);

    }

    if (isset($_POST['chatbot_id'])) {
        header('Content-Type: application/json'); 
        $delete_id = htmlspecialchars($_POST["chatbot_id"], ENT_QUOTES, 'UTF-8');
        $delete = $chatbot->deleteChatbot($delete_id);
    
        $response = array();
    
        if ($delete != false) {
            $response['success'] = "Deleted Successfully";
        } else {
            $response['error'] = "Failed to delete Chatbot";
        }
    
        echo json_encode($response);
    }
    
    
}




if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['senderid'])) {
        $senderid = $_GET['senderid'];
        $receiverid = 0;
        $get_message = $chat_model->GetChatByCustomer($senderid, $receiverid);

       
        echo json_encode( $get_message);
   
    }

    if (isset($_GET['recieve_admin_chat'])) {
        $receiver_id = $_GET['recieve_admin_chat'];
        $sender_id = 0;
        $get_message = $chat_model->GetReplyAdmin($sender_id, $receiver_id);

        echo json_encode( $get_message);
    }



    if (isset($_GET['customer_id_backend'])) {
        $receiverid =$_GET['customer_id_backend'];
        $senderid = 0;

        $get_message = $chat_model->GetChatBackend($senderid, $receiverid);

        echo json_encode( $get_message);
    }

    if (isset($_GET['admin_id']) && isset($_GET['customer_id_backend_second'])) {
        $adminid = $_GET['admin_id'];
        $customerid = $_GET['customer_id_backend_second'];
    
        // Add debugging statements
        // echo "Admin ID: $adminid, Customer ID: $customerid";
    
        $get_message = $chat_model->GetChatAdmin($adminid, $customerid);
    
        foreach ($get_message as &$message) {
            $message['message_text'] = htmlspecialchars($message['message_text'], ENT_QUOTES, 'UTF-8');
            // You may need to adjust the flags and encoding based on your needs
        }
    
        echo json_encode($get_message);
    }
    

}


function containsCurseWords($message) {
    // List of curse words to check against (add more if necessary)
    $curseWords = array(
        'tangina', 'f*ck',
        'gago', 'st*pid',
        'puta', 'wh*re',
        'tarantado', 'id*ot',
        'ulul', 'cr*zy',
        'pak u', 'f*ck you',
        'mamatay', 'die',
        'king ina', 'son of a b*tch',
        'olol', 'f*ol',
        'tang', 'd*mn',
        't@ngina', 'f*ck',
        'ina ka', 'you m*ther',
        'nigga', 'n-word',
        'n!gga', 'n-word',
        'n1gga', 'n-word',
        'bastard', 'b*stard',
        'bitch', 'b*tch',
        'damn', 'd*mn',
        'Asshole', 'a**hole',
        'goddamn', 'godd*mn',
        'putangina', 'd*mn',
        'potah', 'd*mn',
        'tanga', 'st*pid',
        'buwisit', 'annoying',
        'leche', 'milk (used as an expletive)',
        'engot', 'dumb',
        'torpe', 'clueless in love',
        'yawa', 'devil',
        'bwiset', 'annoying',
        'hayop', 'animal',
        'ulol', 'crazy',
        'sutil', 'stubborn',
        'tangalanga', 'nuisance',
        'amputa', 'd*mn it',
        'kupal', 'annoying person',
        'kupalera', 'annoying person (female)',
        'epal', 'attention seeker',
        'sipsip', 'sycophant',
        'torpe', 'clueless in love',
        'kupal', 'annoying',
        'kupals', 'annoying people',
        'yabang', 'bragging',
        'manyakis', 'pervert',
        'malandi', 'flirty',
        'bobo', 'st*pid',
        'tangang', 'foolish',
        'pokpok', 'prostitute',
        'malaswa', 'indecent',
        'bastos', 'rude',
        'bangag', 'drugged',
        'yagit', 'shabby',
        'buang', 'crazy',
        'shunga', 'dense',
        'kalibugan', 'lustful',
        'lasenggo', 'drunkard',
        'atay', 'liver (used as an expletive)',
        'bwisit', 'annoying',
        'kalat', 'mess',
        'kalat-kalat', 'disorderly',
        'kanal', 'sewer (used as an expletive)',
        'kanina', 'earlier',
        'kanino', 'whose',
        'kantot', 'f*ck (sexual)',
        'katol', 'mosquito coil (used as an expletive)',
        'kayabangan', 'arrogance',
        'kupal', 'annoying',
        'kup*l', 'annoying (censored)',
        'kuyakoy', 'nervous',
        'kupal', 'annoying',
        'liit', 'small',
        'libog', 'lust',
        'malas', 'unlucky',
        'mangmang', 'ignorant',
        'mukhang pera', 'looks like money',
        'nang-aaway', 'troublemaker',
        'naninira', 'destroyer',
        'pakyu', 'f*ck you',
        'paminta', 'effeminate (used as an insult)',
        'pantasya', 'fantasy',
        'pokpok', 'prostitute',
        'putragis', 'd*mn it',
        'putris', 'd*mn it',
        'sapantaha', 'rude',
        'sayang', 'waste',
        'suwail', 'disobedient',
        't*nga', 'st*pid',
        'talawan', 'lazy',
        'taong grasa', 'homeless person',
        'torpek', 'clueless in love',
        'tulala', 'staring blankly',
        'ulila', 'orphaned',
        'ungas', 'unintelligent',
        'wala sa hulog', 'clueless',
        'walang hiya', 'shameless',
        'walang kwenta', 'worthless',
        'walang modo', 'disrespectful',
        'walang silbi', 'useless',
        'wampipti', 'a little amount',
        'wawamputa', 'wow d*mn it',
        'yagit', 'shabby',
        'yakagin', 'grabbed',
        'yakal', 'trap',
        'yamot', 'annoyed',
        'yantok', 'rod',
        'yari', 'in trouble',
        'yosi', 'cigarette',
        'yosihan', 'smoking area',
        'yugyog', 'shake',
        'yuko', 'bow',
        'yuwak', 'dirty',
        'zuplada', 'snobbish',
        'zupladita', 'snobbish (female)',
        'zuper', 'super',
        'zwitit', 'private part',
        'fuck', 'pota','script', 'drop', 'database',
        'SELECT', '</script>', 'pota'

    );
    
    // Convert the message to lowercase for case-insensitive comparison
    $lowercaseMessage = strtolower($message);

    // Check if the message contains any curse words
    foreach ($curseWords as $curseWord) {
        if (strpos($lowercaseMessage, $curseWord) !== false) {
            return true; // Message contains a curse word
        }
    }

    return false; // Message does not contain curse words
}