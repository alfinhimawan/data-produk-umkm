<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Owner UMKM</title>
</head>

<body style="background:#f4f6fb;margin:0;padding:0;font-family:'Segoe UI',Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6fb;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0"
                    style="background:#fff;border-radius:16px;box-shadow:0 4px 24px #0002;padding:0 0 32px 0;overflow:hidden;">
                    <tr>
                        <td align="center"
                            style="background:#2b7a78;padding:32px 0 18px 0;">
                            <img src="https://raw.githubusercontent.com/alfinhimawan/data-produk-umkm/main/public/img/logo.png" alt="UMKM Logo" width="72"
                                style="margin-bottom:10px;">
                            <h1
                                style="margin:0;color:#fff;font-size:2rem;letter-spacing:1px;">
                                MyUMKM
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding:28px 32px 0 32px;color:#222;font-size:1.08rem;">
                            <p style="margin:0 0 12px 0;">Halo <b>{{ $user->name }}</b>,</p>
                            <p style="margin:0 0 18px 0;">Terima kasih telah mendaftar sebagai Owner UMKM menggunakan
                                Google.</p>
                            <p style="margin:0 0 18px 0;">Klik tombol di bawah ini untuk verifikasi email Anda dan
                                mengaktifkan akun:</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 32px 24px 32px;">
                            <a href="{{ url('verify/' . $user->verification_token) }}"
                                style="display:inline-block;padding:16px 40px;background:#ffb703;color:#222;text-decoration:none;font-weight:600;border-radius:8px;font-size:1.15rem;box-shadow:0 2px 8px #0001;letter-spacing:1px;margin-top:8px;">Verifikasi
                                Email</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 32px 0 32px;color:#888;font-size:0.98rem;">
                            <p style="margin:0 0 8px 0;">Atau salin dan buka link berikut di browser Anda:</p>
                            <div
                                style="background:#f4f6fb;border-radius:6px;padding:10px 12px;font-size:0.97rem;word-break:break-all;color:#2b7a78;">
                                {{ url('verify/' . $user->verification_token) }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 32px 0 32px;color:#888;font-size:0.97rem;">
                            <p style="margin:0;">Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:32px 0 0 0;">
                            <hr
                                style="border:none;border-top:1px solid #e0e0e0;width:80%;margin:0 auto 12px auto;">
                            <div style="color:#aaa;font-size:0.93rem;">&copy; {{ date('Y') }} MyUMKM. All rights
                                reserved.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
