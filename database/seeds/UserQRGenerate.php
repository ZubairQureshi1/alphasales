<?php

use App\User;
use Illuminate\Database\Seeder;

class UserQRGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        foreach ($users as $key => $user) {
            $this->generateQRCode($user);
        }
    }

    public function generateQRCode($user)
    {
        $input = $user->only(['id', 'display_name']);
        $qr_code_name = $user->display_name . '-' . $user->emp_code . '.png';
        $input['type'] = 'employee';
        $directory = \FileUploader::makeDirectory(true, $user, 'qr_codes');
        \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
            ->generate(json_encode($input, true), ($directory . $qr_code_name));
        // $qr_code_server = \QRCode::text(json_encode($input, true));
        // $qr_code_server->setErrorCorrectionLevel('H');
        // $qr_code_server->setSize(4);
        // $qr_code_server->setMargin(2);
        // $qr_code_server->setOutfile(public_path(config('constants.attachment_path.emp_qr_destination_path')) . $qr_code_name . '.png');
        // $qr_code_server->png();

        // $qr_code = \QRCode::text(json_encode($input, true));
        // $qr_code->setErrorCorrectionLevel('H');
        // $qr_code->setSize(4);
        // $qr_code->setMargin(2);
        // $directory = \FileUploader::makeDirectory(true, $user, 'qr_codes');
        // $qr_code->setOutfile($directory . $qr_code_name . '.png');
        // $qr_code->png();

        // $user->qr_code_name = $qr_code_name;
        // $user->update();
    }

}
