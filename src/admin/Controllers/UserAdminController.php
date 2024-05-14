<?php
namespace Src\admin\Controllers;
use Src\Models\UserRepository;
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


/**
 * Ici, nous avons un contrôleur qui gère les actions de l'utilisateur.
 *
 * Class UserAdminController
 *
 * @package Src\admin\Controllers
 */
class UserAdminController
{
    /**
     * Cette méthode permet de gérer l'inscription de l'utilisateur.
     *
     * @return void
     */
    public function registerSubmit(): void
    {
        $name = $this->cleanInput($this->getPostValueIsEmpty('name'));
        $firstname = $this->cleanInput($this->getPostValueIsEmpty('firstname'));
        $email = $this->cleanInput($this->getPostValueIsEmpty('email'));
        $password = $this->cleanInput($this->getPostValueIsEmpty('password'));
        $passConfirm = $this->cleanInput($this->getPostValueIsEmpty('passConfirm'));
        if ($this->chekPasswordIsSam($password, $passConfirm) && $this->checkEmail($email)) {
            $userRepository = new UserRepository();
            $userRepository->insert([
                'nom' => $name,
                'prenom' => $firstname,
                'email' => $email,
                'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT),
                'is_admin' => '0'
            ]);
            header('Location: /login');
        } else {
            echo "Erreur lors de l'inscription";
        }
    }
    /**
     * Cette méthode permet de gérer la connexion de l'utilisateur.
     *
     * @return void
     */
    public function loginSubmit(): void
    {
        $userRepository = new UserRepository();
        $email = $this->cleanInput($this->getPostValueIsEmpty('email'));
        $password = $this->cleanInput($this->getPostValueIsEmpty('password'));
        $user = $userRepository->getUser($email);
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user'] = $user;
           header('Location: /account');
        } else {
            echo "Email ou mot de passe incorrect";
        }
    }
    /**
     * Cette méthode permet de gérer la déconnexion de l'utilisateur.
     *
     * @return void
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
    }
    /**
     * Cette méthode permet de nettoyer les données.
     *
     * @param $data
     *
     * @return string
     */
    function cleanInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
    /**
     * Cette méthode permet de vérifier si une valeur POST est vide.
     *
     * @param $key
     * @param $default
     *
     * @return mixed
     */
    function getPostValueIsEmpty($key, $default = Null)
    {
        return isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : $default;
    }
    /**
     * Cette méthode permet de vérifier si les mots de passe sont identiques.
     *
     * @param $motDePasse
     * @param $motDePasseconfirm
     *
     * @return bool
     */
    function chekPasswordIsSam($motDePasse, $motDePasseconfirm): bool
    {
        if ($motDePasse == $motDePasseconfirm) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Cette méthode permet de vérifier si l'email est valide.
     *
     * @param $email
     *
     * @return bool
     */
    function checkEmail($email): bool
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        } else {
            return true;
        }
    }

    /**
     * Cette méthode permet de télécharger un PDF.
     *
     * @return void
     */
       public function downloadPdf(): void
       {
        $user = $_SESSION['user'];
        ob_start();
        require('views/pdf_template.php');
        $html = ob_get_clean();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('document-pdf.pdf', array("Attachment" => false));
       }
        /**
         * Cette méthode permet d'envoyer un PDF par email.
         *
         * @return void
         */
       public function sendPdfByEmail(): void
       {
        $user = $_SESSION['user'];

        $subject = $this->cleanInput($this->getPostValueIsEmpty('subject'));
        $content = $this->cleanInput($this->getPostValueIsEmpty('content'));

        $dompdf = new Dompdf();
        ob_start();
        require('views/pdf_template.php');
        $html = ob_get_clean();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pdfContent = $dompdf->output();
        $pdfFileName = 'document.pdf';
        $pdfFilePath = __DIR__.'/../../public/'.$pdfFileName;
        file_put_contents($pdfFilePath, $pdfContent);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'maildev';
        $mail->Port = 1025;
        $mail->SMTPAuth = false;

        $mail->setFrom($user['email'], $user['nom'].' '.$user['prenom']);
        $mail->addAddress($_ENV['EMAIL_USERNAME'], $_ENV['NAME']);
        $mail->addAttachment($pdfFilePath);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
            unlink($pdfFilePath);
        }

    }

    /**
     * Cette méthode permet de télécharger un fichier Excel.
     *
     * @return void
     */
    public function exportAllUsers(): void
    {
        $user = new UserRepository();
        $users = $user->getAllUsers();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nom');
        $sheet->setCellValue('B1', 'Prénom');
        $sheet->setCellValue('C1', 'Email');

        $i = 2;
        foreach($users as $user){
            $sheet->setCellValue('A'.$i, $user['nom']);
            $sheet->setCellValue('B'.$i, $user['prenom']);
            $sheet->setCellValue('C'.$i, $user['email']);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'export_utilisateurs.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

}