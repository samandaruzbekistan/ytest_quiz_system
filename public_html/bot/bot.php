<?php 
require_once "Telegram.php";
include 'db.php';
$token = "5934329631:AAED64B1lIYahVog1OomzOoqB45f0gCNcqE";

$telegram = new Telegram($token);
$data = $telegram->getData();
$message = $data['message'];
$message_id = $message['message_id'];
$text = $message['text'];
$chat_id = $message['chat']['id'];
$db = new DB($chat_id, $con);
$callback_query = $telegram->Callback_Query();
$chatID = $telegram->Callback_ChatID();

echo "aaa";
if ($callback_query != null && $callback_query != '') {
    $callback_data = $telegram->Callback_Data();
    $r = "Select * from `users` where `chat_id` = {$chatID}";
    $res = mysqli_query($con, $r);
    $p = mysqli_fetch_assoc($res);
    $page = $p['page'];
}

if ($text == '/start') {
    $sql =  "select * from `users` where `chat_id` = {$chat_id}";
    $user = mysqli_fetch_assoc(mysqli_query($con, $sql));
    if (!empty($user)) {
        SetPage('start');
    }
    else{
        $r = mysqli_query($con, "INSERT INTO `users`(`chat_id`) VALUES ({$chat_id})");
    }
   sendTextWithKeyboard(["Ro'yxatdan o'tish 🗒"], "Assalomu aleykum! \nSirdaryo texnoparkining telegram botiga xush kelibsiz!");
}
else {
    $r = mysqli_query($con, "Select * from `users` where `chat_id` = {$chat_id}");
    $p = mysqli_fetch_assoc($r);
    $page = $p['page'];
    switch ($page) {
        case 'start':
            switch ($text) {
                case "Ro'yxatdan o'tish 🗒":
                    // $option[] = array($telegram->buildKeyboardButton('Ism familyangizni yuboring'));
                    sendMessage('Ism familyangizni yuboring');
                    SetPage('fish');
                    break;
                
                default:
                    # code...
                    break;
            }
            break;
        case 'fish':
            SetPage('phone');
            mysqli_query($con, "UPDATE `users` SET `name`='{$text}' WHERE `chat_id` = {$chat_id}");
            $option[] = array($telegram->buildKeyboardButton('Tel raqam yuborish 📲', true));
            $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
            $content = array('chat_id' => $chat_id, 'reply_markup' => $keyboard, 'text' => "Telefon Raqamingiz 📲", 'parse_mode' => "HTML");
            $telegram->sendMessage($content);
            break;
        case 'phone':
            $phone = $message['contact']['phone_number'];
            mysqli_query($con, "UPDATE `users` SET `phone`='{$phone}' WHERE `chat_id` = {$chat_id}");
            SetPage('address');
            sendMessage("📍Manzilingiz yuboring");
            break;
        case 'address':
            mysqli_query($con, "UPDATE `users` SET `address`='{$text}' WHERE `chat_id` = {$chat_id}");
            SetPage('phone2');
            sendMessage("📲 Bog'lanish uchun qo'shimcha telefon raqam yuboring");
            break;
        case 'phone2':
            mysqli_query($con, "UPDATE `users` SET `phone2`='{$text}' WHERE `chat_id` = {$chat_id}");
            $r = mysqli_query($con, "Select * from `users` where `chat_id` = {$chat_id}");
            $user = mysqli_fetch_assoc($r);
            sendMessage("<b>Ism:</b> {$user['name']}\n<b>Telefon:</b> {$user['phone']}\n<b>Manzil:</b> {$user['address']}\n<b>Qo'shimcha raqam:</b> {$user['phone2']}");
            Home();
            break;
        case 'home':
            switch ($text) {
                case 'Ma\'lumotlarim👤':
                    $r = mysqli_query($con, "Select * from `users` where `chat_id` = {$chat_id}");
                    $user = mysqli_fetch_assoc($r);
                    sendMessage("<b>Ism:</b> {$user['name']}\n<b>Telefon:</b> {$user['phone']}\n<b>Manzil:</b> {$user['address']}\n<b>Qo'shimcha raqam:</b> {$user['phone2']}");
                    Home();
                    break;
                case 'Biz haqimizda©':
                    sendMessage("Sirdaryo texnoparki");
                    Home();
                    break;
                case "Yo'nalishlar📊":
                    Yonalishlar();
                    break;
                case "Bog'lanish📨":
                    sendMessage("Taklif va Murojaatlar uchun⤵️ :\n\n👩🏻‍💻@sobitjonova_001\n📞+998338954748 \n\n👩🏻‍💻@Sitora_002\n📞+998915075959");
                    Home();
                    break;
                default:
                    # code...
                    break;
            }
            break;
        case 'yonalish':
            switch ($text) {
                case 'Bosh menu 🏠':
                    Home();
                    break;
                case 'Castle Academy 🏰':
                    Castle();
                    break;
                case 'O-net Academy 💻':
                    Net();
                    break;
                default:
                    # code...
                    break;
            }
            break;
        case 'castle':
            switch ($text) {
                case 'Orqaga↩️':
                    Yonalishlar();
                    break;
                case 'Bosh menu 🏠':
                    Home();
                    break;
                default:
                    # code...
                    break;
            }
            break;
        case 'net':
            switch ($text) {
                case 'Orqaga↩️':
                    Yonalishlar();
                    break;
                case 'Bosh menu 🏠':
                    Home();
                    break;
                default:
                    # code...
                    break;
            }
            break;
        default:
            # code...
            break;
    }
}


echo "sss";



function Home()
{
    SetPage('home');
    sendTextWithKeyboard(["Yo'nalishlar📊", "Ma'lumotlarim👤","Bog'lanish📨","Biz haqimizda©"], "Tanlang ⤵️");
}

function Yonalishlar()
{
    SetPage('yonalish');
    sendTextWithKeyboard(["Castle Academy 🏰", "O-net Academy 💻","Technoways Biznes Incubator 🧬","Consulting 🗺", "Bosh menu 🏠"], "Tanlang⤵️");
}

function Net()
{
    SetPage('net');
    sendTextWithKeyboard(["Robototexnika🤖","Web dasturlash💻","Kamputer savodxonligi🖥","Kiber sport 📱",  "Bosh menu 🏠", "Orqaga↩️"], "Bizning o'quv kurslarimiz ⤵️");
}

function Castle()
{
    SetPage('castle');
    sendTextWithKeyboard(["Ingliz tili🇬🇧", "Rus tili🇷🇺","Buxgalteriya📊","Kimyo va Biologiya🌱", "Bosh menu 🏠", "Orqaga↩️"], "Bizning o'quv kurslarimiz ⤵️");
}

function sendTextWithKeyboard($buttons, $text, $backBtn = false)
{
    global $telegram, $chat_id, $texts;
    $option = [];
    if (count($buttons) % 2 == 0) {
        for ($i = 0; $i < count($buttons); $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
    } else {
        for ($i = 0; $i < count($buttons) - 1; $i += 2) {
            $option[] = array($telegram->buildKeyboardButton($buttons[$i]), $telegram->buildKeyboardButton($buttons[$i + 1]));
        }
        $option[] = array($telegram->buildKeyboardButton(end($buttons)));
    }
    if ($backBtn) {
        $option[] = [$telegram->buildKeyboardButton($texts->getText("back_btn"))];
    }
    $keyboard = $telegram->buildKeyBoard($option, $onetime = false, $resize = true);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyboard, 'text' => $text, 'parse_mode' => "HTML");
    $telegram->sendMessage($content);
}


function sendMessage($text)
{
    global $telegram, $chat_id;
    $reply_markup = array(
        'remove_keyboard' => true
    );
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $text, 'parse_mode' => "HTML", 'reply_markup' => json_encode($reply_markup)]);
}

function SetPage($name)
{
    global $chat_id, $con;
    $r = mysqli_query($con, "UPDATE `users` SET `page`='{$name}' WHERE `chat_id` = {$chat_id}");
}
?>