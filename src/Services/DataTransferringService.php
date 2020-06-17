<?php

namespace App\Services;

use App\Exceptions\FTPException;
use App\Factory\EmailFactory;
use Carbon\Carbon;

class DataTransferringService
{
    /**
     * @throws FTPException
     */
    public function sendFtpData(array $consignmentsToSend, array $ftpDetails): void
    {
        $directoryToSave = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR .
            (Carbon::now()->format('Y-m-d')) . DIRECTORY_SEPARATOR;
        /**
         * @var string $consignmentFTP
         * @var array $consignmentReferences
         */
        foreach ($consignmentsToSend as $consignmentFTP => $consignmentReferences) {
            if (empty($ftpDetails[$consignmentFTP]['login']) || empty($ftpDetails[$consignmentFTP]['password'])) {
                throw new FTPException(sprintf('No valid login or password for %s', $consignmentFTP));
            }

            $fileName = password_hash($consignmentFTP, PASSWORD_BCRYPT);
            file_put_contents($directoryToSave . $fileName, implode($consignmentReferences));

            $connection = ftp_connect($consignmentFTP);

            $login = ftp_login(
                $connection,
                $ftpDetails[$consignmentFTP]['login'],
                $ftpDetails[$consignmentFTP]['password']
            );

            if (!$login) {
                throw new FTPException(sprintf('Unable to login to FTP client - %s', $consignmentFTP));
            }

            if (!ftp_put($connection, $fileName, $directoryToSave . $fileName, FTP_ASCII)) {
                throw new FTPException(sprintf('Unable to send FTP to %s', $consignmentFTP));
            }
            ftp_close($connection);
        }
    }

    /**
     * @throws \Exception if send fails
     */
    public function sendEmailData(array $consignmentsToSend): void
    {
        $emailSender = EmailFactory::email();
        $timeNowString = (Carbon::now())->toString();
        /**
         * @var string $consignmentEmail
         * @var array $consignmentReferences
         */
        foreach ($consignmentsToSend as $consignmentEmail => $consignmentReferences) {
            $emailSender->setBody($consignmentReferences);
            $emailSender->setHeader(sprintf('Updating consignments for %s', $timeNowString));
            $emailSender->send();
            $emailBody = [];
        }
    }
}
