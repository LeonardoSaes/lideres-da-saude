<?php 

namespace Controllers;

require_once __DIR__ . '../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();

class EmailController {

    private $mail;

    public function __construct() {
        // Configurações do servidor
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';

        $this->mail->SMTPAuth = true; // Habilita a autenticação SMTP
        $this->mail->Username   = $_ENV['EMAIL_HOSTINGER'];
        $this->mail->Password   = $_ENV['EMAIL_PASSWORD_HOSTINGER'];

        // Criptografia do envio SSL
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SSL
        $this->mail->Host = 'smtp.hostinger.com';
        $this->mail->Port = 465; // Porta correta para SSL
                
        // Timeout
        $this->mail->Timeout = 30; // Tempo máximo de 30 segundos
        
        // Debugging
        // $this->mail->SMTPDebug = 2; // Ativar saída de depuração detalhada
                
        // Define o remetente
        $this->mail->setFrom($_ENV['EMAIL_HOSTINGER'], 'Lideres da Saúde');
        $this->mail->addAddress($_ENV['EMAIL_HOSTINGER']);
    }

    public function sendParticipantEmail($user){ 
        try {
            $this->mail->addAddress($user['email']);

            // Subject do email com codificação correta
            $this->mail->Subject = 'Confirmação de Inscrição - Evento Líderes da Saúde';

            $this->mail->Body = '
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title> Bem-vindo ao "Líderes da Saúde"</title>
            </head>
            <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8f8f8; padding: 20px; font-size: 20px;">
                    <tr>
                        <td align="center">
                            <table width="600px" cellpadding="0" cellspacing="0" border="0" style="rgba(224, 177, 131, .5); padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <h2 style="color: #e0b183;">Bem-vindo ao Líderes da Saúde </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Prezado ' . htmlspecialchars(formatName($user['name'])) . ',</p>
                                        <p style="text-align: justify;">É com grande satisfação que confirmamos a sua inscrição no evento <strong>Líderes da Saúde</strong>. Estamos entusiasmados com a sua participação e temos certeza de que será uma experiência enriquecedora para todos os presentes.</p>
                                        <p style="text-align: justify;">
                                         <h3>Detalhes do Evento:</h3>
                                            <ul>
                                                <li><strong>Data:</strong> 07 de novembro de 2024</li>
                                                <li><strong>Horário:</strong> Das 9h às 18h</li>
                                                <li><strong>Local:</strong> <a href="https://www.google.com.br/maps/place/InRad+-+Instituto+de+Radiologia+do+Hospital+das+Cl%C3%ADnicas+FMUSP+-+Portaria+6,+7,+9+e+17/@-23.5565949,-46.6730795,17z/data=!3m1!4b1!4m6!3m5!1s0x94ce582a0998c2ef:0x9920bd041230a96!8m2!3d-23.5565998!4d-46.6705046!16s%2Fg%2F11b6htsw3n?entry=ttu"  target="_blank"> InRad HC - São Paulo</a> </li>
                                            </ul>
                                        </p>
                                        <p style="text-align: justify;">Se tiver alguma dúvida ou necessitar de mais informações, não hesite em entrar em contato conosco pelo e-mail <a href="mailto:comunicacao@executivosdasaude.com.br"> comunicacao@executivosdasaude.com.br </a> ou telefone whatsapp <a href="https://wa.me/5511973943600?text=Olá,%20tenho%20dúvida%20sobre%20o%20evento%20Líderes%20da%20Saúde" target="_blank"> +55 (11) 97394-3600 </a>.</p>
                                        <p>Aguardamos ansiosamente a sua presença!</p>  
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <img src="https://lideresdasaude.com/img/logotipo.png" alt="Logotipo" style="height: 250px; width: 250px; display: block;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $this->mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
        
            // Enviar
            $this->mail->send();
            return 'success';
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return 'error';
        }
    }

    public function sendSponsorEmail($user){ 
        try {
            $this->mail->addAddress($user['email']);

            // Subject do email com codificação correta
            $this->mail->Subject = 'Confirmação de Patrocinador - Evento Líderes da Saúde';

            $this->mail->Body = '
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title> Bem-vindo ao "Líderes da Saúde"</title>
            </head>
            <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8f8f8; padding: 20px; font-size: 20px;">
                    <tr>
                        <td align="center">
                            <table width="600px" cellpadding="0" cellspacing="0" border="0" style="rgba(224, 177, 131, .5); padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <h2 style="color: #e0b183;">Bem-vindo ao Líderes da Saúde </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Prezado ' . htmlspecialchars(formatName($user['name'])) . ',</p>
                                        <p style="text-align: justify;">É com grande entusiasmo que recebemos sua inscrição como patrocinador do evento "Líderes da Saúde". Estamos empolgados em tê-lo conosco nesta jornada que visa promover discussões inovadoras e avanços significativos no setor de saúde.</p>
                                        <p style="text-align: justify;">Seu apoio é fundamental para o sucesso do nosso evento e estamos ansiosos para colaborar estreitamente com sua organização.</p>
                                        <p style="text-align: justify;">Gostaríamos de informá-lo que entraremos em contato com você o mais rápido possível para discutir os próximos passos e alinhar todos os detalhes necessários para garantir uma parceria eficaz e produtiva.</p>
                                        <p style="text-align: justify;">Se precisar de qualquer informação adicional ou tiver alguma dúvida, não hesite em nos contatar. Estamos à disposição para ajudar no que for necessário.</p>
                                        <p>Atenciosamente,</p>
                                        <p>Everton Ricardo<br>
                                        Diretor Executivo<br>
                                        Líderes da Saúde<br>
                                        Telefone whatsapp: <a href="https://wa.me/5511988940295?text=Olá%20Everton,%20tenho%20uma%20dúvida%20sobre%20patrocinar%20o%20evento%20Líderes%20da%20Saúde" target="_blank"> +55 11 98894-0295 </a><br>
                                        E-mail: <a href="mailto:diretoria@executivosdasaude.com.br">diretoria@executivosdasaude.com.br</a></p>
                                        <p style="text-align: justify;">Aguardamos ansiosamente pela nossa colaboração e estamos à disposição para qualquer questão.</p>
                                        <p>Atenciosamente,<br>
                                        Equipe Líderes da Saúde</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <img src="https://lideresdasaude.com/img/logotipo.png" alt="Logotipo" style="height: 250px; width: 250px; display: block;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $this->mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
        
            // Enviar
            $this->mail->send();
            return 'success';
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return 'error';
        }
    }
}

function formatName($str) {
    $str = trim($str);

    $posicaoPrimeiroEspaco = strpos($str, ' ');

    if ($posicaoPrimeiroEspaco !== false) {
        $str = substr($str, 0, $posicaoPrimeiroEspaco);
    }

    $str = ucfirst($str);

    return $str;
}