<?php 

use Telegram\Bot\Api;

class TelegramService
{
    private $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function getChatIdByPhoneNumber($phoneNumber)
    {
        // Mengirim permintaan ke Telegram API untuk mencari chat berdasarkan nomor telepon
        $response = $this->telegram->sendChatAction([
            'chat_id' => $phoneNumber,
            'action' => 'typing'
        ]);

        // Periksa apakah permintaan berhasil
        if ($response['ok']) {
            $result = $response['result'];

            // Periksa apakah ditemukan chat berdasarkan nomor telepon
            if (!empty($result)) {
                // Mengembalikan chat ID
                return $result['id'];
            }
        }

        // Jika tidak ditemukan chat berdasarkan nomor telepon, kembalikan null atau nilai yang sesuai
        return null;
    }

    public function sendMessage($chatId, $message)
    {
        // Mengirim pesan ke chat ID yang ditentukan
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);
    }
}

?>
