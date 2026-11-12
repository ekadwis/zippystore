<?php

namespace App\Libraries;

use Config\Services;

class MailerService
{
    /**
     * Kirim email undangan Canva PRO EDU ke customer
     *
     * @param string $toEmail    Email customer penerima
     * @param string $orderCode  Kode transaksi
     * @param string $durasi     Durasi paket (misal: 1 Bulan / 1 Tahun)
     * @param string $inviteLink Link invite Canva aktif
     * @param string $teamName   Nama tim (AEZ Team)
     * @return array             ['success' => bool, 'error' => string|null]
     */
    public static function sendCanvaInvite(
        string $toEmail,
        string $orderCode,
        string $durasi,
        string $inviteLink,
        string $teamName = 'AEZ Team'
    ): array {
        $email = Services::email();

        $fromEmail = getenv('SMTP_USER') ?: 'zippystore08@gmail.com';
        $fromName  = 'Zippy Store Support';

        // Konfigurasi SMTP runtime
        $config = [
            'protocol'   => 'smtp',
            'SMTPHost'   => getenv('SMTP_HOST') ?: 'smtp.gmail.com',
            'SMTPUser'   => $fromEmail,
            'SMTPPass'   => getenv('SMTP_PASS') ?: '',
            'SMTPPort'   => (int)(getenv('SMTP_PORT') ?: 587),
            'SMTPCrypto' => getenv('SMTP_CRYPTO') ?: 'tls',
            'mailType'   => 'html',
            'charset'    => 'utf-8',
            'newline'    => "\r\n",
            'CRLF'       => "\r\n",
            'wordWrap'   => true,
        ];

        $email->initialize($config);
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($toEmail);
        $email->setSubject("🎨 [Aktivasi] Undangan Canva PRO EDU - {$orderCode}");

        $htmlMessage = self::buildEmailTemplate($orderCode, $durasi, $inviteLink, $teamName);
        $email->setMessage($htmlMessage);

        if ($email->send(false)) {
            return ['success' => true, 'error' => null];
        } else {
            $debugger = $email->printDebugger(['headers', 'subject']);
            return ['success' => false, 'error' => $debugger];
        }
    }

    /**
     * Template HTML Email Canva PRO EDU + T&C Resmi
     */
    protected static function buildEmailTemplate(
        string $orderCode,
        string $durasi,
        string $inviteLink,
        string $teamName
    ): string {
        return '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <style>
            body { font-family: "Segoe UI", Arial, sans-serif; background: #f8fafc; color: #1e293b; margin: 0; padding: 20px; }
            .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; border: 2px solid #18181b; box-shadow: 4px 4px 0px #18181b; overflow: hidden; }
            .header { background: #0f172a; color: #ffffff; padding: 24px; text-align: center; }
            .header h1 { margin: 0; font-size: 22px; }
            .header p { margin: 6px 0 0 0; color: #94a3b8; font-size: 14px; }
            .content { padding: 24px; line-height: 1.6; }
            .btn-join { display: block; width: fit-content; margin: 24px auto; background: #7c3aed; color: #ffffff !important; padding: 14px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; border: 2px solid #18181b; box-shadow: 3px 3px 0px #18181b; text-align: center; font-size: 16px; }
            .box-tnc { background: #f1f5f9; border-left: 4px solid #7c3aed; padding: 16px; border-radius: 4px; margin-top: 24px; font-size: 13px; color: #334155; }
            .box-tnc h4 { margin: 0 0 10px 0; color: #0f172a; font-size: 14px; }
            .footer { background: #f8fafc; padding: 16px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0; }
          </style>
        </head>
        <body>
          <div class="container">
            <div class="header">
              <h1>🎨 ZIPPY STORE - CANVA PRO EDU</h1>
              <p>Aktivasi Undangan Resmi Tim (Instant Delivery)</p>
            </div>
            
            <div class="content">
              <p>Halo,</p>
              <p>Terima kasih atas pesananmu di <strong>Zippy Store</strong>. Pembayaran untuk pesanan dengan kode <strong>#' . htmlspecialchars($orderCode) . '</strong> (Paket: <strong>' . htmlspecialchars($durasi) . '</strong>) telah berhasil diverifikasi!</p>
              
              <p>Silakan klik tombol di bawah untuk langsung bergabung ke tim <strong>' . htmlspecialchars($teamName) . '</strong>:</p>
              
              <a href="' . htmlspecialchars($inviteLink) . '" target="_blank" class="btn-join">
                🚀 KLIK DISINI UNTUK JOIN TEAM
              </a>
              
              <p style="font-size:12px; color:#64748b; word-break:break-all; text-align:center;">
                Atau salin tautan ini ke browser kamu:<br>
                <a href="' . htmlspecialchars($inviteLink) . '">' . htmlspecialchars($inviteLink) . '</a>
              </p>

              <div class="box-tnc">
                <h4>✨ TERMS &amp; CONDITIONS - CANVA PRO EDU ✨</h4>
                <p><strong>1. AKTIVASI (JOIN TEAM)</strong><br>
                • Silakan cek email yang didaftarkan untuk accept undangan / join team.<br>
                • Pastikan nama tim adalah <strong>"' . htmlspecialchars($teamName) . '"</strong> (khusus pemesanan Canva PRO EDU).</p>

                <p><strong>2. KLAIM GARANSI &amp; BUKTI LOGIN</strong><br>
                • Wajib kirim screenshoot (SS) bukti login/halaman Canva maksimal 1x24 jam sejak di-invite.<br>
                • <em>No SS = No Garansi / Garansi Hangus.</em></p>

                <p><strong>3. MASA GARANSI</strong><br>
                • Durasi 1 bulan berlaku garansi 25 - 30 hari sejak tanggal pembelian.</p>

                <p><strong>4. WAJIB BACKUP DESAIN / FILE</strong><br>
                • Pastikan selalu backup berkala dan download file/project setelah selesai membuat desain.<br>
                • Jika masa aktif habis dan akun sudah di-kick dari team, akun TIDAK BISA join kembali ke tim tersebut kecuali melakukan pembelian/order ulang. Segala kehilangan file/desain di luar tanggung jawab admin.</p>

                <p><strong>5. PERPANJANGAN (RENEW/PPJ)</strong><br>
                • Perpanjangan masa aktif wajib konfirmasi minimal H-7 sebelum masa aktif habis jika ingin tetap berada di team yang sama.</p>

                <p><strong>6. KHUSUS CANVA ADMIN (HEAD)</strong><br>
                • Kapasitas maksimal 100 member per team. Dilarang melebihi kapasitas demi kestabilan akun.</p>

                <hr style="border:none; border-top:1px dashed #cbd5e1; margin:10px 0;">
                <p style="margin:0; font-size:11.5px; text-align:center;"><em>*Order = Setuju dengan seluruh rules di atas.*</em></p>
              </div>

              <p style="margin-top:20px; font-size:13px;">Jika ada kendala aktivasi, silakan hubungi admin kami via WhatsApp: <strong>0851-7783-8705</strong>.</p>
            </div>
            
            <div class="footer">
              &copy; ' . date('Y') . ' Zippy Store (zippystore.my.id) — All Rights Reserved.
            </div>
          </div>
        </body>
        </html>
        ';
    }
}
