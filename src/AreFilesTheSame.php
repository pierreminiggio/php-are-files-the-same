<?php

namespace PierreMiniggio\AreFilesTheSame;

class AreFilesTheSame
{

    public static function areFilesTheSame(string $file1, string $file2): bool
    {
        $readLength = 4096;

        if (filetype($file1) !== filetype($file2)) {
            return false;
        }

        if (filesize($file1) !== filesize($file2)) {
            return false;
        }

        if (! $fp1 = fopen($file1, 'rb')) {
            return false;
        }

        if (! $fp2 = fopen($file2, 'rb')) {
            return false;
        }

        $same = true;
        while (! feof($fp1) and !feof($fp2)) {
            if (fread($fp1, $readLength) !== fread($fp2, $readLength)) {
                $same = false;
                break;
            }
        }

        if (feof($fp1) !== feof($fp2)) {
            $same = false;
        }

        fclose($fp1);
        fclose($fp2);

        return $same;
    }
}
